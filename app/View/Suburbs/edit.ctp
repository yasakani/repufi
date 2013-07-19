<div class="suburbs form">
<?php echo $this->Form->create('Suburb'); ?>
	<fieldset>
		<legend><?php echo __('Edit Suburb'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Suburb.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Suburb.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Suburbs'), array('action' => 'index')); ?></li>
	</ul>
</div>
