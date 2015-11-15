<?php
/**
 * NewsImage Fixture
 */
class NewsImageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'fk_id_news' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'fk_id_gallery' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('fk_id_news', 'fk_id_gallery'), 'unique' => 1),
			'fk_id_gallery' => array('column' => 'fk_id_gallery', 'unique' => 0)
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
			'fk_id_news' => 1,
			'fk_id_gallery' => 1
		),
	);

}
