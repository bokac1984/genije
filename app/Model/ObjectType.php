<?php
App::uses('AppModel', 'Model');
/**
 * ObjectType Model
 *
 */
class ObjectType extends AppModel {
       
    public $useTable = 'object_types'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public $hasMany = array(
        'ObjectTypeSubtypeRelation' => array(
            'className' => 'ObjectTypeSubtypeRelation',
            'foreignKey' => 'fk_id_object_types',
        )       
    );    
}
