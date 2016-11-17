<?php
/**
 * Plan Fixture
 */
class PlanFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'duration' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'price' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => 11, 'unsigned' => false),
		'news_quantity' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'events_quantity' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'products_quantity' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'location_images_quantity' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'news_images_quantity' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'coupon_quantity' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'duration' => 'Lorem ipsum dolor sit amet',
			'price' => '',
			'news_quantity' => 1,
			'events_quantity' => 1,
			'products_quantity' => 1,
			'location_images_quantity' => 1,
			'news_images_quantity' => 1,
			'coupon_quantity' => 1
		),
	);

}
