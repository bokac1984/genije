<?php
App::uses('AppController', 'Controller');

class ApplicationUsersController extends AppController {
    public $uses = array('ApplicationUser');
    public function index() {
        $this->ApplicationUser->recursive = 0;
        $this->set('users', $this->paginate());
    }
    public function pregled() {
        
    }

    public function edit($id = null) {
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
          throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $location = $this->Location->findById($id);  
        
        $this->set(compact('location'));
    }

    public function users() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            echo json_encode($this->ApplicationUser->getAllUsers());
        }
    }
    
}
