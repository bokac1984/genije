<?php
App::uses('MapObjectsUsersLogin', 'Model');

/**
 * MapObjectsUsersLogin Test Case
 */
class MapObjectsUsersLoginTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.map_objects_users_login',
		'app.coupon_checker',
		'app.location',
		'app.city',
		'app.city_image',
		'app.contact',
		'app.contact_type',
		'app.location_description',
		'app.map_object_subtype_relation',
		'app.object_subtype',
		'app.location_comment',
		'app.application_user',
		'app.location_image',
		'app.event',
		'app.news',
		'app.news_comment',
		'app.gallery',
		'app.news_image',
		'app.product',
		'app.product_feature',
		'app.product_image',
		'app.news_product',
		'app.map_objects_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MapObjectsUsersLogin = ClassRegistry::init('MapObjectsUsersLogin');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MapObjectsUsersLogin);

		parent::tearDown();
	}

}
