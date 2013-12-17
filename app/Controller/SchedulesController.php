<?php
App::uses('AppController', 'Controller');

class SchedulesController extends AppController {
	
	public function index() {
		$this->set('title_for_layout', 'Horarios para comercios');
		$this->Schedule->recursive = 0;
		$schedules = $this->Schedule->find('all', array('order' => 'sequence DESC'));
		$this->set(compact('schedules'));
	}
	
	public function view($id = null) {
		
		if ( !$this->Schedule->exists($id) ) {
			throw new NotFoundException(__('Invalid squedule preset id.'));
		} 
		
		$this->Schedule->id = $id;
		$schedule = $this->Schedule->read();
		
		$schedule['Schedule']['data'] = json_decode($schedule['Schedule']['data'], true);
		
		$this->set(compact('schedule'));
		
	}
	
	public function add() {
		
		$this->set('title_for_layout', 'Agregar horario para comercios');
		
		if ( $this->request->is('post') ) {
			
			$this->Schedule->create();
			
			// User ID capturing data
			$this->request->data['Schedule']['created_by'] = $this->Authake->getLogin();
			
			// Schedule data
			$this->request->data['Schedule']['data'] = json_encode($this->request->data['Schedule']['data']);
			
			// Save data
			if ( $this->Schedule->save( $this->request->data ) ) {
				
				$this->Session->setFlash('Datos de horario capturados correctamente.');
				$this->redirect(array('action' => 'index'));
				
			}
			
		} else {
			
			$hours_a_day = $this->__getHoursADay();
			$this->set(compact('hours_a_day'));
			
		}
		
	}
	
	public function edit($id = null) {
		
		$this->set('title_for_layout', 'Editar datos de horario');
		
		if ( !$this->Schedule->exists($id) ) {
			throw new NotFoundException(__('Invalid squedule preset id.'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->Schedule->id = $id;
			
			// Schedule data
			$this->request->data['Schedule']['data'] = json_encode($this->request->data['Schedule']['data']);
			
			if ( $this->Schedule->save( $this->request->data) ) {
				
				$this->Session->setFlash(__('The form has been saved'));
				$this->redirect(array('action' => 'index'));
				
			} else $this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			
		} else {
			
			$hours_a_day = $this->__getHoursADay();
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
			throw new NotFoundException(__('Invalid schedule preset id.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Schedule->delete()) {
			$this->Session->setFlash(__('Schedule deleted.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Schedule was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 * Hours a day
	 */
	private function __getHoursADay() {
			
		$hours_a_day = array();
			
		for ( $i = 0; $i <= 1410; $i = $i + 30) {
			$tmp_timestamp = mktime(0, 0 + $i, 0, date('m'), date('d'), date('Y'));
			$hours_a_day[] = date('H:i', $tmp_timestamp);
		}
		
		return $hours_a_day;
		
	}
	
}
