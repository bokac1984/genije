<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * 
 * @property Location $Location
 * @property Subscription $Subscription
 */
class User extends AppModel {
    
    public $useTable = 'admin_users';
    public $displayField = 'first_name';
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'img' => array(
            'notBlank' => array(
                'rule' => array('notEmptyImage'),
                'message' => 'Odaberite sliku!',
                'last' => true,
            ),
            'type' => array(
                'rule' => array(
                    'extension',
                    array('jpeg','jpg','png','gif')
                ),
                'message' => 'Pogrešna ekstanzija slike, mora biti jedna od: jpeg, jpg, png, gif.'
            ),
            'size' => array(
                'rule' => array('validateImageSize', 5242880),
                'message' => 'Slika je prevelika, ne smije biti vec od 5 Mb.'
            )          
        ),  
        'username' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Unesite korisničko ime',
                'last' => true,
            ),
        ),        
        'password' => array(
            'minLength' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Minimalno 6 karaktera',
                'last' => true
            ),
        ),
        'password2' => array(
            'passwordMatch' => array(
                'rule' => array('passwordMatch'),
                'message' => 'Šifre se ne poklapaju'
            ),
        ),        
    );

    public $virtualFields = array(
        'fullname' => 'CONCAT(User.first_name, " ", User.last_name)'
    );    

    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
        ),
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'map_object_id',
        )         
    );
    
    public $hasOne = array(
        'AuthToken' => array(
            'className' => 'AuthToken',
            'foreignKey' => 'fk_id_admin_users',
        ),
        'Subscription' => array(
            'className' => 'Subscription',
            'foreignKey' => 'admin_users_id',
        ),
    );
    
    
    /**
     * Morali smo ovo dodati zbog problema sa alijasima i virtuelnim poljima prilikom
     * find metode
     * 
     * @param type $id
     * @param type $table
     * @param type $ds
     */
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->virtualFields['fullname'] = sprintf(
            'CONCAT(%s.first_name, " ", %s.last_name)', $this->alias, $this->alias
        );
    }    
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return parent::beforeSave($options);
    }

    /**
     * @return bool
     */
    public function passwordMatch() {
        if ($this->data[$this->alias]['password']===$this->data[$this->alias]['password2']){
            return true;
        }

//        /$this->invalidate('confirm_password','Your passwords do not match!');
        return false;
    }

    public function saveLastLogin($id = null) {
        $this->id = $id;
        return $this->saveField('last_login_time', date);
    }
    
    public function savePassword($data = array()) {
        if ($data[$this->alias]['password'] == $data[$this->alias]['password2']) {
            
        }
    }
    
    /**
     * 
     * @param array $data Podaci za testiranje velicine slike
     * @param int $size Velicina slike u bajtima
     * @return boolean
     */
    public function validateImageSize($data, $size) {
        if (!isset($data['img']['size']) || $data['img']['size'] >= $size) {
            return false;
        }
        
        return true;
    }

    
    public function notEmptyImage($data = array()) {
        if (!isset($this->data[$this->alias]['img']['size']) || $this->data[$this->alias]['img']['size'] == 0) {
            return false;
        }
        
        return true;
    }   
    /**
     * Primjer rodjendana = '1985-12-13'
     * 
     * @param string $birthday
     */
    public function splitBirthday($birthday = null) {
        $parts = array(
            'y' => 1900,
            'm' => 0,
            'd' => 0
        );
        if ($birthday !== null) {
            $split = explode('-', $birthday);
            $parts = array(
                'y' => (int)$split[0],
                'm' => (int)$split[1],
                'd' => (int)$split[2]
            );
        }

        return $parts;
    }
}
