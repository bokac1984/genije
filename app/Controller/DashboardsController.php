<?php
App::uses('AppController', 'Controller');

class DashboardsController extends AppController {
    
    public $uses = array(
        'Plan', 'Subscription', 'Event', 'News', 'Product' 
    );
    
    public function beforeFilter() {
        if ($this->request->is('ajax')) {
            $this->disableCache();
        }
        $this->set('icon', 'home-3');
        parent::beforeFilter();
    }
    
    public function isAuthorized($user) {
        return true;
    }

    public function index() {
        if (!$this->admin) {
            $news = $this->News->publishedByLocationIdLastMonth($this->userLocation);
            
            $subscribedCount = $this->Plan->find('first', array(
                'conditions' => array(
                    'Plan.id' => $this->Auth->user('Subscription.plans_id')
                )
            ));
            
            $newsPercent = $this->getPercent($news, $subscribedCount['Plan']['news_quantity']);
            
            $eventsPunlished = $this->Event->publishedByLocationIdLastMonth($this->userLocation);
            $eventsPercent = $this->getPercent($eventsPunlished, $subscribedCount['Plan']['events_quantity']);
            
            $productsPublished = $this->Product->publishedByLocationIdLastMonth($this->userLocation);
            $productsPercent = $this->getPercent($productsPublished, $subscribedCount['Plan']['products_quantity']);
            $this->set('newsPercent', $newsPercent > 100 ? 100 : $newsPercent);
            $this->set('eventsPercent', $eventsPercent > 100 ? 100 : $eventsPercent);
            $this->set('productsPercent', $productsPercent > 100 ? 100 : $productsPercent);
            $this->render('locationo');
        }
    }

    public function add() {
        $cities = $this->Event->Location->City->find('list');
        $this->set(compact(array('cities')));
    }
    
    public function editStatus() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){

            $this->Event->id = $this->request->data['pk'];
            if ($this->Event->saveField('online_status', $this->request->data['value'])) {
                echo 'da';
            } else {
                echo 'ne';
            }
        }
    }
    
    public function locations() {
        $this->request->onlyAllow('ajax');
        $this->viewClass = 'Json';
        $cities = $this->Event->Location->getCityLocations($this->request->data['city']);
        $this->set(compact('cities'));
    }
    
    public function saveNewEvent() {
        $this->request->onlyAllow('ajax');
        $this->autoRender = false;
        return $this->Event->saveEvent($this->request->data);
    }


    public function editable() {
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $this->Event->id = $this->request->data['pk'];
            $field = $this->request->data['name'];
            $value = $this->request->data['value'];
            if ($this->Event->saveField($field, $value)){
                echo 'radi';
            } else {
                echo 'error';
            }
        }
    }
    
    private function getPercent($part, $whole) {
        return $part / $whole * 100;
    }
}
