<?php

App::uses('AppModel', 'Model');

/**
 * Product Model
 *
 * @property ProductFeature $ProductFeature
 * @property Location $Location
 * @property ProductImage $ProductImage
 */
class Product extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    
    /**
     *
     * @var int 
     */
    public $deletedProductId;

    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'ProductFeature' => array(
            'className' => 'ProductFeature',
            'foreignKey' => 'fk_id_products',
            'dependent' => false,
        ),
        'ProductImage' => array(
            'className' => 'ProductImage',
            'foreignKey' => 'fk_id_products',
            'dependent' => false,
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Location' => array(
            'className' => 'Location',
            'joinTable' => 'map_objects_products',
            'foreignKey' => 'fk_id_products',
            'associationForeignKey' => 'fk_id_map_objects',
            'unique' => 'keepExisting',
        )
    );

    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);

        foreach ($results as $key => $val) {
            if (isset($val[$this->name]['online_status'])) {
                $results[$key][$this->name]['online_status'] = $this->modifyOnlineStatus($val[$this->name]['online_status'],$val[$this->name]['id'], '/products/editStatus/');
            }
        }
        return $results;
    }

    public function saveImage($id, $filename) {
        if ('' !== $filename) {
            $data = array(
                'fk_id_products' => $id,
                'img_name' => $filename
            );

            if ($this->ProductImage->save($data)) {
                $this->updateMainImage($id, $filename);
                return true;
            }
        }

        return false;
    }
    
    /**
     * 
     * @param int $id
     * @param string $filename
     */
    public function updateMainImage($id, $filename) {
        if (!$this->hasMainImage($id)) {
            $data = array(
                'id' => $id,
                'img_name' => $filename
            );
            $this->save($data);
        }
    }
    
    /**
     * 
     * @param int $id
     * @return bool
     */
    public function hasMainImage($id) {
        $mainImage = $this->find('count', array(
            'conditions' => array(
                'Product.id' => $id
            )
        ));
        
        return $mainImage > 0;
    }
    
    /**
     * Trebalo bi prvo obrisati podatke sve vezano za proizvod 
     * pa onda obrisati i slike za ovaj proizvod
     * 
     * @param int $id ID proizvoda za brisanje
     */
    public function deleteProduct($id = null) {
        if ($id) {
            $this->id = $id;
            $this->deletedProductId = $id;
            //$this->ProductImage->deleteImages($this->deletedProductId);
            if ($this->delete()) {
                return 'success';
            }
        }
    }
    
    public function afterDelete() {
        parent::afterDelete();
        
        if ($this->deletedProductId) {
            $notDeleted = $this->ProductImage->deleteImages();
            
            $this->log($notDeleted);
        }
    }

}
