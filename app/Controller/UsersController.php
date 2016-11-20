<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout');
        $this->set('icon', 'users');
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'delete', 'edit')) && ($user['group_id'] === '1' || $user['group_id'] === '2')) {
            return true;
        }

        if (in_array($this->action, array('password', 'profile'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => array(
                'User.creation_date DESC'
            )
        );
        $this->set('users', $this->Paginator->paginate());
    }

    public function login() {
        $this->layout = 'login';
                
        // ako je vec ulogovan, pa dje ces tu onda?!
        if ($this->Auth->user('id')) {
            return $this->redirect('/dashboards/');
        }
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // sacuvaj last login time
                $this->User->updateAll(array(
                    'User.last_login_time' => 'NOW()'
                        ), array(
                    'User.id' => $this->Auth->user('id')
                        )
                );

                if (isset($this->request->data['User']['rememberme'])) {
                    $selector = base64_encode(openssl_random_pseudo_bytes(9));
                    $authenticator = openssl_random_pseudo_bytes(33);
                    $cookieTime = time() + 864000;

                    $this->Cookie->time = $cookieTime;  // or '1 hour'4  
                    $this->Cookie->write('rememberme', $selector . ':' . base64_encode($authenticator));

                    $this->User->AuthToken->save(array(
                        'AuthToken' => array(
                            'selector' => $selector,
                            'token' => hash('sha256', $authenticator),
                            'fk_id_admin_users' => $this->Auth->user('id'),
                            'expires' => date('Y-m-d\TH:i:s', $cookieTime)
                        )
                    ));
                }
                $this->Session->delete('Message.flash');
                return $this->redirect('/dashboards/');
            }
            $this->Flash->error(__('Ne valja lozinka ili korisničko ime'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {        
        if ($this->request->is('post')) {
            $this->request->data['User']['group_id'] = 3;
            $this->User->set($this->request->data);

            if ($this->User->validates()) {
                $filename = $this->uploadFile($this->request->data['User']['img'], 'photos-profiles/');
                if ($filename !== '') {
                    $this->request->data['User']['img'] = $filename;
                }
                $this->User->create();
                if ($this->User->save($this->request->data, false)) {
                    $this->Flash->success(__('Korisnik je uspjesno dodat.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('Korisnika nije moguće dodati, molimo Vas obratite se administratoru!'));
                }
            } else {
                $this->Flash->error(__('Korisnika nije moguće dodati, molimo Vas obratite se administratoru!'));
            }
        }

        // ako nije admin neka samo daje one koje smije da kreira tj
        $conditions = array();
        if ($this->Auth->user('group_id') !== '1') {
            $conditions = array(
                'conditions' => array(
                    'Group.id' => 3
                )
            );
        }


        $groups = $this->User->Group->find('list', $conditions);
        $this->set(compact('groups'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    public function password($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success('Uspjesno sacuvano');
            } else {
                $this->Flash->error(__('Popravite greške ispod i pokušajte ponovo.'));
            }
        }
        $this->User->recursive = 0;
        $this->request->data = $this->User->findById($id);
        unset($this->request->data['User']['password']);
    }

    public function profile($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
        } else {
            $this->request->data = $this->User->read(null, $id);
            $birthday = $this->User->splitBirthday($this->request->data['User']['birth_date']);
            unset($this->request->data['User']['password']);
            $this->set(compact('birthday'));
        }
    }

    /**
     * Pregled korisnika i uredjivanje 
     * 
     * @param int $id
     */
    public function overview($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Nepostojeći korisnik!!!'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //  debug($this->request->data);
//            if ($this->User->save($this->request->data)) {
//                $this->Session->setFlash(__('The user has been saved'));
//                $this->redirect(array('action' => 'index'));
//            } else {
//                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
//            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }

        $City = ClassRegistry::init('City');

        $cities = $City->find('list');
        $this->request->data = $this->User->read(null, $id);
        $birthday = $this->User->splitBirthday($this->request->data['User']['birth_date']);
        $location = $this->User->Location->find('first', array(
            'conditions' => array(
                'Location.id' => $this->request->data['User']['map_object_id']
            )
        ));
        $subscription = $this->User->Subscription->find('all', array(
            'conditions' => array(
                'Subscription.admin_users_id' => $id
            ),
            'contain' => array(
                'Plan'
            )
        ));
        unset($this->request->data['User']['password']);
        $this->set(compact('birthday', 'cities', 'location', 'subscription'));
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function listLocations() {
        $this->viewClass = 'Json';
        $city = $this->request->data['city'];

        $locationsForCity = $this->User->Location->getCityLocations($city);
        $this->set(compact('locationsForCity'));
    }

    public function saveUserLocation() {
        $this->viewClass = 'Json';

        $data = array(
            'id' => $this->request->data['user'],
            'map_object_id' => $this->request->data['location']
        );

        if ($this->User->save($data)) {
            $location = $this->User->Location->find('first', array(
                'conditions' => array(
                    'Location.id' => $data['map_object_id']
                ),
                'fields' => array(
                    'Location.id', 'Location.name'
                )
            ));

            $this->set(compact('location'));
        } else {
            echo 'ne radi';
        }
    }

    /**
     * Ajax metoda za cuvanje pretplate
     */
    public function savePlan() {
        $this->viewClass = 'Json';
        
        $data = array(
            'plans_id' => $this->request->data['plan'],
            'admin_users_id' => $this->request->data['user'],
            'start_date' => $this->User->getDataSource()->expression('NOW()'),
            'end_date' => $this->User->getDataSource()->expression('NOW() + INTERVAL 1 MONTH')
        );

        if (!$this->User->Subscription->subExists($data['admin_users_id'])) {
            throw new NotFoundException(__('Ovaj korisnik ima pretplatu!!!'));
        }

        if ($this->User->Subscription->save($data)) {
            $subscription = $this->User->Subscription->find('all', array(
                'conditions' => array(
                    'Subscription.admin_users_id' => $data['admin_users_id']
                ),
                'contain' => array(
                    'Plan'
                )
            ));

            $this->set(compact('subscription'));
        } else {
            throw new NotFoundException(__('Nije moguće sačuvati!!!'));
        }
    }
}
