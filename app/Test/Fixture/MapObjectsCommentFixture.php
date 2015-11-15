<?php
/**
 * MapObjectsComment Fixture
 */
class MapObjectsCommentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'text' => array('type' => 'string', 'null' => true, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'rating' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'comment_rating' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'fk_id_map_objects' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'fk_id_users' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_id_map_objects' => array('column' => 'fk_id_map_objects', 'unique' => 0),
			'fk_id_users' => array('column' => 'fk_id_users', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'text' => 'Lorem ipsum dolor sit amet',
			'rating' => 1,
			'datetime' => '2015-10-26 13:42:35',
			'comment_rating' => 1,
			'fk_id_map_objects' => 1,
			'fk_id_users' => 1
		),
	);

}
