<?php

App::uses('Component', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * Description of NotificationComponent
 *
 * @author bokac
 * 
 */
class NotifyComponent extends Component {

    /**
     * Dozvoljene ekstenzije
     *
     * @var array 
     * 
     */
    private $api = 'http://mobile.urbangenie.co/v2/send-notification-to-all';
    
    public $apiKey = "AIzaSyCqm7A6rUi1CMVARgL9CA8aWMpdA7cvdy0";

    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }

    public function sendNotifications($data) {
        $headers = array(
            'Authorization:' . $this->apiKey,
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json'
        );
        
        $body = array(
            //'to' => 'APA91bGRRf06pZ2kbf2pvs6znMfF4cOwpIKB0aU1R5gVgaJsA90RsH6zcMOQMZikdRDruxL_73hb3-C4SK_2WsrGeskpCz19eDoW46qEE_qr6iTD7uMA4LpdlV548vmfvw6cHJ3e7DSC',
            'text' => 'Testiranje iz app ver 2'
        );
        
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $this->api);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
    }


}
