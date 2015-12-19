<?php

App::uses('AppController', 'Controller');

/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CitiesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('icon', 'cog-2');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->City->recursive = 0;
        $this->set('cities', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->City->exists($id)) {
            throw new NotFoundException(__('Neispravan grad'));
        }
        $options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
        $this->set('city', $this->City->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->City->create();
            if ($this->City->save($this->request->data)) {
                $this->Flash->success(__('Uspješno ste sačuvali podatke o novom gradu.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Nije moguće dodati novi grad u ovom momentu, pokušajte ponovo.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->City->exists($id)) {
            throw new NotFoundException(__('Neispravan grad'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->City->save($this->request->data)) {
                $this->Flash->success(__('Sačuvali ste podatke o gradu.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Nije moguće dodati novi grad u ovom momentu, pokušajte ponovo.'));
            }
        } else {
            $options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
            $this->request->data = $this->City->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->City->id = $id;
        if (!$this->City->exists()) {
            throw new NotFoundException(__('Neispravan grad'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->City->delete()) {
            $this->Flash->success(__('Grad uspješno obrisan.'));
        } else {
            $this->Flash->error(__('Grad nije moguće obrisati, pokušajte ponovo ili kontaktirajte developera.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function getNumberOfLocationsPerCity() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        
        $numberOfLocationsPerCity = $this->City->Location->locationsPerCity();
        $this->set(compact('numberOfLocationsPerCity'));
    }     
}
