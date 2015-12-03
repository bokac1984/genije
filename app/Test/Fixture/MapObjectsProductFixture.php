<?php
/**
 * MapObjectsProduct Fixture
 */
class MapObjectsProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'fk_id_map_objects' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'fk_id_products' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('fk_id_map_objects', 'fk_id_products', 'id'), 'unique' => 1),
			'idx_map_objects_products_id' => array('column' => 'id', 'unique' => 1),
			'fk_id_products' => array('column' => 'fk_id_products', 'unique' => 0)
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
			'fk_id_map_objects' => 1,
			'fk_id_products' => 1
		),
	);

}
