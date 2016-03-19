<?php

App::uses('AppModel', 'Model');

/**
 * MapObjectsUser Model
 *
 * @property Location $Location
 */
class CouponChecker extends AppModel {
    public $useTable = 'map_objects_users'; 

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
        )
    );

    public $hasOne = array(
        'CouponCheckerLogin' => array(
            'className' => 'CouponCheckerLogin',
            'foreignKey' => 'fk_id_map_objects_users',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function generateRandomString($length = 16) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }    
}
