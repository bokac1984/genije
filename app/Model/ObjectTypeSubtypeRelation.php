<?php
App::uses('AppModel', 'Model');
/**
 * ObjectTypeSubtypeRelation Model
 *
 */
class ObjectTypeSubtypeRelation extends AppModel {
       
    public $useTable = 'object_type_subtype_relations'; 
    public $belongsTo = array(
        'ObjectSubtype' => array(
            'className' => 'ObjectSubtype',
            'foreignKey' => 'fk_id_object_subtypes',
        ),
       
    );
}
