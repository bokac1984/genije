<?php

App::uses('AppModel', 'Model');

/**
 * NewsComment Model
 *
 * @property NewsComment $ParentNewsComment
 * @property News $News
 * @property ApplicationUser $ApplicationUsers
 * @property NewsComment $ChildNewsComment
 */
class NewsComment extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'ParentNewsComment' => array(
            'className' => 'NewsComment',
            'foreignKey' => 'parent_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'News' => array(
            'className' => 'News',
            'foreignKey' => 'fk_id_news',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ApplicationUser' => array(
            'className' => 'ApplicationUser',
            'foreignKey' => 'fk_id_users',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'ChildNewsComment' => array(
            'className' => 'NewsComment',
            'foreignKey' => 'parent_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
