<?php

App::uses('AppController', 'Controller');

/**
 * DeclineReasons Controller
 *
 * @property DeclineReason $DeclineReason
 * @property PaginatorComponent $Paginator
 */
class DeclineReasonsController extends AppController {

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
        $this->DeclineReason->recursive = 0;
        $this->set('declineReasons', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DeclineReason->exists($id)) {
            throw new NotFoundException(__('Invalid decline reason'));
        }
        $options = array('conditions' => array('DeclineReason.' . $this->DeclineReason->primaryKey => $id));
        $this->set('declineReason', $this->DeclineReason->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->DeclineReason->create();
            if ($this->DeclineReason->save($this->request->data)) {
                $this->Flash->success(__('The decline reason has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The decline reason could not be saved. Please, try again.'));
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
        if (!$this->DeclineReason->exists($id)) {
            throw new NotFoundException(__('Invalid decline reason'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->DeclineReason->save($this->request->data)) {
                $this->Flash->success(__('The decline reason has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The decline reason could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('DeclineReason.' . $this->DeclineReason->primaryKey => $id));
            $this->request->data = $this->DeclineReason->find('first', $options);
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
        $this->DeclineReason->id = $id;
        if (!$this->DeclineReason->exists()) {
            throw new NotFoundException(__('Invalid decline reason'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->DeclineReason->delete()) {
            $this->Flash->success(__('The decline reason has been deleted.'));
        } else {
            $this->Flash->error(__('The decline reason could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function reasons() {
        $this->viewClass = 'Json';
        
        $this->set('reasons', $this->DeclineReason->reasonsForJson());
    }    
}
