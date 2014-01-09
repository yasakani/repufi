<?php
App::uses('AppController', 'Controller');

class SchedulesController extends AppController {
	
	public function index() {
		$this->set('title_for_layout', 'Horarios');
		$this->Schedule->recursive = 0;
		$this->set('schedules', $this->paginate());
	}
	
	public function view($id = null) {
		
		if ( !$this->Schedule->exists($id) ) {
			throw new NotFoundException('Identificador de horario no válido.');
		} 
		
		$this->set('title_for_layout', 'Detalles de horario');
		
		$this->Schedule->id = $id;
		$schedule = $this->Schedule->read();
		
		$schedule['Schedule']['data'] = json_decode($schedule['Schedule']['data'], true);
		
		$this->set(compact('schedule'));
		
	}
	
	public function add() {
		
		$this->set('title_for_layout', 'Agregar horario');
		
		if ( $this->request->is('post') || $this->request->is('ajax') ) {
			
			$this->Schedule->create();
			
			// User ID capturing data
			$this->request->data['Schedule']['created_by'] = $this->Authake->getLogin();
			
			// Schedule data
			$this->request->data['Schedule']['data'] = json_encode($this->request->data['Schedule']['data']);
			
			// Save data
			if ( $this->Schedule->save( $this->request->data ) ) {
				
				if ( $this->request->is('ajax') ) {
					$this->layout = null;
					$response = array('status' => true, 'msg' => "Datos de horario capturados correctamente.", 'schedule_id' => $this->Schedule->id);
					$this->set('response', json_encode($response));
					$this->render('addjson');
				} else {
					$this->Session->setFlash('Datos de horario capturados correctamente.', 'flash_bootstrap_success');
					$this->redirect(array('action' => 'index'));
				}
				
			} else {
				
				if ( $this->request->is('ajax') ) {
					$this->layout = null;
					$response = array('status' => false, 'msg' => "Ocurrio un problema al capturar datos de horario, intentalo nuevamente.");
					$this->set('response', json_encode($response));
					$this->render('addjson');
				} else
					$this->Session->setFlash('Ocurrio un problema al capturar datos de horario, intentalo nuevamente.', 'flash_bootstrap_error');
				
			}
			
		} else {
			
			$hours_a_day = $this->hoursDay();
			$this->set(compact('hours_a_day'));
			
		}
		
	}
	
	public function edit($id = null) {
		
		$this->set('title_for_layout', 'Editar datos de horario');
		
		if ( !$this->Schedule->exists($id) ) {
			throw new NotFoundException('Identificador de horario no válido.');
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->Schedule->id = $id;
			
			// Schedule data
			$this->request->data['Schedule']['data'] = json_encode($this->request->data['Schedule']['data']);
			
			if ( $this->Schedule->save( $this->request->data) ) {
				
				$this->Session->setFlash('Datos de horario capturados correctamente.', 'flash_bootstrap_success');
				$this->redirect(array('action' => 'index'));
				
			} else $this->Session->setFlash('Ocurrio un problema al capturar datos de horario, intentalo nuevamente.', 'flash_bootstrap_error');
			
		} else {
			
			$hours_a_day = $this->hoursDay();
			$this->set( compact('hours_a_day') );
			
			$schedule = $this->Schedule->find('first', array('conditions' => array('Schedule.id' => $id)));
			$schedule['Schedule']['data'] = json_decode($schedule['Schedule']['data'], true);
			$this->request->data = $schedule;
			$this->set(compact('schedule'));
			
		}
		
	}
	
	public function delete($id = null) {
		$this->Schedule->id = $id;
		if (!$this->Schedule->exists()) {
			throw new NotFoundException('Identificador de horario no válido.');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Schedule->delete()) {
			$this->Session->setFlash('Datos de horario eliminados correctamente.', 'flash_bootstrap_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Los datos de horario no se pudieron eliminar, intentalo nuevamente.', 'flash_bootstrap_error');
		$this->redirect(array('action' => 'index'));
	}
	
	public function listing($dataType = 'json') {
		
		$this->request->onlyAllow('ajax');
		$this->layout = 'ajax';
		
		$params = array(
			'order' => array( array('Schedule.name DESC') ),
			'recursive' => 0
		);
		
		$schedules = $this->Schedule->find('all', $params);
		$this->set(compact('schedules'));
		
		switch($dataType) {
			case 'html':
				$this->render('listing_html');
				break;
			case 'json':
				$this->render('listing_json');
				break;
		}
		
	}
	
}
