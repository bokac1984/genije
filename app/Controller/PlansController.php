<?php

App::uses('AppController', 'Controller');

/**
 * Plans Controller
 *
 * @property Plan $Plan
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PlansController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');

    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'location');
    }
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Plan->recursive = 0;
        $this->set('plans', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Plan->exists($id)) {
            throw new NotFoundException(__('Invalid plan'));
        }
        $options = array('conditions' => array('Plan.' . $this->Plan->primaryKey => $id));
        $this->set('plan', $this->Plan->find('first', $options));
    }
    /**
     * plans method
     *
     * @return void
     */
    public function pregled() {
        
    }
    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Plan->create();
            if ($this->Plan->save($this->request->data)) {
                $this->Flash->success(__('The plan has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The plan could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Plan->exists($id)) {
            throw new NotFoundException(__('Invalid plan'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Plan->save($this->request->data)) {
                $this->Flash->success(__('The plan has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The plan could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Plan.' . $this->Plan->primaryKey => $id));
            $this->request->data = $this->Plan->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Plan->id = $id;
        if (!$this->Plan->exists()) {
            throw new NotFoundException(__('Invalid plan'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Plan->delete()) {
            $this->Flash->success(__('The plan has been deleted.'));
        } else {
            $this->Flash->error(__('The plan could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
