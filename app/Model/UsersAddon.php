<?php
App::uses('AppModel', 'Model');
/**
 * UsersAddon Model
 *
 * @property AdminUsers $AdminUsers
 * @property Addons $Addons
 */
class UsersAddon extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'admin_users_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'addons_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'AdminUsers' => array(
			'className' => 'AdminUsers',
			'foreignKey' => 'admin_users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Addons' => array(
			'className' => 'Addons',
			'foreignKey' => 'addons_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
