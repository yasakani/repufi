<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            echo $this->Html->meta('icon', '/favicon.ico');
            echo $this->fetch('meta');
            echo $this->Html->css( array('bootstrap.min', 'bootstrap-responsive.min', 'chika') );
            echo $this->fetch('css');
            echo $this->Html->script( array('jquery-1.9.1.min', 'bootstrap.min', 'chika') );
            echo $this->fetch('script');
        ?>
        <title>REPUFI &raquo; <?php echo $title_for_layout; ?></title>
    </head>
    
    <body>
        
        <div id="container" class="container">
            
            <div id="navbar" class="navbar navbar-static-top">
                <div class="navbar-inner">
                    <a class="brand" href="/">REPUFI</a>
                    
                    <ul class="nav">
                        <li <?php echo ( $this->request->controller == 'forms' && $this->request->action == 'index' ) ? 'class="active"': ''; ?>>
                            <a href="/">Registros</a>
                        </li>
                        <!--li <?php echo ( $this->request->controller == 'forms' && $this->request->action == 'map' ) ? 'class="active"': ''; ?>>
                            <?php echo $this->html->link('Mapa', array('controller' => 'forms', 'action' => 'map')); ?>
                        </li-->
                        <li class="divider-vertical"></li>
                        <li <?php echo ( $this->request->controller == 'forms' && $this->request->action == 'add' ) ? 'class="active"': ''; ?>>
                            <?php echo $this->html->link('Captura', array('controller' => 'forms', 'action' => 'add')); ?>
                        </li>
                        <li class="divider-vertical"></li>
                    </ul>
                    
                    <!--form class="navbar-search pull-left">
                      <input type="text" class="search-query" placeholder="Buscar">
                    </form-->
                    
                    <?php if ( $this->Session->read('Authake.login') && $this->Session->read('Authake.group_names.0') == 'Administrators' ) : ?>
                    <ul class="nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Configuraci&oacute;n
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php echo $this->Html->link('Administración de Usuarios', '/usuarios'); ?>
                                </li>
                                
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Colonias</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <?php echo $this->Html->link('Lista de colonias', array('controller' => 'suburbs', 'action' => 'index')); ?>
                                        </li>
                                        <li>
                                            <?php echo $this->Html->link('Agregar colonia', array('controller' => 'suburbs', 'action' => 'add')); ?>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Categorías</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <?php echo $this->Html->link('Lista de categorias', array('controller' => 'categories', 'action' => 'index')); ?>
                                        </li>
                                        <li>
                                            <?php echo $this->Html->link('Agregar categoría', array('controller' => 'categories', 'action' => 'add')); ?>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Horarios</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <?php echo $this->Html->link('Lista de horarios', array('controller' => 'schedules', 'action' => 'index')); ?>
                                        </li>
                                        <li>
                                            <?php echo $this->Html->link('Agregar horario', array('controller' => 'schedules', 'action' => 'add')); ?>
                                        </li>
                                    </ul>
                                </li>
                                
                                <!--li>
                                    <?php echo $this->Html->link('Reportes', '/reportes'); ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link('Estatus de comercios', '/estatus'); ?>
                                </li-->
                            </ul>
                        </li>
                    </ul>
                    <?php endif; ?>
                    
                    <?php if ( $this->Session->read('Authake.login') ) : ?>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <strong><?php echo $this->Session->read('Authake.login'); ?></strong>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php echo $this->Html->link('Salir del sistema', '/salir'); ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php endif; ?>
                    
                    </p>
                </div>
            </div>
            
            <div id="header">
                
                <h1>
                    <?php echo $this->Html->image('cizcalli_logo.png', array('id' => 'logo_cizcalli')); ?>
                    REPUFI
                    <small>Recaudación para Púestos Fijos, Semi-fijos y Ambulantes.</small>
                </h1>
                
            </div>
            
            <div id="content">
                <?php
                	if ($this->Session->check('Message.flash'))
                		echo $this->Session->flash(); // the standard messages
                	
                	// multiple messages
                	if ( $messages = $this->Session->read('Message.multiFlash') ) {
                		foreach($messages as $index => $flash) {
                			echo $this->Session->flash("multiFlash.$index");
						}
					}
                    
                    echo $this->fetch('content');
                ?>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>