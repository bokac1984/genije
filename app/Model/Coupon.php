<?php

App::uses('AppModel', 'Model');

/**
 * Coupon Model
 * 
 * 
 * @property Event $Event
 * @property ApplicationUser $ApplicationUser
 */
class Coupon extends AppModel {

    public $useTable = 'events_tickets'; 
    public $primaryKey = 'id';
    
    /**
     * Duzina koda koji se generise
     *
     * @var int 
     */
    private $generatedCodeLength = 32;
    
    /**
     * Niz iz kojeg se generise kod
     *
     * @var string 
     */
    private $charset = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890";
    

    
    public $belongsTo = array(
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'fk_id_events',
        ),
        'ApplicationUser' => array(
            'className' => 'ApplicationUser',
            'foreignKey' => 'fk_id_users',
        ),        
    );
    
    /**
     * 
     * @param array $data Sadrzi podatke za pronalazenje kandidata
     * @return type
     */
    public function findCandidates($data = array()) {
        $genderCondition = $data['gender'] != -1 ? 
                " AND users.gender = " . $data['gender'] 
                : "";

        $query = "SELECT users.id, users.gcm_regid, ( 6371 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance
                    FROM	users				
                    WHERE	1=1
                    AND users.status = 1" . $genderCondition . "
                    HAVING	distance < ?
                    ORDER BY RAND()";
        
        $db = $this->getDataSource();
        return $db->fetchAll(
            $query,
            array($data['latitude'], $data['longitude'], $data['latitude'], $data['radius'] / 1000)
        );
    }
    
    /**
     * Provjerava sve moguce dobitnike kupona na osnovu zadatih parametara
     * 
     * @param array $data
     */
    public function checkPossibleCouponCount($data = array()) {
        
        //$candidates = $this->checkPossibleCouponCandidates($data);
        $candidates =  array(
		'users' => array(
			'id' => '5',
			'gcm_regid' => 'APA91bGRRf06pZ2kbf2pvs6znMfF4cOwpIKB0aU1R5gVgaJsA90RsH6zcMOQMZikdRDruxL_73hb3-C4SK_2WsrGeskpCz19eDoW46qEE_qr6iTD7uMA4LpdlV548vmfvw6cHJ3e7DSC'),
	);
        $candidatesCount = count($candidates);
        
        if ($candidatesCount > 0) {
            $this->saveCandidates($candidates);
            
            return $candidatesCount;
        }
        
        return 0;
    }
    
    /**
     * Pronalazi sve validne kandidate
     * 
     * @param array $data
     */
    public function checkPossibleCouponCandidates($data = array()) {
        $candidates = $this->findCandidates($data);
        $candidatesToSave = array();

        foreach($candidates as $candidate) {
            if ($this->isTicketAssignedToUser($data['fk_id_events'], $candidate['users']['id'])) {
                $candidatesToSave[] = $candidate;
            }
        }
        
        return $candidatesToSave;
    }   
    
    public function saveCandidates($candidates = array()) {
        $CouponCandidate = ClassRegistry::init('CouponCandidate');
        $CouponCandidate->deleteAll(array('1 = 1'));
        $dataToSave = array();
        
        foreach ($candidates as $candidate) {
            $dataToSave[] = array(
                'user_id' => '5',
                'gcm_regid' => 'APA91bGRRf06pZ2kbf2pvs6znMfF4cOwpIKB0aU1R5gVgaJsA90RsH6zcMOQMZikdRDruxL_73hb3-C4SK_2WsrGeskpCz19eDoW46qEE_qr6iTD7uMA4LpdlV548vmfvw6cHJ3e7DSC'
            );
        }
        $CouponCandidate->saveMany($dataToSave);
    }
    
    /**
     * 
     * @param int $event
     * @param int $userId
     * @return boolean Ako nema usera vrati false inace vrati true
     */
    public function isTicketAssignedToUser($event = null, $userId = null) {
        $broj = $this->find('count', array(
            'conditions' => array(
                'Coupon.fk_id_events' => $event,
                'Coupon.fk_id_users' => $userId
        )));
        
        return count($broj) > 0;
    }
    
    /**
     * 
     * @param type $length
     * @return type
     */
    private function generateCode() {
        $random = "";
        
        for ($i = 0; $i < $this->generatedCodeLength; $i++) {
            $random .= substr($this->charset, (rand() % (strlen($this->charset))), 1);
        }
        return $random;
    }    

    public function generateCoupons($data = array()) {
        $users = array();
        
        $eventImage = $this->Event->getImageForEvent($data['fk_id_events']);
        
        $CouponCandidate = ClassRegistry::init('CouponCandidate');
        $Notification = ClassRegistry::init('Notification');
        
        $candidates = $CouponCandidate->find('all');
        /**
         * Odavde ce samo djole da dobije
         */
        
        foreach ($candidates as $candidate) {
            $code = $this->generateCode();
            $dataToSave = array(
                'Coupon' => array(
                    'code' => $code,
                    'value' => $data['value'],
                    'fk_id_events' => $data['fk_id_events'],
                    'fk_id_users' => $candidate['CouponCandidate']['user_id'],
                    'creation_date' => $this->getDataSource()->expression('NOW()'),
                    'code_status' => 1
                )
            );
            
            if ($this->save($dataToSave)) {
                $couponId = $this->getLastInsertID();
                $notificationData = array(
                    'Notification' => array(
                        'title' => 'Nagradni kupon',
                        'text' => $data['value'],
                        'img_url' => $eventImage['Event']['img_url'],
                        'date' => $this->getDataSource()->expression('NOW()'),
                        'fk_id_users' => $candidate['CouponCandidate']['user_id'],
                        'type' => 4,
                        'type_id' => $couponId,
                        'status' => 1
                    )
                );
                
                $Notification->save($notificationData);
                
                $users[] = $candidate['CouponCandidate']['gcm_regid'];
            }
            else {
                debug('nije');exit();
            }
        }
        
        $CouponCandidate->deleteAll(array('1 = 1'));
        
        return $users;
    }
}
