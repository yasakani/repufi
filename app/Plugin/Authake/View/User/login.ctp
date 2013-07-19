<div id="login-register-img" style="display:none; width: 290px; height: 73px;">
    <?php echo $this->Html->image('repufi_logo_temp', array('alt' => 'REPUFI', 'title' => 'REPUFI')); ?>
</div>

<?php echo $this->Form->create(null, array('class' => 'form-signin', 'style' => 'display:none;', 'url' => array('controller' => 'user', 'action' => 'login'))); ?>
    <?php echo $this->Form->label('login', 'Nombre de usuario');  ?>
    <?php echo $this->Form->input('login', array('div' => false, 'label' => false)); ?>
    <?php echo $this->Form->label('password', 'Contraseña');  ?>
    <?php echo $this->Form->input('password', array('div' => false, 'label' => false)); ?>
    <div class="text-right">
        <button type="submit" class="btn btn-info">Acceder</button>
    </div>
    
<?php echo $this->Form->end(); ?>

<!--div id="login-register" style="display:none;">
    
    <?php //if ( Configure::read('Authake.registration') == true ) : ?>
    <?php echo $this->Html->link("Olvide mi contraseña...", array('action' => 'lost_password'), array('class' => 'btn btn-mini')); ?>
    <?php echo $this->Html->link("Registro", array('action' => 'register'), array('class' => 'btn btn-success btn-mini')); ?>
    <?php //endif; ?>
    
</div-->



    <!--div class="container">
        <div class="section span6 offset3">
            <div class="row-fluid">
                <?php echo $this->Form->create(null, array('url' => array('controller' => 'user', 'action'=>'login')));?>
                <div class="section-header">
                    <h3><?php  echo __('Login'); ?></h3>
                    <div class="section-actions">
                        <?php if(Configure::read('Authake.registration') == true){?>
                        <?php echo $this->Html->link(__("I forgot my password..."), array('action'=>'lost_password'),array('class'=>'btn btn-mini')); ?>
                         <?php echo $this->Html->link(__("Sign In"), array('action'=>'register'), array('class'=>'btn btn-success btn-mini'))?>
                        <?php };?>
                    </div>
                </div>
                <div class="section-body">
                    <?php 
                    echo $this->Form->input('login', array('label'=>'Login', 'size'=>'14'));
                    echo $this->Form->input('password', array('label'=>'Password', 'value' => '', 'size'=>'14'));
                    ?>
                </div>
                <div class="section-footer">
                    <div class="control-group">
                        <div class="form-actions">
                        <?php echo $this->Form->end(array('div'=>false,'label'=>'Login','class'=>'action input-action btn btn-info'));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div-->
