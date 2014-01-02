<?php
App::uses('AppController', 'Controller');
/**
 * Forms Controller
 *
 * @property Form $Form
 */
class FormsController extends AppController {

	public $paginate = array(
		'limit' => 50
	);
	
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
		
		$this->set('title_for_layout', "Detalles de registro #$id");
		
		$options = array('conditions' => array('Form.' . $this->Form->primaryKey => $id));
		
		$form = $this->Form->find('first', $options);
		
		$form['Form']['owner_photo'] = $this->__getOwnersPhoto($id);
		$form['Documents'] = $this->__getDocumentList($id);
		$form['Form']['schedule'] = $this->__getSchedule($form);
		$form['Form']['commerce_square_meters'] = round($form['Form']['commerce_square_meters'], 2);
		
		if ( $form['Form']['birthday'] != '0000-00-00' ) {
			
			$today = new DateTime("now");
			$birthday = new DateTime( $form['Form']['birthday'] );
			$form['Form']['age'] = $today->diff($birthday)->format('%y');
			
		}
		
		$this->set('form', $form);
		
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
			$this->request->data['Form']['created_by'] = $this->Authake->getLogin();
			$this->request->data['Form']['modified_by'] = $this->Authake->getLogin();
			
			// Status
			settype($this->request->data['Form']['receipt_number'], 'integer');
			$this->request->data['Form']['status'] = ( $this->request->data['Form']['receipt_number'] == 0 ) ? 0: 1;
			
