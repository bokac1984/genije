<?php
/**
 * EventsTicket Fixture
 */
class EventsTicketFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fk_id_events' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'fk_id_users' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'creation_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'code_status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false, 'comment' => '0 offline, 1 online, 2 used'),
		'fk_id_map_objects_users' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'checked_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'code' => array('column' => 'code', 'unique' => 1),
			'fk_id_events' => array('column' => 'fk_id_events', 'unique' => 0),
			'fk_id_users' => array('column' => 'fk_id_users', 'unique' => 0),
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
			'code' => 'Lorem ipsum dolor sit amet',
			'value' => 'Lorem ipsum dolor sit amet',
			'fk_id_events' => 1,
			'fk_id_users' => 1,
			'creation_date' => '2016-03-17 19:40:24',
			'code_status' => 1,
			'fk_id_map_objects_users' => 1,
			'checked_date' => '2016-03-17 19:40:24'
		),
	);

}
