<?php

App::uses('AppModel', 'Model');

/**
 * Product Model
 *
 * @property ProductFeature $ProductFeature
 * @property MapObject $MapObject
 * @property ProductImage $ProductImage
 */
class Product extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

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
                //return $this->updateMainImage($id, $filename);
            }
        }

        return false;
    }
}
