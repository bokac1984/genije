<?php

App::uses('AppModel', 'Model');

/**
 * CouponChecker Model
 *
 * @property Location $Location Veza sa modelom lokacija
 * @property CouponCheckerLogin $CouponCheckerLogin Veza sa modelom checker logina
 */
class CouponChecker extends AppModel {
    public $useTable = 'map_objects_users'; 

    
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'username' => array(
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Unesite korisničko ime sa najmanje 5 karaktera',
            ),
        ),
        'fk_id_map_objects' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Morate odabrati lokaciju',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );
    
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasOne = array(
        'CouponCheckerLogin' => array(
            'className' => 'CouponCheckerLogin',
            'foreignKey' => 'fk_id_map_objects_users',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


    /**
     * Generise radnom kod od 16 cifara
     * 
     * @param int $length
     * @return string
     */
    public function generateRandomString($length = 16) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }  
    
    /**
     * Provjerava da li u bazi postoji slican kod
     * 
     * @param string $code
     * @return string
     */
    public function checkIfDuplicateCode($code) {
        return $this->CouponCheckerLogin->hasAny(array(
                'CouponCheckerLogin.activation_code' => $code
        ));
    }
    
    /**
     * Trazi kod uz provjeru da vec ne postoji slican
     * 
     * @return string
     */
    public function getRadnomActivationCode() {
        $realCode = '1234567891234567';
        $i = 0;
        while (true) {
            $possibleCode = $this->generateRandomString();
            
            if (!$this->checkIfDuplicateCode($possibleCode)) {
                $realCode = $possibleCode;
                break;
            }
            
            // just in case we never get this code, give user same code.
            // possible hackable solution
            if ($i > 100) {
                break;
            }
            
            $i++;
        }
        
        return $realCode;
    }
}
