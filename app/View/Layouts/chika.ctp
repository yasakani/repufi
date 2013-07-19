<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            echo $this->Html->meta('icon');
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
                    <a class="brand" href="#">REPUFI</a>
                    
                    <ul class="nav">
                        <li <?php echo ( $this->request->controller == 'forms' && $this->request->action == 'index' ) ? 'class="active"': ''; ?>>
                            <a href="/repufi">Registros</a>
                        </li>
                        <li <?php echo ( $this->request->controller == 'forms' && $this->request->action == 'add' ) ? 'class="active"': ''; ?>>
                            <?php echo $this->html->link('Captura', array('controller' => 'forms', 'action' => 'add')); ?>
                        </li>
                    </ul>
                    
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
                                            <?php echo $this->Html->link('Lista de Colonias', '/colonias'); ?>
                                        </li>
                                        <li>
                                            <?php echo $this->Html->link('Agregar Colonia', '/colonias/agregar'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <?php echo $this->Html->link('Reportes', '/reportes'); ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link('Estatus de comercios', '/estatus'); ?>
                                </li>
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
                    echo $this->Session->flash();
                    echo $this->fetch('content');
                ?>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>