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

    public $actsAs = array(
        'Deletable' => array(
            'baseImageLocation' => '/photos/products/'
        ),
        'Online'
    );
    
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
            'associationForeignKey' => 'fk_id_map_objects'
        )
    );

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
            $this->log('izgleda da cuva sliku');
            $this->save($data);
        }
    }
    
    /**
     * Provjeravamo da li ima sliku
     * 
     * @param int $id
     * @return bool Vrati true ako ima sliku
     */
    public function hasMainImage($id) {
        $mainImage = $this->find('count', array(
            'conditions' => array(
                'Product.id' => $id,
                'Product.img_name' => NULL
            )
        ));
        $this->log('vijednost glavne slike je ' . $mainImage);
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
    
    public function saveAllLocationsForProduct($productId, $locationsIds) {
        $data =  array();
        foreach ($locationsIds as $subtype) {
            $data['Location'] = array(
                'id' => $subtype
            );
        }
        $data['Product']['id'] = $productId;
        return $this->Location->saveAll($data); 
    }    

}
