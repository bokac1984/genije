<?php
App::uses('AppModel', 'Model');
/**
 * LocationAdmin Model
 *
 */
class LocationAdmin extends AppModel {
       
    public $useTable = 'map_objects_users'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
        ),
    );
}
