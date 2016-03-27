<?php
App::uses('AppModel', 'Model');
App::uses('File', 'Utility');
/**
 * Contact Model
 *
 * @property Contact $Contact
 * @property LocationDescription $LocationDescription
 * @property MapObjectSubtypeRelation $MapObjectSubtypeRelation
 * @property City $City
 * @property LocationComment $LocationComment
 * @property LocationImage $LocationImage
 */
class Location extends AppModel {
       
    public $useTable = 'map_objects'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public $actsAs = array(
        'Deletable' => array(
            'baseImageLocation' => '/photos/'
        ),
    );
     
    public $hasMany = array(
        'Contact' => array(
            'className' => 'Contact',
            'foreignKey' => 'fk_id_map_objects',
        ),
        'LocationDescription' => array(
            'className' => 'LocationDescription',
            'foreignKey' => 'fk_id_map_objects',
        ),
        'MapObjectSubtypeRelation' => array(
            'className' => 'MapObjectSubtypeRelation',
            'foreignKey' => 'fk_id_map_objects',
        ),
        'LocationComment' => array(
            'className' => 'LocationComment',
            'foreignKey' => 'fk_id_map_objects',
        ),
        'LocationImage' => array(
            'className' => 'LocationImage',
            'foreignKey' => 'fk_id_map_objects',
        ),
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'fk_id_map_objects',
        ),
        'News' => array(
            'className' => 'News',
            'foreignKey' => 'fk_id_map_objects',
        )
    );
    
    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'fk_id_cities',
        ),
    );
    
    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Product' => array(
            'className' => 'Product',
            'joinTable' => 'map_objects_products',
            'associationForeignKey' => 'fk_id_products',
            'foreignKey' => 'fk_id_map_objects'
        )
    );
    
    /**
     * Snima lokaciju i veze sa tipovima lokacija
     * @param type $data
     * @return string HTTP status code
     */
    public function saveNewLocation($data = array()) {      
        $dataToSave = array(
            'Location' => $data['Location'],
            'Contact' => $this->Contact->prepareContacts($data['Contact']),
            'LocationDescription' => $data['LocationDescription'],
        );
        
        if ($this->saveAll($dataToSave, array('deep' => true))) {
            $id = $this->getLastInsertID();
            if ($this->MapObjectSubtypeRelation->saveObjectSubtypes($id, $data['MapObjectSubtypeRelation']['sub_types'])) {
                return '200';
            }
        }
        
        return '404';
    }
    
    /**
     * 
     * @param int $id
     * @return string
     */
    public function getCityName($id) {
        $cityName = $this->City->find('first', array(
            'fields' => array('City.name'),
            'conditions' => array('City.id' => $id)
        ));
        
        return $cityName['City']['name'];
    }
    
    /**
     *
     * Nadji naziv lokacije
     * 
     * @param int $id
     * @return string
     */
    public function getLocationName($id) {
        $this->recursive = -1;
        $l = $this->find('first', array(
            'conditions' => array('id' => $id),
            'fields' => array('name')
        ));
        return $l['Location']['name'];
    }
//    /**
//     * Brise slike iz baze
//     * 
//     * @param int $id
//     * @param int $fid
//     * @param string $jpg
//     * @return boolean
//     */
//    public function deleteImage($id, $fid, $jpg) {
//        if ($this->LocationImage->delete($fid)) {
//            return $this->deleteImageFile($jpg, '/photos/');
//        }
//        //TODO: mozda napraviti da se provjeri je li ovo glavna slika, i ako jeste da izbrise i polje tamo
//        // je ce se na ovaj nacin pobrisati slika i ostace njen naziv i onda ce biti broken file name
//        return false;
//    }
    /**
     * 
     * @param type $id
     * @param type $filename
     * @return boolean
     */
    public function saveImageData($id, $filename = '') {
        if ('' !== $filename) {
            $data = array(
                'fk_id_map_objects' => $id,
                'img_name' => $filename
            );
            
            if ($this->LocationImage->save($data)) {
                return $this->updateMainImage($id, $filename);
            }
        } 
        
        return false;
    }
    
    /**
     * 
     * @param type $id
     * @param type $imgUrl
     * @return boolean
     */
    public function updateMainImage($id, $imgUrl) {
        if ('' === $this->getMainImage($id)) {
            return $this->setMainImage($id, $imgUrl);
        }
        
        return true;
    }
    /**
     * 
     * @param type $id
     * @param type $imageName
     * @return type
     */
    public function setMainImage($id, $imageName) {
        $data = array(
            'id' => $id,
            'img_url' => $imageName
        );
        
        return $this->save($data);
    }
    /**
     * 
     * @param type $id
     * @return string
     */
    public function getMainImage($id) {
        $image = $this->find('first', array(
            'conditions' => array(
                'Location.id' => $id
            ),
            'fields' => array(
                'Location.img_url'
            )
        ));

        return $image['Location']['img_url'];
    }
    /**
     * Brisi lokaciju, pobrisi slike i iz baze i sa server fajl sistema
     * 
     * @param int $id location id
     * @return string U zavisnosti od toga sta se desilo, vracamo 200 ako je pobrisano sve i sa servera i iz baze
     *                  a ako ne onda vracamo 300 ako su slike neke nepobrisane sa servera
     */
    public function deleteLocation($id = null) {
        $this->id = $id;
        if ($this->exists()) {
            $imgNames = $this->LocationImage->deleteImages($id);
            
            if ($this->delete($id)) {
                return count($imgNames) > 0 ? '300' : '200';
            }
        }
        
        return '404';
    }
    
    /**
     * 
     * @param int $cityId
     * @return array
     */
    public function getCityLocations($cityId = null) {
        $this->recursive = -1;
        $lokOut = array();
        $lokacije = $this->find('all', array(
            'conditions' => array(
                'Location.fk_id_cities' => $cityId
            ),
            'fields' => array(
                'Location.id',
                'Location.name'
            )
        ));
        
        if (count($lokacije) > 0) {
            foreach ($lokacije as $l) {
                $lokOut[] = array(
                    'id' => $l['Location']['id'],
                    'name' => $l['Location']['name']
                );
            }
        }
        
        return $lokOut;
    }
    
    /**
     * mainly for selects
     */
    public function getAllLocations() {
        $locations = $this->find('all', array(
            'fields' => array('id', 'name')
        ));
        $temp = array();
        if (count($locations) > 0) {
            foreach ($locations as $s) { 
                $temp[] = array(
                    'id' => $s['Location']['id'],
                    'text' => $s['Location']['name']
                );
            }
        }
        
        return $temp;
    }
    
    /**
     * 
     * @param int $status
     * @return type
     */
    public function getLocationsByStatus($status) {
        return $this->find('list', array(
            'conditions' => array(
                'Location.fk_id_cities' => 1,
                'Location.online_status' => $status
            )
        ));
    }
    
    public function locationsPerCity() {
        return $this->find('all', array(
            'fields' => array(
                'COUNT(Location.fk_id_cities) as cityCount'
            ),
            'group' => 'Location.fk_id_cities',
            'contain' => array(
                'City' => array(
                    'fields' => array(
                        'City.id',
                        'City.name'
                    )
                )
            )
        ));
    } 
    
    /**
     * Promjeni status ali vidi ima li slike glavne da se ovo uradi
     * 
     * @param int $status
     * @return int status code for response
     */
    public function updateStatus($status) {
        if ('' === $this->getMainImage($this->id)) {
            return 400;
        }
        return $this->saveField('online_status', $status) ? 200 : 400;
    }
}
