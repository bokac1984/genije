<?php

App::uses('AppController', 'Controller');

/**
 * LocationComments Controller
 *
 * @property LocationComment $LocationComment
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class LocationCommentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->LocationComment->recursive = 0;
        $this->set('LocationComments', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->LocationComment->exists($id)) {
            throw new NotFoundException(__('Invalid map objects comment'));
        }
        $options = array('conditions' => array('LocationComment.' . $this->LocationComment->primaryKey => $id));
        $this->set('mapObjectsComment', $this->LocationComment->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->LocationComment->create();
            if ($this->LocationComment->save($this->request->data)) {
                $this->Flash->success(__('The map objects comment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The map objects comment could not be saved. Please, try again.'));
            }
        }
        $locations = $this->LocationComment->Location->find('list');
        $applicationUsers = $this->LocationComment->ApplicationUser->find('list');
        $this->set(compact('locations', 'applicationUsers'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->LocationComment->exists($id)) {
            throw new NotFoundException(__('Invalid map objects comment'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->LocationComment->save($this->request->data)) {
                $this->Flash->success(__('The map objects comment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The map objects comment could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('LocationComment.' . $this->LocationComment->primaryKey => $id));
            $this->request->data = $this->LocationComment->find('first', $options);
        }
        $locations = $this->LocationComment->Location->find('list');
        $applicationUsers = $this->LocationComment->ApplicationUser->find('list');
        $this->set(compact('locations', 'applicationUsers'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->LocationComment->id = $id;
        if (!$this->LocationComment->exists()) {
            throw new NotFoundException(__('Invalid map objects comment'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->LocationComment->delete()) {
            $this->Flash->success(__('The map objects comment has been deleted.'));
        } else {
            $this->Flash->error(__('The map objects comment could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
