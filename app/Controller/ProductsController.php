<?php

App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array(
        'DataTable.DataTable' => array(
            'Product' => array(
                'joins' =>  array(
                     array(
                        'table' => 'map_objects_products',
                        'alias' => 'LocationProduct',
                        'type' => 'INNER',
                        'conditions' => array(
                            'LocationProduct.fk_id_products = Product.id',
                            'LocationProduct.fk_id_map_objects' => ''
                        )
                    )
                ),                
                'columns' => array(
                    'Product.id' => array(
                        'label' => '#',
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => 'true'
                    ),
                    'Product.name' => array(
                        'label' => 'Naziv',
                        'sWidth' => '10%',
                        'bSortable' => 'false'
                    ),
                    'Product.description' => array(
                        'label' => 'Opis',
                        'sWidth' => '30%',
                        'bSortable' => 'false',
                        'bSearchable' => true
                    ),
                    'Product.price' => array(
                        'label' => 'Cijena',
                        'sWidth' => '10%',
                        'bSortable' => 'false'
                    ),
                    'Product.online_status' => array(
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
        $this->set('icon', 'cart');
        
        $this->Auth->allow('uploadPhotos');
        
        /**
         * we do this to ensure our index page
         * will have the correct location data for our location operator
         */

        $this->DataTable->settings['Product']['joins'][0]['conditions']['LocationProduct.fk_id_map_objects'] = 
                !$this->admin ? $this->userLocation : '';
    }
    
    public function isAuthorized($user) {
        if ($this->locationOperator || $this->operator) {
            // ako je locOperator pogledaj jesmo li u add akciji
            // ako da vidi da li ID pripada lokaciji usera ulogovanog
            if (in_array($this->action, array('add'))) {
                        
                return $this->request->params['pass'][0] === $this->userLocation;
            }
            //izbaci iz igre index i ovaj za dataTable
            //gucking strict checking vidim nesto ne daje dobre rezultaet
            // plus samo udji tu kad imamo pass onda gledaj
            // inace je to onda idnex akcija, za sve ostalo imamo dozvolu
            if (!in_array($this->action, array('index'), true) && !empty($this->request->params['pass'])) {
                return $this->Product->productBelongsToUsersLocation($this->userLocation, $this->request->params['pass'][0]);       
            }
            
            return true;
        }

        if (in_array($this->action, array('add', 'delete')) && $this->admin) {
            return true;
        }

        return parent::isAuthorized($user);
    }    

    public $helpers =  array('DataTable.DataTable', 'Time');

    public function index() {
        $this->DataTable->setViewVar('Product');
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        $options = array(
            'conditions' => array('Product.' . $this->Product->primaryKey => $id),
            'contain' => array(
                'ProductFeature', 
                'ProductImage', 
                'Location' => array(
                    'fields' => array(
                        'Location.id',
                        'Location.name',
                        'Location.fk_id_cities'
                    )
                )
            )
        );
        $this->set('product', $this->Product->find('first', $options));
        $this->render('view2');
    }

    /**
     * gallery method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function gallery($id) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Ne postoji proizvod za dati id'));
        }
        $this->Product->recursive = -1;
        $mainImageQuery = $this->Product->find('first', array(
            'fields' => array(
                'Product.img_name',
                'Product.name'
            ),
            'conditions' => array(
                'Product.id' => $id
            )
        ));
        $mainImage = $mainImageQuery['Product']['img_name'];
        $productName = $mainImageQuery['Product']['name'];

        $images = $this->Product->ProductImage->find('all', array(
            'conditions' => array(
                'ProductImage.fk_id_products' => $id
            )
        ));
        $this->set(compact('images', 'mainImage', 'id', 'productName'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($idLocation = null) {
        if ($this->request->is('post')) {
            $this->Product->create();
            // ako je ulogovan locationOperator onda samo dodaj grad i lokaciju u niz
            if ($this->locationOperator || $this->operator) {
                $this->request->data = 
                        Hash::merge($this->request->data, 
                                $this->Product->addLocationAndCity($this->userLocation));
            }
            
            if ($this->Product->saveAll($this->request->data)) {
                $this->Flash->success(__('Uspješno ste dodali podatke o proizvodu. Molimo Vas dodajte nove fotografije za proizvod.'));
                $id = $this->Product->getLastInsertID();
                $this->redirect(array('action' => 'gallery', $id));
            } else {
                $this->Flash->error(__('Nije moguće sačuvati podatke, molimo Vas pokušajte ponovo!'));
            }
        }        
        
        $cities = $this->Product->Location->City->find('list');
        
        $cityId = '';
        if ($idLocation !== null) {
            $cityId = $this->Product->Location->cityIdLocationIsFrom($idLocation);
            $locationsForCity = $this->Product->Location->getCityLocations($cityId);
            $this->set('location', (int)$idLocation);
            $this->set('cityId', (int)$cityId);
            $this->set('locationsForCity', $locationsForCity);
        }
        
        $this->set(compact('cities'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
          throw new NotFoundException(__('Ne postoji proizvod'));
        }
        
        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.id' => $id
            ),
            'contain' => array(
                'Location' => array(
                    'fields' => array(
                        'Location.id'
                    )
                )
            )
        ));  
        $locations = $this->Product->Location->find('list');
        $this->set(compact('product', 'locations'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Product->deleteAll()) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    // AJAX METHODS
    public function deleteProduct() {
        $this->request->allowMethod('ajax');
        $this->autoRender = false;
        $id = $this->request->data['pk'];
        if ($this->Product->deleteProduct($id)) {
            echo '200';exit();
        }
        echo '404';exit();
    } 

    public function editStatus()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {

            $this->Product->id = $this->request->data['pk'];
            if ($this->Product->saveField('online_status', $this->request->data['value'])) {
                echo 'da';
            } else {
                echo 'ne';
            }
        }
    }
    
    public function getLocations() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            echo json_encode($this->Product->Location->getAllLocations());
        }
    }    
    
    public function location() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            return $this->Product->Location->find('all');
        }
    }    

    public function uploadPhotos() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $id = $this->request->data['idLocation'];
            $filename = $this->uploadFile($this->request->params['form']['file'], 'photos/products/');
            
            if ($this->Product->saveImage($id, $filename)) {
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
     * TODO: premjestiti sve ovo u neki behavior
     */
    public function deleteImage() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $fid = $this->request->data['fid'];// id slike
            $jpg = $this->request->data['jpg'];
            if ($this->Product->deleteImage($fid, $jpg)) {
                echo '200';
            } else {
                echo '404';
            }
        }
    }    

    public function editable() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $this->Product->id = $this->request->data['pk'];
            $field = $this->request->data['name'];
            $value = $this->request->data['value'];
            if ($this->Product->saveField($field, $value)){
                echo '200';
            } else {
                echo 'error';
            }
        }
    }
    public function saveLocations() {
        $this->autoRender = false;
        $this->request->allowMethod('ajax');
        $this->Product->id = $this->request->data['pk'];
        
        if ($this->Product->exists()) {
            $this->Product->saveAllLocationsForProduct($this->request->data['pk'], $this->request->data['value']);
        } 
    }
}
