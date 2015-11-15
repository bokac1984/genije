<?php
App::uses('AppModel', 'Model');
/**
 * ProductFeature Model
 *
 */
class ProductFeature extends AppModel {
       
    public $useTable = 'products_features'; 
    public $primaryKey = 'id';
    public $displayField = 'title';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'fk_id_products',
            'dependent' => false,
        )
    );
}
