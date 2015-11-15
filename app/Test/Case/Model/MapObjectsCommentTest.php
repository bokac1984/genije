<?php
App::uses('MapObjectsComment', 'Model');

/**
 * MapObjectsComment Test Case
 */
class MapObjectsCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.map_objects_comment',
		'app.location',
		'app.city',
		'app.city_image',
		'app.contact',
		'app.contact_type',
		'app.location_description',
		'app.map_object_subtype_relation',
		'app.object_subtype',
		'app.comment',
		'app.location_image',
		'app.event',
		'app.news',
		'app.application_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MapObjectsComment = ClassRegistry::init('MapObjectsComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MapObjectsComment);

		parent::tearDown();
	}

}
