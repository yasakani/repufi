<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            echo $this->Html->meta('icon');
            echo $this->fetch('meta');
            echo $this->Html->css( array('bootstrap.min', 'bootstrap-responsive.min', 'pyem-login') );
            echo $this->fetch('css');
            echo $this->Html->script( array('jquery-1.9.1.min', 'bootstrap.min', 'login') );
            echo $this->fetch('script');
        ?>
        <title><?php echo $title_for_layout; ?></title>
    </head>
    
    <body>
        
        <div class="container">
            <?php 
                //echo $this->Session->flash();
                echo $this->fetch('content');
            ?>
        </div>
        
    </body>
    
</html>