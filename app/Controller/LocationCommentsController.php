<?php

App::uses('AppController', 'Controller');

/**
 * LocationComments Controller
 *
 * @property LocationComment $LocationComment
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class LocationCommentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session', 'RequestHandler');
    public $helpers = array('Js', 'Star');

    public function isAuthorized($user) {
        if ($this->locationOperator || $this->operator) {
            return true;
        }

        if (in_array($this->action, array('add', 'delete')) && $this->admin) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->LocationComment->recursive = 0;

        $containOptions = array(
            'ApplicationUser' => array(
                'fields' => array(
                    'ApplicationUser.id',
                    'ApplicationUser.display_name'
                )
            ),
            'Location' => array(
                'fields' => array(
                    'Location.name'
                )
            )
        );

        $fields = array(
            'LocationComment.id',
            'LocationComment.text',
            'LocationComment.rating',
            'LocationComment.datetime',
            'LocationComment.comment_rating',
        );

        if ($this->locationOperator || $this->operator) {
            $this->Paginator->settings = array(
                'limit' => 25,
                'contain' => $containOptions,
                'order' => array(
                    'LocationComment.datetime' => 'DESC'
                ),
                'conditions' => array(
                    'Location.id' => $this->userLocation
                ),
                'fields' => $fields
            );
        } else {
            $this->Paginator->settings = array(
                'limit' => 25,
                'contain' => $containOptions,
                'order' => array(
                    'LocationComment.datetime' => 'DESC'
                ),
                'fields' => $fields
            );
        }
        $this->set('LocationComments', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->LocationComment->exists($id)) {
            throw new NotFoundException(__('Invalid map objects comment'));
        }
        $options = array('conditions' => array('LocationComment.' . $this->LocationComment->primaryKey => $id));
        $this->set('mapObjectsComment', $this->LocationComment->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->LocationComment->create();
            if ($this->LocationComment->save($this->request->data)) {
                $this->Flash->success(__('The map objects comment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The map objects comment could not be saved. Please, try again.'));
            }
        }
        $locations = $this->LocationComment->Location->find('list');
        $applicationUsers = $this->LocationComment->ApplicationUser->find('list');
        $this->set(compact('locations', 'applicationUsers'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->LocationComment->exists($id)) {
            throw new NotFoundException(__('Invalid map objects comment'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->LocationComment->save($this->request->data)) {
                $this->Flash->success(__('The map objects comment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The map objects comment could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('LocationComment.' . $this->LocationComment->primaryKey => $id));
            $this->request->data = $this->LocationComment->find('first', $options);
        }
        $locations = $this->LocationComment->Location->find('list');
        $applicationUsers = $this->LocationComment->ApplicationUser->find('list');
        $this->set(compact('locations', 'applicationUsers'));
    }

    public function location($id = null) {
        $this->LocationComment->Location->id = $id;

        if (!$this->LocationComment->Location->exists()) {
            throw new NotFoundException(__('Unijeli ste pogrešnu lokaciju, vratite se nazad i pokušajte ponovo!'));
        }

        $this->Paginator->settings = array(
            'limit' => 15,
            'conditions' => array(
                'LocationComment.fk_id_map_objects' => $id
            ),
            'contain' => array(
                'ApplicationUser' => array(
                    'fields' => array(
                        'ApplicationUser.id',
                        'ApplicationUser.display_name'
                    )
                )
            ),
            'order' => array(
                'LocationComment.datetime DESC'
            )
        );

        $this->set('comments', $this->Paginator->paginate('LocationComment'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->LocationComment->id = $id;
        if (!$this->LocationComment->exists()) {
            throw new NotFoundException(__('Invalid map objects comment'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->LocationComment->delete()) {
            $this->Flash->success(__('The map objects comment has been deleted.'));
        } else {
            $this->Flash->error(__('The map objects comment could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
