<?php
App::uses('AppModel', 'Model');
/**
 * CityImage Model
 *
 */
class CityImage extends AppModel {
       
    public $useTable = 'cities_images'; 
    public $primaryKey = 'id';
    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'fk_id_cities',
        ),
    );
}
