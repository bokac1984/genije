<?php
App::uses('AppModel', 'Model');
/**
 * News Model
 * @property City $City Model grada
 * @property Location $Location Model lokacije
 * @property Event $Event Model dogadjaja
 * @property Gallery $Gallery Model galerije slika
 */
class News extends AppModel {
       
    public $useTable = 'news'; 
    
    public $primaryKey = 'id';
    
    public $displayField = 'title';
    
    public $actsAs = array(
        'Deletable' => array(
            'baseImageLocation' => '/photos/'
        ),
        //'Online'
    );
    
    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'fk_id_cities',
        ),
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'fk_id_events',
        ),
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
        ),        
    );
    
    public $hasAndBelongsToMany = array(
        'Gallery' => array(
            'className' => 'Gallery',
            'joinTable' => 'news_images',
            'foreignKey' => 'fk_id_news',
            'associationForeignKey' => 'fk_id_gallery',
            'unique' => 'keepExisting',
        ),
        'Product' => array(
            'className' => 'Product',
            'joinTable' => 'news_products',
            'foreignKey' => 'fk_news_id',
            'associationForeignKey' => 'fk_product_id',
            'unique' => 'keepExisting',            
        ),         
    );
    
    public $hasMany = array(
        'NewsComment' => array(
            'className' => 'NewsComment',
            'foreignKey' => 'fk_id_news',
        ),        
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['title']) && empty($this->data[$this->alias]['title'])) {
            $this->data[$this->alias]['title'] = null;
        }
        
        if (isset($this->data[$this->alias]['lid']) && empty($this->data[$this->alias]['lid'])) {
            $this->data[$this->alias]['lid'] = null;
        }

        return parent::beforeSave($options);
    }


    public function saveNews($data = array()) {
        $data['News']['show_products'] = isset($data['News']['show_products']) ? true : false;
        
        if ($this->saveAll($data) ) {
            return $this->getLastInsertID();
        }
        return 0;
    }    
    
    public function saveImageData($id, $filename = '') {
        if ('' !== $filename) {
            $data = array(
                'News' => array(
                    'id' => $id
                ),
                'Gallery' => array(
                    'img_name' => $filename
                )
            );
            
            if ($this->Gallery->saveAll($data)) {
                $imgId = $this->getLastSavedGalleryId($id);
                return $this->updateMainImage($id, $imgId);
            }
        } 
        
        return false;
    }   
    
    public function getLastSavedGalleryId($id = null) {
        $galleryId = $this->Gallery->find('first', array(
            'joins' => array(
                array(
                    'table' => 'news_images',
                    'alias' => 'NewsImage',
                    'type' => 'INNER',
                    'conditions' => array(
                        'NewsImage.fk_id_news' => $id,
                        'NewsImage.fk_id_gallery = Gallery.id'
                    )
                )
            ),
            'fields' => array(
                'NewsImage.fk_id_gallery'
            ),
            'order' => array(
                'Gallery.created' => 'DESC'
            )
        ));
        
        if (count($galleryId) > 0) {
            return $galleryId['NewsImage']['fk_id_gallery'];
        }
        
        return '';
    }
    
    /**
     * 
     * @param int $id
     * @param int $imgId
     * @return boolean
     */
    public function updateMainImage($id, $imgId) {
        $imaSlike = $this->getMainImage($id);
        debug($imaSlike);
        if ('' === $imaSlike) {
            return $this->setMainImage($id, $imgId);
        }
        
        return true;
    }   
    
    /**
     * 
     * @param int $id
     * @param int $imgId
     * @return boolean
     */
    public function setMainImage($id, $imgId) {
        $data = array(
            'id' => $id,
            'fk_id_gallery' => $imgId
        );
        
        return $this->save($data);
    }
    /**
     * 
     * @param int $id
     * @return string
     */
    public function getMainImage($id) {
        $image = $this->find('first', array(
            'conditions' => array(
                'News.id' => $id,
                'News.fk_id_gallery <> ' => null
            ),
            'fields' => array(
                'News.fk_id_gallery'
            )
        ));
       if (count($image) > 0) {
           return $image['News']['fk_id_gallery'];
       }
       return '';
    } 
    
    public function deleteImage($fid = null, $jpg = '') {
        $this->Gallery->imageToDelete = $jpg;
        return $this->Gallery->delete($fid);
    }
    
    /**
     * Vrati sve vijesti za odredjenu lokaciju
     * 
     * @param int $id
     * @return arraz
     */
    public function locationNews($id = null) {
        if ($id) {
            return $this->find('all', array(
                'conditions' => array(
                    'News.fk_id_map_objects' => $id
                )
            ));
        }
    }
    
    /**
     * Pogledaj da li ova lokacija koja se gleda pripada lokaciji korisnika
     * 
     * @param int $userLocation
     * @param int $newsId
     * @return boolean
     */
    public function newsBelongsToUsersLocation ($userLocation, $newsId) {
        $newsLocation = $this->find('all',array(
                'conditions' => array(
                    'News.fk_id_map_objects' => $userLocation,
                    'News.id' => $newsId
                ),
            'fields' => array(
                'News.fk_id_map_objects AS location'
            )
        ));
        
        return !empty($newsLocation);
    }    
    
    public function countPublishedNews($userLocation = null) {
        return $this->find('count', array(
            'conditions' => array(
                'News.fk_id_map_objects' => $userLocation
            )
        ));
    }
    
    public function beforeFind($query) {
        //debug($query);exit();
        parent::beforeFind($query);
    }
}
