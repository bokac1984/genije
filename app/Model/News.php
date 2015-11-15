<?php
App::uses('AppModel', 'Model');
/**
 * News Model
 * @property City $City
 * @property Location $Location 
 * @property Event $Event
 * @property Gallery $Gallery
 */
class News extends AppModel {
       
    public $useTable = 'news'; 
    
    public $primaryKey = 'id';
    
    public $displayField = 'title';
    
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
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);
        
        foreach ($results as $key => $val) {
            if (isset($val[$this->name]['online_status'])) {
                $results[$key][$this->name]['online_status'] = $this->modifyOnlineStatus($val[$this->name]['online_status'],$val[$this->name]['id'], '/news/editStatus/');
            }
            
            if (isset($val[$this->name]['fk_id_map_objects'])) {
                $results[$key][$this->name]['fk_id_map_objects'] = $this->Location->getLocationName($val[$this->name]['fk_id_map_objects']);
            } 
            if (isset($val[$this->name]['fk_id_events'])) {
                $results[$key][$this->name]['fk_id_events'] = $this->Event->getEventName($val[$this->name]['fk_id_events']);
            }            
        }
        return $results;
    }    
    
    public function saveNews($data = array()) {
        $data['News']['show_products'] = $data['News']['show_products'] === 'on' ? true : false;
        
        if ($this->save($data)) {
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
}
