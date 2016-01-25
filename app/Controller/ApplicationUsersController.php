<?php
App::uses('AppController', 'Controller');

class ApplicationUsersController extends AppController {
    public $uses = array('ApplicationUser');
    
    public $helpers = array('Time', 'Text', 'Star');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'users');
    }
    public function index() {
        $this->ApplicationUser->recursive = 0;
        $this->set('users', $this->paginate());
    }
    public function pregled() {
        
    }

    public function edit($id = null) {
        $this->ApplicationUser->id = $id;
        if (!$this->ApplicationUser->exists()) {
          throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $location = $this->Location->findById($id);  
        
        $this->set(compact('location'));
    }
    
    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->ApplicationUser->exists($id)) {
            throw new NotFoundException(__('Ne postoji korisnik!'));
        }
        $options = array(
            'conditions' => array(
                'ApplicationUser.' . $this->ApplicationUser->primaryKey => $id
            ),
            'contain' => array(
                'LocationComment' => array(
                    'Location' => array(
                        'fields' => array(
                            'Location.id',
                            'Location.name'
                        )
                    )
                )
            )
        );
        $this->set('user', $this->ApplicationUser->find('first', $options));
    }

    public function users() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            echo json_encode($this->ApplicationUser->getAllUsers());
        }
    }
    
}
