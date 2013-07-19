<div class="suburbs form">
<?php echo $this->Form->create('Suburb'); ?>
	<fieldset>
		<legend><?php echo __('Add Suburb'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Suburbs'), array('action' => 'index')); ?></li>
	</ul>
</div>
