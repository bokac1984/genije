<?php
App::uses('UsersAddon', 'Model');

/**
 * UsersAddon Test Case
 */
class UsersAddonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.users_addon',
		'app.admin_users',
		'app.addons'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsersAddon = ClassRegistry::init('UsersAddon');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersAddon);

		parent::tearDown();
	}

}
