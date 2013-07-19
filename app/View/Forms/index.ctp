<div class="forms index">
    
	<h2>Registros</h2>
	
	<table cellpadding="0" cellspacing="0">
	   <tr>
	    <!-- user data -->
        <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
        <th><?php echo $this->Paginator->sort('photo', 'Foto'); ?></th>
        <th><?php echo $this->Paginator->sort('name', 'Nombre'); ?></th>
        <th><?php echo $this->Paginator->sort('lastname_pater', 'Apellido Paterno'); ?></th>
        <th><?php echo $this->Paginator->sort('lastname_mater', 'Apellido Materno'); ?></th>
        <!-- datos del comercio -->
        <th><?php echo $this->Paginator->sort('commerce_location'); ?></th>
        <th><?php echo $this->Paginator->sort('commece_latitude'); ?></th>
        <th><?php echo $this->Paginator->sort('commerce_longitude'); ?></th>
        
        
        
        <th><?php echo $this->Paginator->sort('commerce_width'); ?></th>
        <th><?php echo $this->Paginator->sort('commerce_long'); ?></th>
        <th><?php echo $this->Paginator->sort('commerce_square_meters'); ?></th>
        <!-- status de pago -->
        <th><?php echo $this->Paginator->sort('receipt_id'); ?></th>
        <!-- actions-->
        <th>&nbsp;</th>
	</tr>
	<?php foreach ($forms as $form): ?>
	<tr>
		<td><?php echo h($form['Form']['id']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['photo']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['name']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['lastname_pater']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['lastname_mater']); ?>&nbsp;</td>
		
		<td><?php echo h($form['Form']['commerce_location']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['commece_latitude']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['commerce_longitude']); ?>&nbsp;</td>
		
		<td><?php echo h($form['Form']['commerce_width']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['commerce_long']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['commerce_square_meters']); ?>&nbsp;</td>
		
        <td><?php echo h($form['Form']['receipt_id']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $form['Form']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $form['Form']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $form['Form']['id']), null, __('Are you sure you want to delete # %s?', $form['Form']['id'])); ?>
		</td>
		
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
