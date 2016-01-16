<?php
App::uses('AppController', 'Controller');

class EventsController extends AppController {
    public $uses = array('Event');
    
    /**
     * Lokacija za slike na fajl sistemu
     * 
     * @access public
     *
     * @var string Putanja u kojoj se cuvaju slike za evenete 
     */
    public $photoLocation = '/photos/events/';
    
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
                        'label' => 'Lokacija',
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
        ),
        'RequestHandler'
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'calendar');
    }

    public function isAuthorized($user) {
        return parent::isAuthorized($user);
    }
    
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

    public function view($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Ne postoji dogadjaj'));
        }
        $options = array(
            'conditions' => array(
                'Event.id' => $id
            ),
            'contain' => array(
                'Location' => array(
                    'fields' => 'Location.id'
                )
            )
        );
        $event = $this->Event->find('first', $options);
        $this->set(compact('event'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            if ( !isset($this->request->data['Event']['use_loc_image']) && $this->data['Event']['img_url']['error'] !== 4 ) {
                $this->request->data['Event']['img_url'] = 'events/' . $this->uploadFile($this->request->data['Event']['img_url'], $this->photoLocation);                
            } else {
                echo $image = $this->Event->setLocationsMainImageToEvent($this->request->data['Event']['fk_id_map_objects']);
                $this->request->data['Event']['img_url'] = $image;
            }

            $this->Event->create();
            if ($this->Event->saveEvent($this->request->data)) {
                $this->Flash->success(__('Uspješno ste sačuvali podatke o događaju.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Nije moguće sačuvati podatke, molimo Vas pokušajte ponovo!'));
            }
        }
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

    public function deleteEvent() {
        $this->request->allowMethod('ajax');
        $this->autoRender = false;
        if ($this->Event->delete($this->request->data['pk'])) {
            echo '200';exit();
        }

        echo '303';
    }
}
