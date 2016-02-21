<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class Contact extends AppModel {    
    public $useTable = 'map_objects_contacts'; 
    public $displayField = 'value';
    public $belongsTo = array(
        'ContactType' => array(
            'className' => 'ContactType',
            'foreignKey' => 'fk_id_contact_types',
        ),
       
    );
    
    public function prepareContacts($contactData = array()) {
        $valuesToSearch = array(
		'mobile' => '2',
		'phone' => '1',
		'email' => '4',
		'web' => '3',
	);
        $temp = array();
        foreach ($contactData as $name => $value) {
            if (array_key_exists($name,$valuesToSearch)) {
                $temp[] = array(
                    'fk_id_contact_types' => $valuesToSearch[$name],
                    'value' => $value === '' ? ' ' : $value
                );
            }
        }
        
        return $temp;
    }  
}
