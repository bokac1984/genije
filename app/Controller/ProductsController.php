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
                'columns' => array(
                    'id' => array(
                        'label' => '#',
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => 'true'
                    ),
                    'name' => array(
                        'label' => 'Naziv',
                        'sWidth' => '10%',
                        'bSortable' => 'false'
                    ),
                    'description' => array(
                        'label' => 'Opis',
                        'sWidth' => '30%',
                        'bSortable' => 'false',
                        'bSearchable' => true
                    ),
                    'price' => array(
                        'label' => 'Cijena',
                        'sWidth' => '10%',
                        'bSortable' => 'false'
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
        $this->set('icon', 'barcode');
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
                'ProductFeature', 'ProductImage'
            )
        );
        $this->set('product', $this->Product->find('first', $options));
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
        $mainImage = $this->Product->find('first', array(
            'fields' => array(
                'Product.img_name'
            ),
            'conditions' => array(
                'Product.id' => $id
            )
        ));
        $mainImage = $mainImage['Product']['img_name'];

        $images = $this->Product->ProductImage->find('all', array(
            'conditions' => array(
                'ProductImage.fk_id_products' => $id
            )
        ));
        $this->set(compact('images', 'mainImage', 'id'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $this->request->data = $this->Product->find('first', $options);
        }
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
        if ($this->Product->delete()) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    // AJAX METHODS
    public function validateProducts() {
        $this->request->allowMethod('ajax');
        $this->autoRender = false;
        debug($this->request->data);
        echo $this->Product->validates($this->request->data);
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

    public function uploadPhotos() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $id = $this->request->data['idLocation'];
            $filename = $this->uploadFile($this->request->params['form']['file'], '/photos/products/');

            if ($this->Product->saveImage($id, $filename)) {
                echo $filename;
                exit();
            } else {
                echo 'ne radi upload';
            }
        }
        echo '404';
    }

}
