<?php

App::uses('Component', 'Controller');

/**
 * Description of CouponComponent
 *
 * @author bokac
 * 
 */
class CouponComponent extends Component {

    /**
     * Dozvoljene ekstenzije
     *
     * @var array 
     * 
     */
    private $api = 'http://mobile.urbangenie.co/v2/send-notification-to-all';
    
    public $apiKey = 'AIzaSyCqm7A6rUi1CMVARgL9CA8aWMpdA7cvdy0';

    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }

    public function sendNotificationsToAll($users) {
        
    }


}
