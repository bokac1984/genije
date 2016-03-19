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
    
    public $helpers =  array('Time');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->CouponChecker->recursive = 0;
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
                'CouponCheckerLogin'
            )
        );
        $this->set('mapObjectsUser', $this->CouponChecker->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->CouponChecker->create();
            $code = $this->CouponChecker->generateRandomString();
            $this->request->data['CouponCheckerLogin'] = array(
                'activation_code' => $code,
                'activation_status' => 0
            );
            
            if ($this->CouponChecker->saveAll($this->request->data)) {
                $this->Flash->success(__('Uspesno sacuvano.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Please, try again.'));
            }
        }
        $locations = $this->CouponChecker->Location->find('list', array(
            'conditions' => array(
                'Location.fk_id_cities' => 1
            )
        ));
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

}
