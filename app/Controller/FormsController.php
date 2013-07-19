<?php
App::uses('AppController', 'Controller');
/**
 * Forms Controller
 *
 * @property Form $Form
 */
class FormsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
	    $this->set('title_for_layout', 'Registros');
		$this->Form->recursive = 0;
		$this->set('forms', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Form->exists($id)) {
			throw new NotFoundException(__('Invalid form'));
		}
		$options = array('conditions' => array('Form.' . $this->Form->primaryKey => $id));
		$this->set('form', $this->Form->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	    
	    $this->set('title_for_layout', 'Captura de registro');
	    
		if ($this->request->is('post')) {
		    
			$this->Form->create();
			
			// User ID capturing data
			$this->request->data['Form']['user_id'] = $this->Authake->getUserId();
			
			// Schedule data
			$this->request->data['Form']['commerce_squedule'] = json_encode( $this->request->data['Form']['schedules'] );
			unset( $this->request->data['Form']['schedules'] );
			
			if ($this->Form->save($this->request->data)) {
				
				// New record ID
				$form_id = $this->Form->id;
				
                // Scans
				foreach ( $this->request->data['Form'] as $f => $form ) {
				    if ( preg_match('/scan/i', $f, $result) ) {
				        
				        if ( !empty($form['name']) ) {
				            
                            $path_info = pathinfo($form['name']);
                            
                            $file_extension = $path_info['extension'];
                            
                            $documents_dir = 'documents/';
                            
                            $subdir_explode = explode('_', $f);
                            $subdir = $subdir_explode[1];
                            
                            $full_path = WWW_ROOT . $documents_dir . $subdir;
                            
                            if ( !file_exists($full_path) )
                                mkdir( $full_path );
                            
                            if ( !move_uploaded_file($form['tmp_name'], 'documents/' . $subdir . '/' . $form_id . '.' . $file_extension) )
                                $this->Session->setFlash('Datos capturados correctamente, pero ocurrio un problema al cargar imagen ' . $form_id . ' en ' . $subdir);
				            
				        }
				        				        
				    }
				    
				}
				
				$this->Session->setFlash('Datos capturados correctamente.');
				$this->redirect(array('action' => 'index'));
				
			} else {
			    
			    $this->set('errors', $this->Form->validationErrors);
				$this->Session->setFlash('Ocurrio un problema al guardar los datos, intentalo nuevamente.');
				
			}
			
		} else {
		    $suburbs = $this->Form->Suburb->find('list');
		    $this->set(compact('suburbs'));
		    
		    /**
		    * Hours a day
		    */
		    
		    $hours_a_day = array();
		    
		    for ( $i = 0; $i <= 1410; $i = $i + 30) {
		        $tmp_timestamp = mktime(0, 0 + $i, 0, date('m'), date('d'), date('Y'));
		        $hours_a_day[] = date('H:i', $tmp_timestamp);
		    }
		    
		    $this->set(compact('hours_a_day'));
		    
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
		if (!$this->Form->exists($id)) {
			throw new NotFoundException(__('Invalid form'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash(__('The form has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Form.' . $this->Form->primaryKey => $id));
			$this->request->data = $this->Form->find('first', $options);
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
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Form->delete()) {
			$this->Session->setFlash(__('Form deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Form was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
