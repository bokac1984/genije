<?php
App::uses('AppController', 'Controller');

class DashboardsController extends AppController {
    
    public function beforeFilter() {
        if ($this->request->is('ajax')) {
            $this->disableCache();
        }
        $this->set('icon', 'home-3');
        parent::beforeFilter();
    }

    public function isAuthorized($user) {
        return true;
    }

    public function index() {

    }
    
    public function edit($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
          throw new NotFoundException(__('Ne postoji dogadjaj'));
        }
        $event = $this->Event->findById($id);  
        
        $this->set(compact('event'));
    }

    public function add() {
        $cities = $this->Event->Location->City->find('list');
        $this->set(compact(array('cities')));
    }
    
    public function editStatus() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){

            $this->Event->id = $this->request->data['pk'];
            if ($this->Event->saveField('online_status', $this->request->data['value'])) {
                echo 'da';
            } else {
                echo 'ne';
            }
        }
    }
    
    public function locations() {
        $this->request->onlyAllow('ajax');
        $this->viewClass = 'Json';
        $cities = $this->Event->Location->getCityLocations($this->request->data['city']);
        $this->set(compact('cities'));
    }
    
    public function saveNewEvent() {
        $this->request->onlyAllow('ajax');
        $this->autoRender = false;
        return $this->Event->saveEvent($this->request->data);
    }


    public function editable() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $this->Event->id = $this->request->data['pk'];
            $field = $this->request->data['name'];
            $value = $this->request->data['value'];
            if ($this->Event->saveField($field, $value)){
                echo 'radi';
            } else {
                echo 'error';
            }
        }
    }
}
