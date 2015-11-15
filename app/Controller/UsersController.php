<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout');
        $this->set('icon', 'users');
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('password', 'profile'))) {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function index() {
        $this->ApplicationUser->recursive = 0;
        $this->set('users', $this->paginate());
    }


    public function login() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // sacuvaj last login time
                $this->User->updateAll(array(
                        'User.last_login_time' => 'NOW()'
                    ), 
                    array(
                        'User.id' => $this->Auth->user('id')
                    )
                );

                if (isset($this->request->data['User']['rememberme'])) {
                    $selector = base64_encode(openssl_random_pseudo_bytes(9));
                    $authenticator = openssl_random_pseudo_bytes(33);
                    $cookieTime = time() + 864000;
                                     
                    $this->Cookie->time = $cookieTime;  // or '1 hour'4  
                    $this->Cookie->write('rememberme', $selector.':'.base64_encode($authenticator));
                    
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
      $this->User->create();
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    }
    $groups = $this->User->Group->find('list');
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
          $user= $this->User->read(null, $id);
          unset($user['User']['password']);
          $this->set(compact('user'));
        } 
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
  // obrisati kasnije neka za sad stoji da imam evidenciju sta je uradjeno
//    public function initDB() {
//        $group = $this->User->Group;
//
//     // 4 admin
//     // 5 operator
//     // 
//        // Allow admins to everything
//        $group->id = 4;
//        $this->Acl->allow($group, 'controllers');
//
//        // allow managers to posts and widgets
//        $group->id = 5;
//        $this->Acl->deny($group, 'controllers');
//        $this->Acl->allow($group, 'controllers/Products');
//        $this->Acl->allow($group, 'controllers/Events');
//        $this->Acl->allow($group, 'controllers/News');
//        $this->Acl->allow($group, 'controllers/Tickets');
//        $this->Acl->allow($group, 'controllers/Users/logout');
//
//        // we add an exit to avoid an ugly "missing views" error message
//        echo "all done";
//        exit;
//    }  
}
