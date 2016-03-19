<?php
App::uses('EventsTicket', 'Model');

/**
 * EventsTicket Test Case
 */
class EventsTicketTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.events_ticket'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EventsTicket = ClassRegistry::init('EventsTicket');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EventsTicket);

		parent::tearDown();
	}

}
