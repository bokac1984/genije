<?php
App::uses('AppModel', 'Model');

/**
 * Ticket Model
 * @property Event $Event
 * @property ApplicationUser $ApplicationUser
 * @property Location $Location
 */
class Ticket extends AppModel {
       
    public $useTable = 'events_tickets'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public $actsAs = array('Containable');
    
    public $belongsTo = array(
        'Event' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_events',
        ),
        'ApplicationUser' => array(
            'className' => 'ApplicationUser',
            'foreignKey' => 'fk_id_users',
        ),
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
        ),        
    );    
}
