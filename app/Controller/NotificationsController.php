<?php

App::uses('AppController', 'Controller');

/**
 * Notifications Controller
 *
 * @property Notification $Notification
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class NotificationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session', 'Notify');

    public $helpers =  array('MyHtml');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'note');
        if ($this->request->is('ajax')) {
            $this->disableCache();
        }
    }
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Paginator->settings = array(
            'limit' => 15,
            'contain' => array(
                'ApplicationUser' => array(
                    'fields' => array(
                        'ApplicationUser.id',
                        'ApplicationUser.display_name'
                    )
                )
            ),
            'order' => array(
                'Notification.date DESC'
            )
        );
               
        $this->set('notifications', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Notification->exists($id)) {
            throw new NotFoundException(__('Invalid notification'));
        }
        $options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
        $this->set('notification', $this->Notification->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $data = array(
                'img_url' => '525f81ca4e-548c87396e0d6.jpg',
                'fk_id_users' => 5,
                'type' => 4,
                'type_id' => ''
            );
            $this->request->data['Notification']['img_url'] = '525f81ca4e-548c87396e0d6.jpg';
            $this->request->data['Notification']['fk_id_users'] = '5';
            $this->request->data['Notification']['type'] = '4';
            $this->request->data['Notification']['type_id'] = '';
            
            //debug($this->request->data);exit();
            $this->Notification->create();
            if ($this->Notification->save($this->request->data)) {
                $this->Notify->sendNotifications(array('text' => $this->request->data['Notification']['text']));
                $this->Flash->success(__('Notifikacija uspješno poslata'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
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
        if (!$this->Notification->exists($id)) {
            throw new NotFoundException(__('Invalid notification'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Notification->save($this->request->data)) {
                $this->Flash->success(__('The notification has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
            $this->request->data = $this->Notification->find('first', $options);
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
        $this->Notification->id = $id;
        if (!$this->Notification->exists()) {
            throw new NotFoundException(__('Invalid notification'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Notification->delete()) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
