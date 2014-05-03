<div id="login-register-img" style="display:none; width: 290px; height: 73px;">
    <?php echo $this->Html->image('repufi_logo_temp.png', array('alt' => 'REPUFI', 'title' => 'REPUFI')); ?>
</div>

<?php echo $this->Form->create('User', array('id' => 'UserLoginForm', 'class' => 'form-signin', 'style' => 'display:none;', 'url' => array('plugin' => 'authake', 'controller' => 'user', 'action' => 'login'))); ?>
    <?php echo $this->Form->label('login', 'Nombre de usuario');  ?>
    <?php echo $this->Form->input('login', array('div' => false, 'label' => false)); ?>
    <?php echo $this->Form->label('password', 'Contraseña');  ?>
    <?php echo $this->Form->input('password', array('div' => false, 'label' => false)); ?>
    <div class="text-right">
        <button type="submit" class="btn btn-info">Acceder</button>
    </div>
<?php echo $this->Form->end(); ?>