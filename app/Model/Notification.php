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
    
    public $belongsTo = array(
        'ApplicationUser' => array(
            'className' => 'ApplicationUser',
            'foreignKey' => 'fk_id_users',
        ),
    );
    
    public function beforeSave($options = array()) {
        $this->data[$this->alias]['date'] = $this->getDataSource()->expression('NOW()');

        return parent::beforeSave($options);
    }    
}
