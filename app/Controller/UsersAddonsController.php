<?php
App::uses('AppController', 'Controller');
/**
 * UsersAddons Controller
 *
 * @property UsersAddon $UsersAddon
 * @property PaginatorComponent $Paginator
 */
class UsersAddonsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UsersAddon->recursive = 0;
		$this->set('usersAddons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersAddon->exists($id)) {
			throw new NotFoundException(__('Invalid users addon'));
		}
		$options = array('conditions' => array('UsersAddon.' . $this->UsersAddon->primaryKey => $id));
		$this->set('usersAddon', $this->UsersAddon->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersAddon->create();
			if ($this->UsersAddon->save($this->request->data)) {
				$this->Flash->success(__('The users addon has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The users addon could not be saved. Please, try again.'));
			}
		}
		$adminUsers = $this->UsersAddon->AdminUser->find('list');
		$addons = $this->UsersAddon->Addon->find('list');
		$this->set(compact('adminUsers', 'addons'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UsersAddon->exists($id)) {
			throw new NotFoundException(__('Invalid users addon'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersAddon->save($this->request->data)) {
				$this->Flash->success(__('The users addon has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The users addon could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersAddon.' . $this->UsersAddon->primaryKey => $id));
			$this->request->data = $this->UsersAddon->find('first', $options);
		}
		$adminUsers = $this->UsersAddon->AdminUser->find('list');
		$addons = $this->UsersAddon->Addon->find('list');
		$this->set(compact('adminUsers', 'addons'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UsersAddon->id = $id;
		if (!$this->UsersAddon->exists()) {
			throw new NotFoundException(__('Invalid users addon'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersAddon->delete()) {
			$this->Flash->success(__('The users addon has been deleted.'));
		} else {
			$this->Flash->error(__('The users addon could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
