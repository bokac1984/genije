<?php

App::uses('AppModel', 'Model');

/**
 * Plan Model
 *
 */
class Plan extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    
    public function numberOfNewsToPublish($planId = null) {
        return $this->find('first', array(
            'conditions' => array(
                'Plan.id' => $planId
            ),
            'fields' => array(
                'Plan.news_quantity'
            )
        ));
    }    

}
