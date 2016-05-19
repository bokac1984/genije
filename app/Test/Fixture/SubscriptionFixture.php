<?php
/**
 * Subscription Fixture
 */
class SubscriptionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'additional_data' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'start_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'admin_users_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'plans_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_subscriptions_admin_users_idx' => array('column' => 'admin_users_id', 'unique' => 0),
			'fk_subscriptions_plans1_idx' => array('column' => 'plans_id', 'unique' => 0)
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
			'additional_data' => 'Lorem ipsum dolor sit amet',
			'start_date' => '2016-05-09 12:57:12',
			'end_date' => '2016-05-09 12:57:12',
			'admin_users_id' => 1,
			'plans_id' => 1
		),
	);

}
