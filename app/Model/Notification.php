<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class Notification extends AppModel {
       
    public $useTable = 'notifications'; 
    public $primaryKey = 'id';
    public $displayField = 'title';
    
    public $hasMany = array(
        'ApplicationUser' => array(
            'className' => 'ApplicationUser',
            'foreignKey' => 'fk_id_users',
        ),
    );
}
