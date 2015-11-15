<?php

App::uses('AppModel', 'Model');

/**
 * AuthToken Model
 *
 * @property User $User
 */
class AuthToken extends AppModel {
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'fk_id_admin_users'
        )
    );

}
