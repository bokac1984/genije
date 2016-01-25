<?php

App::uses('AppController', 'Controller');

class NewsController extends AppController {

    public $uses = array('News');
    public $components = array(
        'DataTable.DataTable' => array(
            'News' => array(
                'columns' => array(
                    'id' => array(
                        'label' => '#',
                        'sWidth' => '5%',
                        'sClass' => 'center',
                        'bSortable' => 'true'
                    ),
                    'title' => array(
                        'label' => 'Naslov',
                        'sWidth' => '10%',
                        'bSortable' => 'false'
                    ),
                    'lid' => array(
                        'label' => 'Lid',
                        'sWidth' => '10%',
                        'bSortable' => 'false',
                        'bSearchable' => true
                    ),
                    'creation_date' => array(
                        'label' => 'Datum',
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
                    'fk_id_events' => array(
                        'label' => 'Događaj',
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
        $this->set('icon', 'note');
        if ($this->request->is('ajax')) {
            $this->disableCache();
        }
    }

    public $helpers = array('DataTable.DataTable');

    public function index() {
        $this->DataTable->setViewVar('News');
    }

    public function edit($id = null) {
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }

        $news = $this->News->findById($id);

        $galleryId = $news['News']['fk_id_gallery'];

        $image = $this->News->Gallery->find('first', array(
            'joins' => array(
                array('table' => 'news_images',
                    'alias' => 'NewsImage',
                    'type' => 'INNER',
                    'conditions' => array(
                        'NewsImage.fk_id_news' => $id,
                        'NewsImage.fk_id_gallery' => $galleryId
                    )
                )
            ),
            'fields' => array(
                'Gallery.img_name'
            ),
            'conditions' => array(
                'Gallery.id' => $galleryId
            )
        ));

        $this->set(compact('news', 'image'));
    }

    public function add() {
        $cities = $this->News->City->find('list');
        $this->set(compact('cities'));
    }
    public function view($id = null) {
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $this->News->recursive = 1;
        $news = $this->News->find('first', array('conditions' => array('News.id' => $id)));
        $this->set(compact('news'));
    }

    public function images($id = null) {
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__('Ne postoji odabrana vijest.'));
        }
        $news = $this->News->find('first', array('conditions' => array('News.id' => $id)));

        $images = $this->News->Gallery->find('all', array(
            'joins' => array(
                array('table' => 'news_images',
                    'alias' => 'NewsImage',
                    'type' => 'INNER',
                    'conditions' => array(
                        'NewsImage.fk_id_news' => $id,
                        'NewsImage.fk_id_gallery = Gallery.id'
                    )
                )
            ),
            'fields' => array(
                'Gallery.*'
            )
        ));

        $this->set(compact('images', 'news'));
    }

    // AJAX METHODS
    public function saveNews() {
        $this->request->onlyAllow('ajax');
        $this->autoRender = false;
        echo $this->News->saveNews($this->request->data);
        exit();
    }

    public function editStatus() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {

            $this->News->id = $this->request->data['pk'];
            if ($this->News->saveField('online_status', $this->request->data['value'])) {
                echo 'da';
            } else {
                echo 'ne';
            }
        }
    }

    public function showproducts() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->News->id = $this->request->data['id'];
            $value = $this->request->data['value'] == 'true' ? true : false;
            if ($this->News->saveField('show_products', $value)) {
                echo 'da';
            } else {
                echo 'ne';
            }
        }
    }

    public function events() {
        $this->request->onlyAllow('ajax');
        $this->viewClass = 'Json';
        $events = $this->News->Event->getAllLocationEvents($this->request->data['location']);
        $this->set(compact('events'));
    }

    public function deleteNews() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $id = $this->request->data['pk'];
            $this->News->id = $id;
            if (!$this->News->exists()) {
                echo '404';
                exit();
            }
            if ($this->News->delete($id)) {
                echo '200';
                exit();
            } else {
                echo '404';
                exit();
            }
        }
    }

    public function editable() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->News->id = $this->request->data['pk'];
            $field = $this->request->data['name'];
            $value = $this->request->data['value'];
            if ($this->News->saveField($field, $value)) {
                echo 'radi';
            } else {
                echo 'error';
            }
        }
    }

    public function uploadPhotos() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $newsId = $this->request->data['idNews'];
            $filename = $this->uploadFile($this->request->params['form']['file'], '/photos/news/');

            if ($this->News->saveImageData($newsId, $filename)) {
                exit();
            } else {
                echo 'ne radi upload';
            }
        }
        echo '404';
    }

    public function deleteImage() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $fid = $this->request->data['fid']; // id slike
            $jpg = $this->request->data['jpg'];
            if ($this->News->deleteImage($fid, $jpg)) {
                echo '200';
                exit();
            }
        }
        echo '404';
    }

    /**
     * Postavlja za glavnu sliku
     */
    public function makeCover() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->News->id = $this->request->data['id'];
            if (!$this->News->exists()) {
                echo '404';
            } else {
                if ($this->News->saveField('fk_id_gallery', $this->request->data['cover'])) {
                    echo '200';
                } else {
                    echo '404';
                }
            }
            exit();
        }
    }

    public function locationProducts() {
        //$this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        $id = $this->request->data['id'];
        $this->News->Location->id = $id;
        if (!$this->News->Location->exists()) {
            throw new NotFoundException(__('Ne postoji lokacija'));
        }
        $options['joins'] = array(
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
            'Product.online_status' => 2
        );
        $options['fields'] = array(
            'Product.id',
            'Product.name',
            'Product.img_name',
            'Product.price',
            'Product.description'
        );
        $products = $this->News->Location->Product->find('all', $options);
        $this->set(compact('products'));
    }   
}
