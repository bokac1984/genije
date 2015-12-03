<?php
App::uses('MapObjectsProduct', 'Model');

/**
 * MapObjectsProduct Test Case
 */
class MapObjectsProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.map_objects_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MapObjectsProduct = ClassRegistry::init('MapObjectsProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MapObjectsProduct);

		parent::tearDown();
	}

}
