<?php

App::uses('AppModel', 'Model');

/**
 * CouponCheckerLogin Model
 *
 * @property CouponChecker $CouponChecker
 */
class CouponCheckerLogin extends AppModel {

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'map_objects_users_login';


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'CouponChecker' => array(
            'className' => 'CouponChecker',
            'foreignKey' => 'fk_id_map_objects_users',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
