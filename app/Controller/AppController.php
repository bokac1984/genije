<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('DataTableRequestHandlerTrait', 'DataTable.Lib');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    use DataTableRequestHandlerTrait;
    
    public $admin = false;
    public $locationOperator = false;
    public $operator = false;
    
    /**
     * Ako je korisnik locationOperator
     * onda ovo ima vrijednost njegove lokacije
     *
     * @var int 
     */
    public $userLocation;

    public $components = array(
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        ),
        'Flash',
        'Session',
        'RequestHandler',
        'Cookie',
        'Upload',
        'Paginator'
    );

    public function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->autoRedirect = false;
        $this->Auth->authorize = array('Controller');
        $this->Auth->loginAction = array(
            'prefix' => null,
            'plugin' => null,
            'controller' => 'users',
            'action' => 'login'
        );
        $this->Auth->logoutRedirect = array(
            'prefix' => null,
            'plugin' => null,
            'controller' => 'users',
            'action' => 'login'
        );
        $this->Auth->authError = __('Nemate dozvolu da vidite tu stranicu.');
        $this->Auth->loginError = __('Korisničko ime ili lozinaka nisu validni.');
        $this->Auth->flash['element'] = "flash_error";
       
        $this->menuBuilder($this->Auth->user('group_id'));
        
        $this->set('loggedInUser', $this->Auth->user());
        
        $this->userLocation = $this->Auth->user('map_object_id');
        
        $this->set('loggedInUsersLocation', $this->userLocation);
        
        $this->checkPermissions();
        // zabrani sve stranice, sve su privatne
        $this->Auth->deny();
        
        $this->layout = 'genie';
        
        // za sad ne radi, provjeriti sa Hrkijem koja je verzija PHP, ovo na serveru moze
        $this->autoCookieLogin();
    }

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['group_id']) && $user['group_id'] === '1') {
            return true;
        }

        // Default deny
        return false;
    }
    
    private function autoCookieLogin() {
        if (empty($this->Auth->user()) && $this->Cookie->check('rememberme')) {
            list($selector, $authenticator) = explode(':', $this->Cookie->read('rememberme'));

            $AuthToken = ClassRegistry::init('AuthToken');
            $AuthToken->recursive = -1;
            $token = $AuthToken->find('first', array(
                'conditions' => array(
                    'AuthToken.selector' => $selector
                )
            ));
            /*
            if (hash_equals($token['AuthToken']['token'], hash('sha256', base64_decode($authenticator)))) {
                $this->Auth->login($token['AuthToken']['fk_id_admin_users']);
                $this->redirect('/dashboards/');
            }*/
        }
    }
    
    public function uploadFile($uploadedImage, $location = '/photos/') {
        return $this->Upload->uploadFile($uploadedImage, $location);
    }

    /**
     * Postavlja za glavnu sliku
     */
    public function makeCover() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $model = $this->request->data['model'];
            $this->{$model}->id = $this->request->data['id'];
            if (!$this->{$model}->exists()) {
                echo '404';
            } else {
                if ($this->{$model}->saveField('img_name', $this->request->data['cover'])) {
                    echo '200';
                } else {
                    echo '404';
                }
            }
            exit();
        }
    }
    
    private function menuBuilder($userLevel) {
        $menu = '';
        
        if ($userLevel == 1) {
            $menu = 'menu';
        } else if ($userLevel == 2) {
            $menu = 'locationEditor';
        } else {
            $menu = 'locationEditor';
        }
        
        $this->set('menuElement', $menu);
    }
    
    public function checkPermissions() {
        switch ($this->Auth->user('Group.group_name')) {
            case 'Operator':
                $this->operator = true;
                break;
            case 'LocationOperator':
                $this->locationOperator = true;
                break;
            case 'Administrator':
                $this->admin = true;
                break;
            default:
                break;
        }
    }

}
