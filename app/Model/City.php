<?php
App::uses('AppModel', 'Model');
/**
 * City Model
 *
 */
class City extends AppModel {
       
    public $useTable = 'cities'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public $hasMany = array(
        'CityImage' => array(
            'className' => 'CityImage',
            'foreignKey' => 'fk_id_cities',
        ),
    );
}
