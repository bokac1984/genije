<?php
App::uses('AppController', 'Controller');

/**
 * Locations controller
 * @property Location $Location
 */
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
                        'bSearchable' => 'true'
                    ), 
                    'fk_id_cities' => array(
                        'label' => 'Grad',
                        'sWidth' => '10%',
                        'bSortable' => 'false',
                        'bSearchable' => 'true',
                        'searchById' => 'true'
                    ), 
                    'address' => array(
                        'label' => 'Adresa',
                        'sWidth' => '30%',
                        'bSortable' => 'false',
                        'bSearchable' => false,
                        'bSearchable' => 'true'
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
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => false,
                        'bSearchable' => 'true',
                        'searchById' => 'true'
                    ),
                    'Actions' => array(
                        'sClass' => 'center',
                        'bSortable' => 'false',
                        'useField' => false,
                        'bSearchable' => 'false',
                        'label' => 'Akcije',
                        'sWidth' => '15%'
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
        if ($user['group_id'] === 2 || $user['group_id'] === 3) {
            return true;
        }
        
        if (in_array($this->action, array('add', 'delete')) && $user['group_id'] === 1) {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    public $helpers =  array('DataTable.DataTable', 'Time', 'MyHtml');

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
                    'fields' => array('name')
                ),
                'Contact' => array(
                    'fields' => array(
                        'value', 'id'
                    ),
                    'order' => array(
                        'Contact.fk_id_contact_types' => 'asc'
                    ),
                    'ContactType' => array(
                        'fields' => array('name')
                    ),
                    'conditions' => array(
                        'Contact.fk_id_map_objects' => $id
                    )
                ),
                'LocationDescription',
                'MapObjectSubtypeRelation' => array(
                    'fields' => array('id'),
                    'ObjectSubtype' => array(
                        'fields' => array('name')
                    )
                )
            )
        );
        $location = $this->Location->find('first', $options);
        $events = $this->Location->Event->getAllLocationEvents($id);
        $news = $this->Location->News->locationNews($id);
        $this->set(compact('location', 'events', 'news'));
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
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        $this->Location->id = isset($this->request->data['pk']) ? $this->request->data['pk'] : '-1';
        if (!$this->Location->exists()) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }     
        
        $response = array(
            'status' => '200',
            'value' => 'prayno'
        );
        
        if ($this->request->is('ajax')){
            $data = array(
                'fk_id_contact_types' => $this->request->data['tip'],
                'fk_id_map_objects' => $this->request->data['pk'],
                'value' => $this->request->data['value'],
                'id' => isset($this->request->data['id']) ? $this->request->data['id'] : ''
            );
            
            if ($this->Location->Contact->save($data)) {

                $response['value'] = $this->Location->Contact->getLastInsertID() !== null ?
                        $this->Location->Contact->getLastInsertID() : $data['id'] ;
            } else {
                $response['status'] = '404';
            }
        }
        
        $this->set(compact('response'));
    }
    
    public function updateDescription() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $data = array(
                'fk_id_map_objects' => $this->request->data['pk'],
                'html_text' => $this->request->data['value']
            );
            if ($this->Location->LocationDescription->save($data)) {
                echo '200';
            } else {
                echo '404';
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
                echo '200';
            } else {
                echo '404';
            }
            
        }
    }
    
    public function editStatus() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $this->Location->id = $this->request->data['pk'];
            $statusCode = $this->Location->updateStatus($this->request->data['value']);
            
            $this->response->statusCode($statusCode);
            return $statusCode == 400 ? "Postavite sliku za lokaciju" : "";
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
            if ($this->Location->deleteImage($fid, $jpg)) {
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
    
    public function getAllEventsForLocation() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        $id = $this->request->data['id'];
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }
        
        $events = $this->Location->Event->getAllLocationEventsAjax($id);
        $this->set(compact('events'));
    }
    
    public function getCommentsForLocation() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        $id = $this->request->data['id'];
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }
        
        $comments = $this->Location->LocationComment->getAllLocationComments($id);
        $this->set(compact('comments'));
    }  
    
    public function getProductsForLocation() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        $id = $this->request->data['id'];
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $options['joins'] =  array(
                 array('table' => 'map_objects_products',
                    'alias' => 'LocationProduct',
                    'type' => 'INNER',
                    'conditions' => array(
                        'LocationProduct.fk_id_products = Product.id'
                    )
                )
            );
        $options['conditions'] = array(
            'LocationProduct.fk_id_map_objects' => $id,
        );
        $products = $this->Location->Product->find('all', $options);
        $this->set(compact('products'));
    }     
}
