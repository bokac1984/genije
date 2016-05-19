<?php
App::uses('Subscription', 'Model');

/**
 * Subscription Test Case
 */
class SubscriptionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.subscription',
		'app.admin_users',
		'app.plans'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Subscription = ClassRegistry::init('Subscription');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subscription);

		parent::tearDown();
	}

}
