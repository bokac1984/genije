<?php

App::uses('AppModel', 'Model');

/**
 * Subscription Model
 *
 * @property AdminUsers $AdminUsers
 * @property Plan $Plan
 */
class Subscription extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'admin_users_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'plans_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );

    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'admin_users_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Plan' => array(
            'className' => 'Plan',
            'foreignKey' => 'plans_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function subExists($userID = null) {
        $postoji = $this->find('count', array(
            'conditions' => array(
                'Subscription.admin_users_id' => $userID,
                'Subscription.decline_reason_id' => null,
            )
        ));
        
        return $postoji === 0;
    }
}
