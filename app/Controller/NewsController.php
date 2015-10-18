<?php
App::uses('AppController', 'Controller');

class NewsController extends AppController {
    public $uses = array('News');

    public function index() {
        $events = $this->News->find('all', array(
//            'contain' => array(
//                'Location' => array(
//                    'fields' => array(
//                        'Location.name'
//                    )
//                )
//            )
        ));
        $this->set(compact('events'));
    }

    public function edit($id = null) {
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
          throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $location = $this->Location->findById($id);  
        
        $this->set(compact('location'));
    }

    public function add() {

    }
    
}
