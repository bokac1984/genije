<?php

App::uses('AppController', 'Controller');

/**
 * Coupons Controller
 *
 * @property Coupon $Coupon
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CouponsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session', 'CouponSend');
    
    public $helpers =  array('MyHtml');

    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'barcode');
    }

    public function isAuthorized($user) {
        return parent::isAuthorized($user);
    }
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Coupon->recursive = 0;

        $this->Paginator->settings = array(
            'limit' => 15,
            'contain' => array(
                'ApplicationUser' => array(
                    'fields' => array(
                        'ApplicationUser.id',
                        'ApplicationUser.display_name'
                    )
                ),
                'Event' => array(
                    'fields' => array(
                        'Event.id',
                        'Event.name'
                    )
                )
            ),
            'order' => array(
                'Coupon.creation_date DESC'
            )
        );
        
        $this->set('eventsTickets', $this->Paginator->paginate('Coupon'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Coupon->exists($id)) {
            throw new NotFoundException(__('Invalid events ticket'));
        }
        $options = array('conditions' => array('Coupon.' . $this->Coupon->primaryKey => $id));
        $this->set('eventsTicket', $this->Coupon->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Coupon->create();
            if ($this->Coupon->save($this->request->data)) {
                $this->Flash->success(__('The events ticket has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The events ticket could not be saved. Please, try again.'));
            }
        }
        
        $cities = $this->Coupon->Event->Location->City->find('list');
        $this->set(compact(array('cities')));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Coupon->exists($id)) {
            throw new NotFoundException(__('Invalid events ticket'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Coupon->save($this->request->data)) {
                $this->Flash->success(__('The events ticket has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The events ticket could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Coupon.' . $this->Coupon->primaryKey => $id));
            $this->request->data = $this->Coupon->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Coupon->id = $id;
        if (!$this->Coupon->exists()) {
            throw new NotFoundException(__('Invalid events ticket'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Coupon->delete()) {
            $this->Flash->success(__('The events ticket has been deleted.'));
        } else {
            $this->Flash->error(__('The events ticket could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    // AJAX METHODS ONWARDS
    
    public function events() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        
        $cityId = $this->request->data['cityId'];
        
        $events = $this->Coupon->Event->allCityEvents($cityId);
        
        $this->set('events', $events);
    } 
    
    public function generateCoupons() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        
        $check = $this->request->data['Coupon']['check'];
        
        $couponData = $this->request->data['Coupon'];
        if ($check) {
            $data = $this->Coupon->checkPossibleCouponCount($couponData);
        } else {
            $userGCMregIDs = $this->Coupon->generateCoupons($couponData);
            $data = $this->CouponSend->sendNotifications(array('text' => $couponData['value']));
            $data = array();
        }
        
        $this->set(compact('data'));
    }

}
