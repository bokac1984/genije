<?php
App::uses('NewsComment', 'Model');

/**
 * NewsComment Test Case
 */
class NewsCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_comment',
		'app.news',
		'app.city',
		'app.city_image',
		'app.location',
		'app.contact',
		'app.contact_type',
		'app.location_description',
		'app.map_object_subtype_relation',
		'app.object_subtype',
		'app.location_comment',
		'app.application_user',
		'app.location_image',
		'app.event',
		'app.product',
		'app.product_feature',
		'app.product_image',
		'app.map_objects_product',
		'app.gallery',
		'app.news_image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsComment = ClassRegistry::init('NewsComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsComment);

		parent::tearDown();
	}

}
