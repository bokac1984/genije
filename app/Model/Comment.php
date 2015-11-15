<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 */
class Comment extends AppModel {
       
    public $useTable = 'map_objects_comments'; 
    public $primaryKey = 'id';

    public $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
        ),
    );
}
