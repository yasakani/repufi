<div class="forms form">
<?php echo $this->Form->create('Form'); ?>
	<fieldset>
		<legend><?php echo __('Edit Form'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('lastname_pater');
		echo $this->Form->input('lastname_mater');
		echo $this->Form->input('address');
		echo $this->Form->input('suburb_id');
		echo $this->Form->input('age');
		echo $this->Form->input('receipt_id');
		echo $this->Form->input('photo');
		echo $this->Form->input('commerce_location');
		echo $this->Form->input('commece_latitude');
		echo $this->Form->input('commerce_longitude');
		echo $this->Form->input('order');
		echo $this->Form->input('commerce_width');
		echo $this->Form->input('commerce_long');
		echo $this->Form->input('commerce_square_meters');
		echo $this->Form->input('commerce_squedule_open');
		echo $this->Form->input('commerce_squedule_close');
		echo $this->Form->input('scan_receipt');
		echo $this->Form->input('scan_commerce_photo');
		echo $this->Form->input('scan_rights');
		echo $this->Form->input('scan_user_photo');
		echo $this->Form->input('scan_address');
		echo $this->Form->input('scan_sanity');
		echo $this->Form->input('scan_ife');
		echo $this->Form->input('scan_repecos');
		echo $this->Form->input('scan_ambient');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Form.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Form.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('action' => 'index')); ?></li>
	</ul>
</div>
