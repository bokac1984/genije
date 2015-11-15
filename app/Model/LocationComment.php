<?php

App::uses('AppModel', 'Model');

/**
 * LocationComment Model
 *
 * @property Location $Location
 * @property ApplicationUser $ApplicationUser
 */
class LocationComment extends AppModel {

    public $useTable = 'map_objects_comments';

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ApplicationUser' => array(
            'className' => 'ApplicationUser',
            'foreignKey' => 'fk_id_users',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
