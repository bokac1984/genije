<?php
App::uses('AuthToken', 'Model');

/**
 * AuthToken Test Case
 */
class AuthTokenTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.auth_token',
		'app.user',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AuthToken = ClassRegistry::init('AuthToken');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AuthToken);

		parent::tearDown();
	}

}
