<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$this->set('title_for_layout', 'Categorías');
		
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException('Categoría no valida.');
		}
		
		$this->set('title_for_layout', 'Detalles de la categoría');
		
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		$this->set('title_for_layout', 'Agregar categoría');
		
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('La categoría se guardó correctamente.', 'flash_bootstrap_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('La categoría no se pudo guardar, intentalo nuevamente.', 'flash_bootstrap_error');
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
		if (!$this->Category->exists($id)) {
			throw new NotFoundException('Categoría no valida.');
		}
		
		$this->set('title_for_layout', 'Editar categoría');

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('La categoría se guardó correctamente', 'flash_bootstrap_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('La categoría no se pudo guardar, intentalo nuevamente.', 'flash_bootstrap_error');
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
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
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException('Categoría no valida.');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash('Categoría eliminada correctamente.', 'flash_bootstrap_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('La categoría no fue eliminada.', 'flash_bootstrap_error');
		$this->redirect(array('action' => 'index'));
	}
	
}