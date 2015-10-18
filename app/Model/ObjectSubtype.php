<?php
App::uses('AppModel', 'Model');
/**
 * ObjectSubtype Model
 *
 */
class ObjectSubtype extends AppModel {
       
    public $useTable = 'object_subtypes'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public function getAllSubtypes() {
        $sub = $this->find('all', array(
            'fields' => array(
                'ObjectSubtype.id',
                'ObjectSubtype.name'
            )
        ));
        $temp = array();
        if ($sub) {
            foreach ($sub as $s) {
                
                $temp[] = array(
                    'id' => $s['ObjectSubtype']['id'],
                    'text' => $s['ObjectSubtype']['name']
                );
            }
        }
        
        return $temp;
    }
}