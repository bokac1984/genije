<?php
App::uses('DeclineReason', 'Model');

/**
 * DeclineReason Test Case
 */
class DeclineReasonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.decline_reason'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DeclineReason = ClassRegistry::init('DeclineReason');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DeclineReason);

		parent::tearDown();
	}

}
