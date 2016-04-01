<?php
App::uses('AppModel', 'Model');
/**
 * ApplicationUser Model
 *
 */
class ApplicationUser extends AppModel {
       
    public $useTable = 'users'; 
    public $primaryKey = 'id';
    public $displayField = 'display_name';
    
    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'LocationComment' => array(
            'className' => 'LocationComment',
            'foreignKey' => 'fk_id_users',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'fk_id_users'
        )        
    );  

    public function getAllUsers() {
        $users = $this->find('all', array(
            'fields' => array(
                'ApplicationUser.id',
                'ApplicationUser.latitude',
                'ApplicationUser.longitude'
            )
        ));
        $temp = array();
        
        foreach($users as $user) {
            $temp[] = array(
                    'lat' => floatval($user['ApplicationUser']['latitude']), 
                    'lng' => floatval($user['ApplicationUser']['longitude']), 
                    'title' => "Korisnik-".$user['ApplicationUser']["id"]
            );
        }

        return $temp;
    }
}
