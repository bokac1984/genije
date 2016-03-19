<?php
/**
 * MapObjectsUsersLogin Fixture
 */
class MapObjectsUsersLoginFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'map_objects_users_login';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'activation_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 16, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pin_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 180, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'access_token' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fk_id_map_objects_users' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'activation_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'activation_status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false, 'comment' => '0 - not activate, 1 - activate'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'access_token' => array('column' => 'access_token', 'unique' => 1),
			'fk_id_map_objects_users' => array('column' => 'fk_id_map_objects_users', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'activation_code' => 'Lorem ipsum do',
			'pin_code' => 'Lorem ipsum dolor sit amet',
			'access_token' => 'Lorem ipsum dolor sit amet',
			'fk_id_map_objects_users' => 1,
			'activation_date' => '2016-03-19 08:56:53',
			'activation_status' => 1
		),
	);

}
