<div class="suburbs view">
<h2><?php  echo __('Suburb'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($suburb['Suburb']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($suburb['Suburb']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Suburb'), array('action' => 'edit', $suburb['Suburb']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Suburb'), array('action' => 'delete', $suburb['Suburb']['id']), null, __('Are you sure you want to delete # %s?', $suburb['Suburb']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Suburbs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suburb'), array('action' => 'add')); ?> </li>
	</ul>
</div>