			if ( $this->Form->save($this->request->data) ) {
				
				$this->setFlash('Datos de registro capturados correctamente.', 'flash_bootstrap_success');
				
				if ( !empty($this->request->data['Form']['owner_photo']['name']) ) {
					
					if ( $this->__documentValidType($this->request->data['Form']['owner_photo']) ) {
						
						if ( $this->__uploadDocument($this->request->data['Form']['owner_photo'], $id, 'owner_photo') ) 
							$this->setFlash('Imagen de propitario cargada correctamente.', 'flash_bootstrap_success');
						else
							$this->setFlash('Ocurrio un problema al cargar la imagen de propietario, intentalo nuevamente.', 'flash_bootstrap_error');
						
					} else
						$this->setFlash('Tipo de imagen no permitida.', 'flash_bootstrap_error');
					
				}
				
				$this->redirect( array('action' => 'docs', $this->Form->id) );
				
			} else {
			    
			    $this->set('errors', $this->Form->validationErrors);
				$this->Session->setFlash('Ocurrio un problema al guardar los datos, intentalo nuevamente.', 'flas_bootstrap_error');
				
			}
			
		} else {
			
		    $suburbs = $this->Form->Suburb->find('list');
		    $this->set(compact('suburbs'));
		    
		    $categories = $this->Form->Category->find('list');
		    $this->set(compact('categories'));
		    
		    $schedules = $this->Form->Schedule->find('list', array('order' => 'Schedule.sequence DESC'));
		    $this->set(compact('schedules'));
		    
		    $months_spanish = $this->__getMonthListInSpanish();
		    $this->set(compact('months_spanish'));
		    
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
			throw new NotFoundException('El identificador de registro especificado no es valido.');
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->Form->id = $id;
			
			// Status
			settype($this->request->data['Form']['receipt_number'], 'integer');
			$this->request->data['Form']['status'] = ( $this->request->data['Form']['receipt_number'] == 0 ) ? 0: 1;
			
			$this->request->data['Form']['modified_by'] = $this->Authake->getLogin();
			
			if ($this->Form->save($this->request->data)) {
				
				$this->setFlash('Datos de registro editados correctamente.', 'flash_bootstrap_success');
				
				if ( !empty($this->request->data['Form']['owner_photo']['name']) ) {
					
					if ( $this->__documentValidType($this->request->data['Form']['owner_photo']) ) {
						
						if ( $this->__uploadDocument($this->request->data['Form']['owner_photo'], $id, 'owner_photo') ) 
							$this->setFlash('Imagen de propitario cargada correctamente.', 'flash_bootstrap_success');
						else
							$this->setFlash('Ocurrio un problema al cargar la imagen de propietario, intentalo nuevamente.', 'flash_bootstrap_success');
						
					} else
						$this->setFlash('Tipo de imagen no permitida.', 'flash_bootstrap_error');
					
				}
								
			} else
				$this->Session->setFlash('Datos de registro no editados, intentalo nuevamente.', 'flash_bootstrap_error');
			
		}
			
		$this->set('title_for_layout', "Editar datos del registro No. $id");
		
		$options = array('conditions' => array('Form.' . $this->Form->primaryKey => $id));
		$this->request->data = $this->Form->find('first', $options);
		
	    $suburbs = $this->Form->Suburb->find('list');
	    $this->set(compact('suburbs'));
	    
	    $categories = $this->Form->Category->find('list');
	    $this->set(compact('categories'));
	    
	    $schedules = $this->Form->Schedule->find('list', array('order' => 'Schedule.sequence DESC'));
	    $this->set(compact('schedules'));
		
	    $months_spanish = $this->__getMonthListInSpanish();
	    $this->set(compact('months_spanish'));
		
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param int $id
 * @return void
 */
	public function delete($id = null) {
		
		$this->Form->id = $id;
		
		if ( !$this->Form->exists() ) {
			throw new NotFoundException('ID de registro no valido.');
		}
		
		$this->request->onlyAllow('post', 'delete');
		
		if ( $this->__deleteOwnersPhoto($id) ) {	
			
			if ( $this->Form->delete() ) {
				
				$documents_status = $this->__deleteAllDocuments($id);
				
				$this->Session->setFlash("Registro eliminado correctamente. $documents_status ", 'flash_bootstrap_success');
				$this->redirect(array('action' => 'index'));
				
			} else {
				
				$this->Session->setFlash('Foto del propietario eliminada correctemente, datos del registro no eliminados.', 'flash_bootstrap_alert');
				$this->redirect($this->referer);
				
			}
			
		} else {
			
			$this->Session->setFlash('El registro no fue eliminado, intentalo nuevamente.', 'flash_bootstrap_error');
			$this->redirect($this->referer);
			
		}
		
	}
	
	public function docs($id = null) {
		
		$this->Form->id = $id;
		
		if ( !$this->Form->exists() )
			throw new NotFoundException('Identificador de registro no valido.');
		
		$this->set('title_for_layout', 'Administración de documentos');
		$this->set('form_id', $id);
		
		$documents = $this->__getDocumentList($id);
		$this->set(compact('documents'));
		
	}
	
	public function replace_document() {
		
		$this->request->onlyAllow('post');
		
		$caption = $this->__getDocumentCaptionFromType($this->request->data['Form']['type']);
		
		// Replace document
		if ( $this->__uploadDocument($this->request->data['Form']['file'], $this->request->data['Form']['form_id'], $this->request->data['Form']['type']) )
			$this->Session->setFlash("El documento $caption se cargo correctamente.", 'flash_bootstrap_success');
		else
			$this->Session->setFlash("El documento $caption no se cargo correctamente.", 'flash_bootstrap_error');
		
		$this->redirect( array('action' => 'docs', $this->request->data['Form']['form_id']) );
		
	}
	
	public function delete_document($form_id = null) {
		
		if ( !$form_id )
			throw new NotFoundException('Identificador de registro no valido.');
		
		$this->request->onlyAllow('post', 'delete');
		
		$document_type = $this->request->pass[0];
		$form_id = $this->request->pass[1];
		
		$caption = $this->__getDocumentCaptionFromType($document_type);
		
		// Delete document
		if ( $this->__deleteDocument($form_id, $document_type) )
			$this->Session->setFlash("El documento $caption eliminado correctamente.", 'flash_bootstrap_success');
		else
			$this->Session->setFlash("El documento $caption NO se eliminó del sistema.", 'flash_bootstrap_error');
		
		$this->redirect( array('action' => 'docs', $form_id) );
		
	}
	
	public function cedula($form_id = null) {
		
		if ( !$form_id )
			throw new NotFoundException('Identificador de registro no válido.');
		
		$this->layout = 'fpdf_cedula';
		
		$form = $this->Form->findById($form_id);
		
		if ( $form['Form']['birthday'] != '0000-00-00' ) {
			
			$today = new DateTime("now");
			$birthday = new DateTime( $form['Form']['birthday'] );
			$form['Form']['age'] = $today->diff($birthday)->format('%y');
			
		}
		
		$form['Form']['recent_photo'] = $this->__getDocument('recent_photo', $form_id);
		
		$this->set(compact('form'));
		
	}
	
	public function etiqueta($form_id = null) {
		
		if ( !$form_id )
			throw new NotFoundException('Identificador de registro no válido.');
		
		$this->layout = 'fpdf_etiqueta';
		
		$form = $this->Form->findById($form_id);
		
		if ( $form['Form']['birthday'] != '0000-00-00' ) {
			
			$today = new DateTime("now");
			$birthday = new DateTime( $form['Form']['birthday'] );
			$form['Form']['age'] = $today->diff($birthday)->format('%y');
			
		}
		
		$this->set(compact('form'));
		
	}
	
	private function __getMonthListInSpanish() {
		return $months_spanish = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
	}
	
	private function __getOwnersPhoto($form_id = null) {
		
		if ( !$form_id ) return false;
		
		$owners_photo = Configure::read('owners_photos_path') . DS . $form_id . '.jpg';
		
		return ( file_exists($owners_photo) ) ? Configure::read('documents_folder_name') . DS . 'owners' . DS . $form_id . '.jpg': 'no_photo.jpg';
		
	}
	
	private function __getDocumentList($form_id = null) {
		
		if ( !$form_id ) return array();
		
		// Get list of types for documents
		$document_types = Configure::read('document_types');
		
		// Get path for documents
		$documents_path = Configure::read('documents_path');
		
		$document_list = array();
		
		foreach ( $document_types as $index => $data ) {
			
			$filename = $documents_path . DS . $data['type'] . DS . $form_id . '.jpg';
			
			if ( file_exists( $filename ) ) {
				$document_types[$index]['img'] = Configure::read('documents_folder_name') . DS . $data['type'] . DS . $form_id . '.jpg';
				$document_types[$index]['date'] = ucwords( strftime("%A %e, %B %Y @ %k:%M hrs.", filemtime( $filename ) ) );
				$document_types[$index]['exists'] = 1;
			} else { 
				$document_types[$index]['img'] = 'no_document.jpg';
				$document_types[$index]['date'] = 'Sin fecha';
				$document_types[$index]['exists'] = 0;
			}
			
		}
		
		return $document_types;
		
	}
	
	private function __getDocument($document_type = null, $form_id = null) {
		
		if ( !$document_type || !$form_id )
			return false;
		
		$document_list = $this->__getDocumentList($form_id);
		
		foreach ($document_list as $index => $data) {
			if ( $document_type == $data['type'] )
				return $document_list[$index];
		}
		
		return false;
		
	}
	
	private function __getSchedule($form = array()) {
		
		if ( empty($form) || !is_array($form) ) return false;
		
		if ( $form['Form']['schedule_id'] == '0' )
			$schedule = json_decode( $form['Form']['commerce_schedule'],  true );
		else 
			$schedule = json_decode( $form['Schedule']['data'], true );
		
		foreach ( $schedule as $day => $details ) {
			
			if ( !isset($details['open']) )
				unset( $schedule[$day] );
			
		}
		
		return $schedule;
		
	}
	
	private function __deleteOwnersPhoto($form_id = null) {
		
		if ( !$form_id ) return false;
		
		$owners_photo = Configure::read('documents_path') . DS . 'owners' . DS . $form_id . '.jpg';
		
		return ( file_exists($owners_photo) ) ? unlink($owners_photo) : true;
		
	}
	
	private function __deleteDocument($form_id = null, $type = null) {
		
		if ( !$form_id || !$type ) return false;
		
		$document_path = Configure::read('documents_path') . DS . $type . DS . $form_id . '.jpg';
		
		return ( file_exists($document_path) ) ? unlink($document_path) : true;
		
	}
	
	private function __deleteAllDocuments($form_id = null) {
		
		if ( !$form_id ) return false;
		
		$response = array();
		
		$document_types = Configure::read('document_types');
		
		foreach ($document_types as $index => $data) {
			$type = $data['type'];
			$response[$type] = $this->__deleteDocument($form_id, $type);
		}
		
		return $response;
		
	}
	
	private function __getDocumentCaptionFromType($document_type) {
		
		if ( empty($document_type) || !$document_type ) return false;
		
		$document_types = Configure::read('document_types');
		
		foreach ( $document_types as $index => $document_data ) {
			if ( $document_data['type'] == $document_type )
				return $document_data['caption'];
		}
		
		return false;
		
	}
	
    private function __uploadDocument($file_data, $form_id = null, $type) {
    	
		if ( !is_array($file_data) || empty($file_data) || empty($file_data['name']) )
    		return false;
    	
    	if ( !$form_id )
    		return false;
    	
    	$documents_path = Configure::read('documents_path');
    	
    	switch ($type) {
    		case 'owner_photo':
    			$subdir = 'owners';
    			break;
    		default:
    			$subdir = $type;
    	}
    	
    	// File extension
    	$path_info = pathinfo($file_data['name']);
    	$file_extension = $path_info['extension'];
    	
    	// File name
    	$file_name = "$form_id.$file_extension";
    	
    	// Full path for document directory
    	$full_document_path_dir = $documents_path . DS . $subdir;
    	
    	// Full path for document image
    	$full_document_path = $full_document_path_dir . DS . $file_name;
    	
    	// Check if directory exists
    	if ( !file_exists($full_document_path_dir) )
    		mkdir( $full_document_path_dir );
    	
    	// Move file to the final destination
		return move_uploaded_file($file_data['tmp_name'], $full_document_path);
    	
    }
	
	private function __documentValidType($file_data) {
		
		if ( !is_array($file_data) ) return false;
		
		if ( empty($file_data['name']) ) return false;
		
		$valid_types = Configure::read('document_valid_types');
		
		foreach ($valid_types as $index => $type) {
			if ( preg_match_all("/$type/i", $file_data['type']) )
				return true;
		}
		
		return false;
	}
	
}
