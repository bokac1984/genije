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
    public $photoLocation = '/photos/';
    
    public $helpers = array('DataTable.DataTable', 'MyHtml', 'Time');
    
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
        
        /**
         * we do this to ensure our index page
         * will have the correct location data for our location operator
         */
        if (!$this->admin) {
        $this->DataTable->settings['Event']['conditions']['Event.fk_id_map_objects'] = $this->userLocation;        
        }
    }

    public function isAuthorized($user) {
        if ($this->locationOperator || $this->operator) {
            // ako je locOperator pogledaj jesmo li u add akciji
            // ako da vidi da li ID pripada lokaciji usera ulogovanog
            if (in_array($this->action, array('add'))) {
                return $this->checkIfUserCanAddToAllLocations();
            }
            
            //izbaci iz igre index i ovaj za dataTable
            //gucking strict checking vidim nesto ne daje dobre rezultaet
            // plus samo udji tu kad imamo pass onda gledaj
            // inace je to onda idnex akcija, za sve ostalo imamo dozvolu
            if (!in_array($this->action, array('index'), true) && !empty($this->request->params['pass'])) {
                //return $this->Product->productBelongsToUsersLocation($this->userLocation, $this->request->params['pass'][0]);       
            }
            
            return true;
        }

        if (in_array($this->action, array('add', 'delete')) && $this->admin) {
            return true;
        }

        return parent::isAuthorized($user);
    } 

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
    public function add($location = null) {
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
        
        if ($location !== null) {
            $cityId = $this->Event->Location->cityIdLocationIsFrom($location);
            $cities = array(
                $cityId => $this->Event->Location->getCityName($cityId)
            );
        } else {
            $cities = $this->Event->Location->City->find('list');
        }
        
        $this->set(compact(array('cities', 'location')));
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
        if (!$this->admin) {
            $cities = $this->Event->Location->getLocationNameForUser($this->userLocation);
        } else {
            $cities = $this->Event->Location->getCityLocations($this->request->data['city']);
        }
        
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
    
    public function changemainimage() {
        $this->request->allowMethod('ajax');
        $this->autoRender = false;
        
        $novi = $this->request->form['main-image']; 
        foreach ($novi as $k=>$v) {
            $novi[$k] = $v[0];
        }
        
        $slika = $this->uploadFile($novi, $this->photoLocation);
        
        $this->Event->id = $this->request->data['event'];
        if ($this->Event->saveField('img_url', $slika)){
            echo json_encode("/photos/$slika") ;
        }
    }    
}
