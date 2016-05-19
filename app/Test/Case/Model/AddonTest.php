<?php
App::uses('Addon', 'Model');

/**
 * Addon Test Case
 */
class AddonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.addon',
		'app.user',
		'app.group',
		'app.auth_token',
		'app.users_addon'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Addon = ClassRegistry::init('Addon');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Addon);

		parent::tearDown();
	}

}
