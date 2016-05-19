<?php

App::uses('AppController', 'Controller');

/**
 * Addons Controller
 *
 * @property Addon $Addon
 * @property PaginatorComponent $Paginator
 */
class AddonsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Addon->recursive = 0;
        $this->set('addons', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Addon->exists($id)) {
            throw new NotFoundException(__('Invalid addon'));
        }
        $options = array('conditions' => array('Addon.' . $this->Addon->primaryKey => $id));
        $this->set('addon', $this->Addon->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Addon->create();
            if ($this->Addon->save($this->request->data)) {
                $this->Flash->success(__('The addon has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The addon could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Addon->exists($id)) {
            throw new NotFoundException(__('Invalid addon'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Addon->save($this->request->data)) {
                $this->Flash->success(__('The addon has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The addon could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Addon.' . $this->Addon->primaryKey => $id));
            $this->request->data = $this->Addon->find('first', $options);
        }
        $users = $this->Addon->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Addon->id = $id;
        if (!$this->Addon->exists()) {
            throw new NotFoundException(__('Invalid addon'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Addon->delete()) {
            $this->Flash->success(__('The addon has been deleted.'));
        } else {
            $this->Flash->error(__('The addon could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
