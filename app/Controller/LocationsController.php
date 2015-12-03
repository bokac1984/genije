<?php
App::uses('AppController', 'Controller');

class LocationsController extends AppController {
    public $uses = array('Location');
    public $components = array(
        'DataTable.DataTable' => array(
            'Location' => array(
                'columns' => array(
                    'id' => array(
                        'label' => '#',
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => 'true',
                        'bSearchable' => false
                    ), 
                    'name' => array(
                        'label' => 'Naziv',
                        'sWidth' => '20%',
                        'bSortable' => 'false',
                        'bSearchable' => false
                    ), 
                    'fk_id_cities' => array(
                        'label' => 'Grad',
                        'sWidth' => '10%',
                        'bSortable' => 'false',
                        'bSearchable' => 'true'
                    ), 
                    'address' => array(
                        'label' => 'Adresa',
                        'sWidth' => '30%',
                        'bSortable' => 'false',
                        'bSearchable' => false
                    ),
                    'users_rating' => array(
                        'label' => 'Ocjena',
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => 'true',
                        'bSearchable' => false
                    ), 
                    'admin_rating' => array(
                        'label' => 'Rejting',
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => 'true',
                        'bSearchable' => false
                    ),
                    'online_status' => array(
                        'label' => 'Status',
                        'sWidth' => '10%',
                        'sClass' => 'center',
                        'bSortable' => false,
                        'bSearchable' => 'true'
                    ),
                    'Actions' => array(
                        'sClass' => 'center',
                        'bSortable' => 'false',
                        'useField' => false,
                        'bSearchable' => 'false',
                        'label' => 'Akcije',
                        'sWidth' => '10%'
                    ),
                )
            )
        )
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'location');
    }
    
    public function isAuthorized($user) {
        if ($user['group_id'] === 2 || $user['group_id'] == 3) {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    public $helpers =  array('DataTable.DataTable');

    public function index() {
        $this->DataTable->setViewVar('Location');
    }

    public function edit($id = null) {
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
          throw new NotFoundException(__('Ne postoji lokacija'));
        }

        $options = array(
            'conditions' => array(
                'Location.' . $this->Location->primaryKey => $id
            ),
            'contain' => array(
                'City',
                'Contact',
                'LocationDescription',
                'MapObjectSubtypeRelation'
            )
        );
        $this->Location->recursive = -1;
        $this->set('location', $this->Location->find('first', $options));
    }
    
    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        
        if (!$this->Location->exists($id)) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $options = array(
            'conditions' => array(
                'Location.' . $this->Location->primaryKey => $id
            ),
            'contain' => array(
                'City' => array(
                    'fields' => array(
                        'id', 'name'
                    )
                ),
                'Contact'
            )
        );
        $this->Location->recursive = -1;
        $this->set('location', $this->Location->find('first', $options));
    }
    
    public function getSubtypes() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $k = $this->Location->MapObjectSubtypeRelation->ObjectSubtype->getAllSubtypes();
            
            echo json_encode($k);
        }  
    }
    
    public function saveSubtypes() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            if ($this->Location->MapObjectSubtypeRelation->saveObjectSubtypes($this->request->data['pk'], $this->request->data['value'])) {
                echo '200';
                exit();
            }
        } 
        echo '404';
    }
    
    public function add() {
        $cities = $this->Location->City->find('list');
        $subtypes = $this->Location->MapObjectSubtypeRelation->ObjectSubtype->find('list');
        $this->set(compact(array('cities', 'subtypes')));
    }
    
    public function gallery($id) {
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
          throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $this->Location->recursive = -1;
        $mainImage = $this->Location->find('first', array(
            'fields' => array(
                'Location.img_url'
            ),
            'conditions' => array(
                'Location.id' => $id
            )
        ));
        $mainImage = $mainImage['Location']['img_url'];
        
        $images = $this->Location->LocationImage->find('all', array(
            'conditions' => array(
                'LocationImage.fk_id_map_objects' => $id
            )
        ));
        $this->set(compact('images', 'mainImage', 'id'));
    }
    
    /* ajax methods */
    
    public function addNewLocation() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            echo $this->Location->saveNewLocation($this->request->data);
        }
    }
    public function ajaxEdit() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $this->Location->id = $this->request->data['pk'];
            $field = $this->request->data['name'];
            $value = $this->request->data['value'];
            if ($this->Location->saveField($field, $value)){
                echo 'radi';
            } else {
                echo 'error';
            }
        }
    }
    
    public function updateContactInfo() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $data = array(
                'fk_id_contact_types' => $this->request->data['tip'],
                'fk_id_map_objects' => $this->request->data['pk'],
                'value' => $this->request->data['value']
            );
            if ($this->Location->Contact->save($data)) {
                echo 'uspej';
            } else {
                echo 'ne radi';
            }
        } 
    }
    
    public function updateDescription() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $data = array(
                'id' => $this->request->data['pk'],
                'html_text' => $this->request->data['value']
            );
            if ($this->Location->LocationDescription->save($data)) {
                echo 'upesno sacuvano';
            } else {
                echo 'ne radi description';
            }
        }
    }
    
    public function getCities() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $cities = $this->Location->City->find('list');

            echo json_encode($cities);
        }
    }
    
    public function getCitiesForSelect() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $cities = $this->Location->City->find('all', array('fields' => array('id', 'name')));
            echo json_encode($cities);
        }
    }

    
    public function saveLocation() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            debug($this->request->data);
            $this->Location->id = $this->request->data['id'];
            $data = array(
                'longitude' => $this->request->data['value'],
                'latitude' => $this->request->data['value2']
            );

            if ($this->Location->save($data)) {
                echo 'uspjeh';
            } else {
                echo 'ne radi';
            }
            
        }
    }
    
    public function editStatus() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){

            $this->Location->id = $this->request->data['pk'];
            if ($this->Location->saveField('online_status', $this->request->data['value'])) {
                echo 'da';
            } else {
                echo 'ne';
            }
        }
    }
    /**
     * Postavlja za glavnu sliku
     */
    public function makeCover() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->Location->id = $this->request->data['id'];
            if (!$this->Location->exists()) {
                echo '404';
            } else {
                if ($this->Location->saveField('img_url', $this->request->data['cover'])) {
                    echo '200';
                } else {
                    echo '404';
                }
            }
            exit();
        }
    }
    
    public function uploadPhotos() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $locationId = $this->request->data['idLocation'];
            $filename = $this->uploadFile($this->request->params['form']['file']);
            
            if ($this->Location->saveImageData($locationId, $filename)) {
                echo $filename;
                exit();
            } else {
                echo 'ne radi upload';
            }
        }
        echo '404';
    }
    
    /**
     * Brise sliku iz galerije
     */
    public function deleteImage() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $id = $this->request->data['id'];
            $fid = $this->request->data['fid'];// id slike
            $jpg = $this->request->data['jpg'];
            if ($this->Location->deleteImage($id, $fid, $jpg)) {
                echo '200';
            } else {
                echo '404';
            }
        }
    }
    
    /**
     * Brisemo sve sa servera vezon za lokaciju
     * TODO: mora se vidjeti sta je sa dogadjajima i produktima vezanima za tu lokaciju, treba i to obrisati
     */
    public function deleteLoc() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $id = $this->request->data['pk'];
            $this->Location->id = $id;
            if (!$this->Location->exists()) {
                echo '404';
                exit();
            }
            echo $this->Location->deleteLocation($id);
        }
    }    
}
