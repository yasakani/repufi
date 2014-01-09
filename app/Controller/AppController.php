<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    var $helpers = array('Form', 'Time', 'Html', 'Session', 'Js', 'Authake.Authake');
    var $components = array('Session','RequestHandler', 'Authake.Authake', 'DebugKit.Toolbar');
    var $counter = 0;
    
    public function beforeFilter() {
    	setlocale(LC_TIME, 'es_MX.utf8');
        $this->layout = 'repufi';
        $this->auth();
    }
    
    private function auth(){
        Configure::write('Authake.useDefaultLayout', true);
        $this->Authake->beforeFilter($this);
    }
	
	public function setFlash($message, $element = 'default', $params = array(), $key = 'flash') {
		
		$messages = (array)$this->Session->read('Message.multiFlash');
		
		$messages[] = array(
			'message' => $message,
			'element' => $element,
			'params' => $params,
			'key' => $key
		);
		
        $this->Session->write('Message.multiFlash', $messages);
		
	}
	
	public function hoursDay() {
			
		$hours_a_day = array();
			
		for ( $i = 0; $i <= 1410; $i = $i + 30) {
			$tmp_timestamp = mktime(0, 0 + $i, 0, date('m'), date('d'), date('Y'));
			$hours_a_day[] = date('H:i', $tmp_timestamp);
		}
		
		return $hours_a_day;
		
	}
    
}
