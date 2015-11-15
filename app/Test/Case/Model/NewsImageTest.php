<?php
App::uses('NewsImage', 'Model');

/**
 * NewsImage Test Case
 */
class NewsImageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsImage = ClassRegistry::init('NewsImage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsImage);

		parent::tearDown();
	}

}
