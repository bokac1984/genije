<?php
App::uses('CouponCandidate', 'Model');

/**
 * CouponCandidate Test Case
 */
class CouponCandidateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.coupon_candidate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CouponCandidate = ClassRegistry::init('CouponCandidate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CouponCandidate);

		parent::tearDown();
	}

}
