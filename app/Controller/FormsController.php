<?php
App::uses('AppController', 'Controller');
/**
 * Forms Controller
 *
 * @property Form $Form
 */
class FormsController extends AppController {

	public $paginate = array(
		'limit' => 50,
		'order' => array(
			'Form.created' => 'desc'
		)
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
		
		$commerce_suburb_data = $this->Form->Suburb->findById($form['Form']['commerce_suburb_id']);
		$form['Form']['commerce_suburb'] = ( !empty($commerce_suburb_data) ) ? $commerce_suburb_data['Suburb']['name'] : 'No especificada';
		
		if ( $form['Form']['birthday'] != '0000-00-00' ) {
			
			$today = new DateTime("now");
			$birthday = new DateTime( $form['Form']['birthday'] );
			$form['Form']['age'] = $today->diff($birthday)->format('%y');
			
		}
		
		// Generate QRcode for existing records
		$qr_code = $this->__generateQrcode($id);
		$form['Form']['qrcode'] = ( $qr_code ) ? $qr_code: 'no_qr.png';
		
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
				
				// QRcode
				$this->__generateQrcode($this->Form->id);
				// Search result json
				$this->__generateSearchResults();
				$this->__generateCommerceOrders();
				
				$this->setFlash('Datos de registro capturados correctamente.', 'flash_bootstrap_success');
				
				if ( !empty($this->request->data['Form']['owner_photo']['name']) ) {
					
					if ( $this->__documentValidType($this->request->data['Form']['owner_photo']) ) {
						
						if ( $this->__uploadDocument($this->request->data['Form']['owner_photo'], $id, 'owner_photo') ) 
							$this->setFlash('Imagen de propitario cargada correctamente.', 'flash_bootstrap_success');
						else
							$this->setFlash('Ocurrio un problema al cargar la imagen de propietario, intentalo nuevamente.', 'flash_bootstrap_error');
						
					} else
						$this->setFlash('Tipo de imagen para propietario no permitida.', 'flash_bootstrap_error');
					
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
			
			$hours_day = $this->hoursDay();
			$this->set(compact('hours_day'));
		    
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
				
				// Search result json
				$this->__generateSearchResults();
				$this->__generateCommerceOrders();
				
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
		
		$this->request->data['Form']['birthday'] = $this->__getFixedBirthday($this->request->data);
		
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
		
		if ( $this->__deleteOwnersPhoto($id) && $this->__deleteQrcode($id) ) {
			
			if ( $this->Form->delete() ) {
				
				// Search results json
				$this->__generateSearchResults();
				$this->__generateCommerceOrders();
				
				$documents_status = $this->__deleteAllDocuments($id);
				
				$this->Session->setFlash("Registro eliminado correctamente.", 'flash_bootstrap_success');
				$this->redirect(array('action' => 'index'));
				
			} else {
				
				$this->Session->setFlash('Foto del propietario eliminada correctemente, datos del registro no eliminados.', 'flash_bootstrap_alert');
				$this->redirect($this->referer);
				
			}
			
		} else {
			
			$this->setFlash('Imagen de propietario o QRcode no eliminados.', 'flash_bootstrap_error');
			$this->setFlash('El registro no fue eliminado, intentalo nuevamente.', 'flash_bootstrap_error');
			
			$this->redirect($this->referer);
			
		}
		
	}
	
	public function search($form_id = null) {
		
		$this->set('title_for_layout', 'Resultado de busqueda');
		
		if ( !$form_id && $this->request->is('post') ) {
			
			$query = $this->request->data['Form']['query'];
			
			if ( empty($query) ) {
				$this->Session->setFlash('Criterio de busqueda no especificado.', 'flash_bootstrap_error');
				$this->redirect('/');
			}
			
			$options = array(
				'conditions' => array(
					'or' => array(
						'Form.full_name LIKE' => "%$query%",
						"Form.folio LIKE" => "%$query%"
					)
				)
			);
			
			$forms = $this->Form->find('all', $options);
			
			$this->set(compact('query'));
			$this->set(compact('forms'));
			
		} else if ( $form_id && $this->request->is('get') ) {
			$this->redirect(array('action' => 'view', $form_id));
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
		
		// Valid document filetype
		if ( $this->__documentValidType($this->request->data['Form']['file']) || $this->request->data['Form']['file']['error'] == 1 ) {
			
			// Filesize
			if ( $this->request->data['Form']['file']['size'] <= Configure::read('document_image_size') ) {
				
				// Delete current file
				if ( $this->__deleteDocument($this->request->data['Form']['form_id'], $this->request->data['Form']['type']) ) {
					
					// Replace document
					if ( $this->__uploadDocument($this->request->data['Form']['file'], $this->request->data['Form']['form_id'], $this->request->data['Form']['type']) )
						$this->Session->setFlash("El documento $caption se cargo correctamente.", 'flash_bootstrap_success');
					else
						$this->Session->setFlash("El documento $caption no se cargo correctamente.", 'flash_bootstrap_error');
					
				} else 
					$this->Session->setFlash("Ocurrio un problema al cargar documento, intentalo nuevamente.", 'flash_bootstrap_error');
				
			} else
				$this->Session->setFlash("Archivo de imagen demasiado grande.", 'flash_bootstrap_error');
			
		} else
			$this->Session->setFlash("Tipo de imagen para documento no permitida.", 'flash_bootstrap_error');
		
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
		
		$form['Form']['owner_photo'] = $this->__getOwnersPhoto($form_id);
		$form['Form']['recent_photo'] = $this->__getDocument('recent_photo', $form_id);
		
		$this->set(compact('form'));
		$this->set('year', $this->passedArgs[1]);
		
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
		
		$commerce_suburb_data = $this->Form->Suburb->findById($form['Form']['commerce_suburb_id']);
		$form['Form']['commerce_suburb'] = ( !empty($commerce_suburb_data) ) ? $commerce_suburb_data['Suburb']['name'] : 'No especificada';
		
		$this->set(compact('form'));
		$this->set('year', $this->passedArgs[1]);
		
	}
	
	public function fixstatus() {
		
		$forms = $this->Form->find('all');
		
		foreach ($forms as $index => $form) {
			
			$this->Form->create();
			
			$this->Form->id = $form['Form']['id'];
			
			$receipt_number = $form['Form']['receipt_number'];
			$status = $form['Form']['status'];
			
			if ( $receipt_number != '0' && $status != '1' ) {
				
				$data['Form']['status'] = 1;
				
				if ( $this->Form->save( $data ) )
					debug("Resgistro: ID:{$form['Form']['id']}, Recibo: $receipt_number, Status: $status [CORREGIDO]");
				else
					debug("Registro: ID:{$form['Form']['id']}, Datos sin actualizar [ERROR]");
				
			} else {
				
				debug("Registro: ID:{$form['Form']['id']} no requiere corrección de estatus.");
				
			}
			
		}
		
		exit;
		
	}
	
	private function __getFixedBirthday($form_data = array()) {
		
		if ( empty($form_data) )
			return false;
		
		$age = $form_data['Form']['age'];
		$birthday = $form_data['Form']['birthday'];
		
		if ( $age != '0' && $birthday == '0000-00-00' ) {
			
			$created = $form_data['Form']['created'];
			$created_timestamp = strtotime($created);
			
			$birthday_fix = mktime(date("H", $created_timestamp), date("i", $created_timestamp), date("s", $created_timestamp), date("n", $created_timestamp), date("j", $created_timestamp), date("Y", $created_timestamp) - $age);
			return $birthday_fix_date = date("Y-m-d", $birthday_fix);
			
		}
		
		return $birthday;
		
	}
	
	private function __generateQrcode($form_id = null) {
		
		if ( !$form_id )
			return false;
		
		$qrcodes_path = IMAGES . "qrcodes" . DS;
		$filename = "qrcode_$form_id.png";
		
		$png_absolute_file_path = $qrcodes_path . $filename;
		
		if ( is_writable($qrcodes_path) ) {
			
			if ( file_exists($png_absolute_file_path) )
				return 'qrcodes' . DS . $filename;
			else {
				
				include( APP . 'Vendor' . DS . 'phpqrcode' . DS . 'qrlib.php' );
				
				$code_contents = FULL_BASE_URL . DS . 'repufi' . DS . $form_id;
				
				QRcode::png($code_contents, $png_absolute_file_path, QR_ECLEVEL_L, 4, 2);
				
				return 'qrcodes' . DS . $filename;
				
			}
			
		} else 
			$this->Session->setFlash('El directorio para codigos QR no esta disponible, contacta con el administrador del sistema.', 'flash_bootstrap_error');
		
		return false;
		
	}
	
	private function __deleteQrcode($form_id = null) {
		
		if ( !$form_id )
			return false;
		
		$qrcodes_path = IMAGES . "qrcodes" . DS;
		$filename = "qrcode_$form_id.png";
		
		$png_absolute_file_path = $qrcodes_path . $filename;
		
		return unlink($png_absolute_file_path);
		
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
			
			$ext = $this->__getDocumentImageExt($form_id, $data['type']);
			
			$filename = $documents_path . DS . $data['type'] . DS . $form_id . '.' . $ext;
			
			if ( file_exists( $filename ) ) {
				$document_types[$index]['img'] = Configure::read('documents_folder_name') . DS . $data['type'] . DS . $form_id . '.' . $ext;
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
	
	private function __getDocumentImageExt($form_id, $document_type) {
		
		// Get path for documents
		$documents_path = Configure::read('documents_path');
		
		// Get valid images for documents
		$documents_image_types = Configure::read('document_valid_image_types');
		
		foreach ( $documents_image_types as $mimetype => $extensions ) {
			foreach ( $extensions as $ext ) {
				if ( file_exists( $documents_path . DS . $document_type . DS . "$form_id.$ext" ) ) {
					return $ext;
				}
			}
		}
		
		return false;
		
	}
	
	private function __getSchedule($form = array()) {
		
		if ( empty($form) || !is_array($form) ) return false;
		
		if ( $form['Form']['schedule_id'] == '0' || !$form['Form']['schedule_id'] )
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
		
		$ext = $this->__getDocumentImageExt($form_id, $type);
		
		$document_path = Configure::read('documents_path') . DS . $type . DS . "$form_id.$ext";
		
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
		
		$valid_types = Configure::read('document_valid_image_types');
		
		foreach ($valid_types as $mimetype => $extensions) {
			if ( $file_data['type'] == $mimetype )
				return true;
		}
		
		return false;
		
	}
	
	private function __generateSearchResults() {
		
		$forms = $this->Form->find('all');
		
		$results = array();
		
		foreach ($forms as $index => $form) {
			$results[] = "{$form['Form']['id']}:{$form['Form']['full_name']}";
			$results[] = "{$form['Form']['id']}:{$form['Form']['folio']}";
		}
		
		$results = json_encode($results, true);
		
		App::uses('File', 'Utility');
		
		$file = new File(WWW_ROOT . 'files' . DS . 'search_results.json');
		
		if ( !$file->exists() )
			$file->create();
		
		return $file->write($results, 'w', true);
		
	}
	
	private function __generateCommerceOrders() {
		
		$params = array(
			'recursive' => 0,
			'fields' => array('Form.commerce_order'),
			'group' => array('Form.commerce_order')
		);
		
		$forms = $this->Form->find('all', $params);
		
		$results = array();
		
		foreach ($forms as $form) {
			$results[] = $form['Form']['commerce_order'];
		}
		
		$results = json_encode($results, true);
		
		App::uses('File', 'Utility');
		
		$file = new File(WWW_ROOT . 'files' . DS . 'commerce_orders.json');
		
		if ( !$file->exists() )
			$file->create();
		
		return $file->write($results, 'w', true);
		
	}
	
}
