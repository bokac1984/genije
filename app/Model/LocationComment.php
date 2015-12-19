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
    
    /**
     * Nadji sve komentare za lokaciju
     * 
     * @param int $locationId
     * @return array results if not empty location id
     */
    public function getAllLocationComments($locationId = null) {
        if ($locationId) {
            return $this->find('all', array(
                'conditions' => array(
                    'LocationComment.fk_id_map_objects' => $locationId
                ),
                'limit' => 10,
                'contain' => array(
                    'ApplicationUser' => array(
                        'fields' => array(
                            'ApplicationUser.id', 'ApplicationUser.display_name'
                        )
                    )
                ),
                'order' => array(
                    'LocationComment.datetime DESC'
                )
            ));
        }
        
        return array();
    }
}
