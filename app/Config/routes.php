<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
 	Router::connect('/', array('controller' => 'users', 'action' => 'index'));
	//Router::connect('/', array('controller' => 'forms', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	// Simple logout in spanish
	Router::connect('/usuarios', array('plugin' => 'authake', 'controller' => 'users', 'action' => 'index'));
	//Router::connect('/entrar', array('plugin' => 'authake', 'controller' => 'user', 'action' => 'login'));
	Router::connect('/salir', array('plugin' => 'authake', 'controller' => 'user', 'action' => 'logout'));
	
	Router::connect('/mapa', array('controller' => 'forms', 'action' => 'map'));
	
	// Alias routes for forms
	Router::connect('/captura', array('controller' => 'forms', 'action' => 'add'));
	Router::connect('/registros', array('controller' => 'forms', 'action' => 'index'));
	Router::connect('/registros/buscar/*', array('controller' => 'forms', 'action' => 'search'));
	Router::connect('/registros/buscar.json', array('controller' => 'forms', 'action' => 'search', 'ext' => 'json'));
	Router::connect('/registros/ver/*', array('controller' => 'forms', 'action' => 'view'));
	Router::connect('/registros/editar/*', array('controller' => 'forms', 'action' => 'edit'));
	Router::connect('/registros/:action/*', array('controller' => 'forms'));
	
	// Alias for documents
	Router::connect('/documentos/*', array('controller' => 'forms', 'action' => 'docs'));
	
	// Alias routes for categories
	Router::connect('/categorias', array('controller' => 'categories', 'action' => 'index'));
	Router::connect('/categorias/agregar', array('controller' => 'categories', 'action' => 'add'));
	Router::connect('/categorias/editar/*', array('controller' => 'categories', 'action' => 'edit'));
	Router::connect('/categorias/detalle/*', array('controller' => 'categories', 'action' => 'view'));
	Router::connect('/categorias/eliminar/*', array('controller' => 'categories', 'action' => 'delete'));
	Router::connect('/categorias/:action/*', array('controller' => 'categories'));
	
	// Alies routes for suburbs
	Router::connect('/colonias', array('controller' => 'suburbs', 'action' => 'index'));
    Router::connect('/colonias/agregar', array('controller' => 'suburbs', 'action' => 'add'));
	
	// Alias routes for schedules
	Router::connect('/horarios', array('controller' => 'schedules', 'action' => 'index'));
	Router::connect('/horarios/agregar', array('controller' => 'schedules', 'action' => 'add'));
	Router::connect('/horarios/editar/*', array('controller' => 'schedules', 'action' => 'edit'));
	Router::connect('/horarios/detalle/*', array('controller' => 'schedules', 'action' => 'view'));
	Router::connect('/horarios/eliminar/*', array('controller' => 'schedules', 'action' => 'delete'));
	Router::connect('/horarios/:action/*', array('controller' => 'schedules'));
	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
