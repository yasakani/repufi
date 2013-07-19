<?php
App::uses('AppController', 'Controller');
/**
 * Suburbs Controller
 *
 * @property Suburb $Suburb
 */
class SuburbsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Suburb->recursive = 0;
		$this->set('suburbs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Suburb->exists($id)) {
			throw new NotFoundException(__('Invalid suburb'));
		}
		$options = array('conditions' => array('Suburb.' . $this->Suburb->primaryKey => $id));
		$this->set('suburb', $this->Suburb->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Suburb->create();
			if ($this->Suburb->save($this->request->data)) {
				$this->Session->setFlash(__('The suburb has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The suburb could not be saved. Please, try again.'));
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
		if (!$this->Suburb->exists($id)) {
			throw new NotFoundException(__('Invalid suburb'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Suburb->save($this->request->data)) {
				$this->Session->setFlash(__('The suburb has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The suburb could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Suburb.' . $this->Suburb->primaryKey => $id));
			$this->request->data = $this->Suburb->find('first', $options);
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
		$this->Suburb->id = $id;
		if (!$this->Suburb->exists()) {
			throw new NotFoundException(__('Invalid suburb'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Suburb->delete()) {
			$this->Session->setFlash(__('Suburb deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Suburb was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
