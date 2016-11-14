<?php

App::uses('AppController', 'Controller');

/**
 * CouponCheckers Controller
 *
 * @property CouponChecker $CouponChecker
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CouponCheckersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');
    public $helpers = array('Time', 'MyHtml');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'location');
    }

    public function isAuthorized($user) {
        if ($this->locationOperator || $this->operator) {
            return true;
        }

        if (in_array($this->action, array('add', 'delete')) && $this->admin) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->CouponChecker->recursive = 0;

        if ($this->locationOperator || $this->operator) {
            $conditions = array(
                'Location.id' => $this->userLocation
            );
        } else {
            $conditions = array();
        }
        $this->Paginator->settings = array(
            'order' => array(
                'CouponChecker.creation_date ASC'
            ),
            'conditions' => $conditions
        );
        $this->set('mapObjectsUsers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->CouponChecker->exists($id)) {
            throw new NotFoundException(__('Invalid map objects user'));
        }
        $options = array(
            'conditions' => array('CouponChecker.' . $this->CouponChecker->primaryKey => $id),
            'contain' => array(
                'CouponCheckerLogin',
                'Location' => array(
                    'fields' => array(
                        'Location.id',
                        'Location.name',
                        'Location.img_url'
                    )
                )
            )
        );
        $this->set('couponChecker', $this->CouponChecker->find('first', $options));
    }

    /**
     * Metod za dodavanje, i ovo je oblik sto nam dolazi sa forme
    //            array(
    //                'CouponChecker' => array(
    //                    'username' => 'dadsadsad',
    //                    'fk_id_map_objects' => '37'
    //                )
    //            )
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->CouponChecker->create();
            $code = $this->CouponChecker->getRadnomActivationCode();
            $this->request->data['CouponCheckerLogin'] = array(
                'activation_code' => $code,
                'activation_status' => 0,
                'full_name' => ''
            );
            
            /**
             * Dodajem ovaj dio koda da bi se za LocationOperatore dodavali ljudi samo
             * za one lokacije koje su njihove
             */
            if (!$this->admin) {
                $this->request->data['CouponChecker']['fk_id_map_objects'] = $this->userLocation;
            }

            if ($this->CouponChecker->saveAll($this->request->data)) {
                $this->Flash->success(__('Uspješno sačuvan korisnik.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Nešto je pošlo po zlu, nije ni nama jasno, pogledaćemo što prije!'));
            }
        }
        $locations = $this->CouponChecker->Location->getLocationsByStatus(Configure::read('Location.status.Online'));
        $this->set(compact('locations'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->CouponChecker->exists($id)) {
            throw new NotFoundException(__('Invalid map objects user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->CouponChecker->save($this->request->data)) {
                $this->Flash->success(__('The map objects user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The map objects user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('CouponChecker.' . $this->CouponChecker->primaryKey => $id));
            $this->request->data = $this->CouponChecker->find('first', $options);
        }
        $locations = $this->CouponChecker->Location->find('list');
        $this->set(compact('locations'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->CouponChecker->id = $id;
        if (!$this->CouponChecker->exists()) {
            throw new NotFoundException(__('Invalid map objects user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->CouponChecker->delete()) {
            $this->Flash->success(__('The map objects user has been deleted.'));
        } else {
            $this->Flash->error(__('The map objects user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /* AJAX METHOD */

    /**
     * Prima podatke u obliku
     *  array(
      'name' => 'can_do_checks',
      'value' => '0',
      'pk' => '1'
      )
     * @throws NotFoundException
     */
    public function checkPermission() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        $response = array(
            'status' => '404',
            'value' => 'label-danger'
        );

        $this->CouponChecker->id = $this->request->data['pk'];
        if (!$this->CouponChecker->exists()) {
            throw new NotFoundException(__('Ne postoji korisnik!'));
        }

        $dataToSave = array(
            'id' => $this->request->data['pk'],
            $this->request->data['name'] => $this->request->data['value']
        );

        if ($this->CouponChecker->save($dataToSave)) {
            $response = array(
                'status' => '200',
                'value' => 'label-success'
            );
        }

        $this->set(compact('response'));
    }

}
