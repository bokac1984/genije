<?php

/**
 * Application level Controller
 *
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
        $this->Auth->loginError = __('Korisničko ime ili lozinka nisu validni.');
        $this->Auth->flash['element'] = "flash_error";
        
        if ($this->request->is('ajax')) {
            $this->disableCache();
        }
        
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
    
    /**
     * Trebala bi da provjeri da li ovaj korisnik smije da dodaje
     * samo unutar svoje lokacije ili za sve gradove i lokacije
     * 
     * @return boolean
     */
    public function checkIfUserCanAddToAllLocations() {
        if (empty($this->request->params['pass']) || $this->request->params['pass'][0] === '') {
            return false;
        }

        return $this->request->params['pass'][0] === $this->userLocation;        
    }
    
    /**
     * Provjeri da li korisnik moze dodati postType 
     * zbog ogranicenja za kolicinu ili istekli datum
     * 
     * @return url
     */
    public function userCanAddMorePosts() {
        $userSubscriptionData = $this->Auth->user('Subscription');
        $Plan = ClassRegistry::init("Plan");
        
        // napravi mnozinu od naziva modela
        $postType = strtolower(Inflector::pluralize($this->modelClass));
        
        $subscribedCountPerMonth = $Plan->numberOfPostTypeToPublish($userSubscriptionData['plans_id'], $postType);
        $publishedForLastSubscribePeriod = $this->{$this->modelClass}->publishedByLocationIdLastMonth($this->userLocation, $userSubscriptionData['start_date']);
        $now = date("Y-m-d H:i:s");
        
        
        
        if ($now > $userSubscriptionData['end_date']) {
            return $this->redirect(array('controller' => 'subscriptions', 'action' => 'expired'));
        }        
        else if ($this->{$this->modelClass}->canPostMore ($subscribedCountPerMonth['Plan']["{$postType}_quantity"], $publishedForLastSubscribePeriod)) {
            return $this->redirect(array('controller' => 'subscriptions', 'action' => 'used'));
        }
    }

}
