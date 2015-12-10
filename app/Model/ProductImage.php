<?php

App::uses('AppModel', 'Model');

/**
 * ProductsImage Model
 *
 * @property Product $Product
 */
class ProductImage extends AppModel {

    public $useTable = 'products_images';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'fk_id_products',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * Delete all images from db and file system
     * 
     * @param int $productId
     * @return array
     */
    public function deleteImages($productId = null) {
        if ($productId) {
            $imageNames = $this->getAllImageNames($productId);
            $conditions = array(
                'conditions' => array(
                    'ProductImage.fk_id_products' => $productId
                )
            );
            if ($this->deleteAll($conditions)) {
                return $this->deleteAllImages('/photos/products/', $imageNames);
            }
        }
        
        return array();
    }
    
    public function getAllImageNames($productId = null) {
        $images = $this->find('all', array(
            'conditions' => array(
                'ProductImage.fk_id_products' => $productId
            ),
            'fields' => array(
                'ProductImage.id',
                'ProductImage.img_name'
            )
        ));
        
        return $images;
    }
}
