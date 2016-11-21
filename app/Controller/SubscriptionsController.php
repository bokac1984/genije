<?php

App::uses('AppController', 'Controller');

/**
 * Subscriptions Controller
 *
 * @property Subscription $Subscription
 * @property PaginatorComponent $Paginator
 */
class SubscriptionsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'stack-2');
        
        $this->Auth->allow('uploadPhotos');
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
    
    public function expired() {}
    
    public function used() {}

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Subscription->recursive = 0;       
        $this->set('subscriptions', $this->Paginator->paginate());
    }
    
    public function mine() {
        $this->Subscription->recursive = 0;     
        $this->Paginator->settings = array(
            'limit' => 25,
            'order' => array(
                'Subscription.created' => 'DESC'
            ),
            'conditions' => array(
                'Subscription.admin_users_id' => $this->Auth->user('id'),
                'Subscription.decline_reason_id' => null
            ),
            'contain' => array(
                'Plan'
            )
        );
        $this->set('subscriptions', $this->Paginator->paginate());        
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Subscription->exists($id)) {
            throw new NotFoundException(__('Invalid subscription'));
        }
        $options = array('conditions' => array('Subscription.' . $this->Subscription->primaryKey => $id));
        $this->set('subscription', $this->Subscription->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Subscription->create();
            if ($this->Subscription->save($this->request->data)) {
                $this->Flash->success(__('The subscription has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
            }
        }
        $adminUsers = $this->Subscription->AdminUser->find('list');
        $plans = $this->Subscription->Plan->find('list');
        $this->set(compact('adminUsers', 'plans'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Subscription->exists($id)) {
            throw new NotFoundException(__('Invalid subscription'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Subscription->save($this->request->data)) {
                $this->Flash->success(__('The subscription has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Subscription.' . $this->Subscription->primaryKey => $id));
            $this->request->data = $this->Subscription->find('first', $options);
        }
        $adminUsers = $this->Subscription->AdminUser->find('list');
        $plans = $this->Subscription->Plan->find('list');
        $this->set(compact('adminUsers', 'plans'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Subscription->id = $id;
        if (!$this->Subscription->exists()) {
            throw new NotFoundException(__('Invalid subscription'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Subscription->delete()) {
            $this->Flash->success(__('The subscription has been deleted.'));
        } else {
            $this->Flash->error(__('The subscription could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    /**
     * Ajax metoda za odustajanje od pretplate
     */
    public function cancel() {
        $this->viewClass = 'Json';
        
        $data = array(
            'Subscription' => array(
                'id' => $this->request->data['subscription'],
                'decline_reason_id' => $this->request->data['reason']
            )
        );
        
        $respond = array(
            'status' => '400',
            'error' => 'Nije moguće sačuvati!',
        );
        if ($this->Subscription->save($data)) {
            $respond = array(
                'status' => '200',
                'error' => ''
            );
        } 
        $this->set('respond', $respond);
    }

}
