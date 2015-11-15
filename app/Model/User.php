<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {
    
    public $useTable = 'admin_users';

    public $validate = array(
        'password' => array(
            'minLength' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Minimalno 6 karaktera'
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
        )
    );
    
    public $hasOne = array(
        'AuthToken' => array(
            'className' => 'AuthToken',
            'foreignKey' => 'fk_id_admin_users',
        )
    );
    
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
            echo 'valjaju';
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
}
