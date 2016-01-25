<?php
App::uses('NewsProduct', 'Model');

/**
 * NewsProduct Test Case
 */
class NewsProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_product',
		'app.fk_news',
		'app.fk_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsProduct = ClassRegistry::init('NewsProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsProduct);

		parent::tearDown();
	}

}
