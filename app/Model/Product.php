<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 */
class Product extends AppModel {
       
    public $useTable = 'products'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public $hasMany = array(
        'ProductFeature' => array(
            'className' => 'ProductFeature',
            'foreignKey' => 'fk_id_products',
        ),
    );
}
