<?php
App::uses('AppModel', 'Model');
/**
 * ApplicationUser Model
 *
 */
class ApplicationUser extends AppModel {
       
    public $useTable = 'users'; 
    public $primaryKey = 'id';
    public $displayField = 'name';

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
