<?php
/**
 * UsersAddon Fixture
 */
class UsersAddonFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'start_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'admin_users_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'addons_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'admin_users_id', 'addons_id'), 'unique' => 1),
			'fk_users_addons_admin_users1_idx' => array('column' => 'admin_users_id', 'unique' => 0),
			'fk_users_addons_addons1_idx' => array('column' => 'addons_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'start_date' => '2016-05-09 12:57:34',
			'end_date' => '2016-05-09 12:57:34',
			'created' => '2016-05-09 12:57:34',
			'modified' => '2016-05-09 12:57:34',
			'admin_users_id' => 1,
			'addons_id' => 1
		),
	);

}
