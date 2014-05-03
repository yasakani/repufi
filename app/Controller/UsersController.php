<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
	
	var $uses = false;
	
	public function index() {
		$this->layout = 'login';
		$this->set('title_for_layout', 'Ingresar al sistema');
		
		if ( $this->Authake->isLogged() && $this->Authake->getPreviousUrl() == null ) {
			$this->redirect( array('controller' => 'forms', 'action' => 'index') );
		} else if ( $this->Authake->isLogged() && $this->Authake->getPreviousUrl() != null ) {
			$this->redirect( $this->Authake->getPreviousUrl() );
		}
		
	}
	
}
