<?php
App::uses('AppController', 'Controller');

class EventsController extends AppController {
    public $uses = array('Event');
    public $components = array(
        'DataTable.DataTable' => array(
            'Event' => array(
                'columns' => array(
                    'id' => array(
                        'label' => '#',
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => 'true'
                    ), 
                    'name' => array(
                        'label' => 'Naziv',
                        'sWidth' => '15%',
                        'bSortable' => 'false'
                    ), 
                    'lid' => array(
                        'label' => 'Lid',
                        'sWidth' => '30%',
                        'bSortable' => 'false',
                        'bSearchable' => true
                    ), 
                    'start_time' => array(
                        'label' => 'Vazi od',
                        'sWidth' => '10%',
                        'bSortable' => 'false'
                    ),
                    'end_time' => array(
                        'label' => 'Vazi do',
                        'sWidth' => '10%',
                        'sClass' => 'center',
                        'bSortable' => 'true'
                    ),
                    'fk_id_map_objects' => array(
                        'label' => 'Vazi do',
                        'sWidth' => '10%',
                        'sClass' => 'center',
                        'bSortable' => 'true'
                    ), 
                    'online_status' => array(
                        'label' => 'Status',
                        'sWidth' => '8%',
                        'sClass' => 'center',
                        'bSortable' => 'false',
                        'bSearchable' => true
                    ),
                    'Actions' => array(
                        'useField' => false,
                        'sClass' => 'center',
                        'bSortable' => 'false',
                        'label' => 'Akcije',
                        'sWidth' => '10%'
                    ),
                )
            )
        )
    );
    
    public $helpers =  array('DataTable.DataTable');

    public function index() {
        $this->DataTable->setViewVar('Event');
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
