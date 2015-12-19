<?php
App::uses('AppModel', 'Model');
/**
 * City Model
 * 
 * @property CityImage $CityImage Ovo je model slika za vijesti
 * @property Location $Location Model lokacija, tj radnja i svih ostalih butika kafana itd.
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
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_cities',
        )          
    );
}
