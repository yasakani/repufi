<div class="suburbs index">
	<h2>Colonias</h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('ID'); ?></th>
			<th><?php echo $this->Paginator->sort('Nombre'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($suburbs as $suburb): ?>
	<tr>
		<td><?php echo h($suburb['Suburb']['id']); ?>&nbsp;</td>
		<td><?php echo h($suburb['Suburb']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $suburb['Suburb']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $suburb['Suburb']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $suburb['Suburb']['id']), null, __('Are you sure you want to delete # %s?', $suburb['Suburb']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina {:page} de {:pages}, mostrando {:current} registro(s) de {:count} total, comenzando en registro {:start}, terminando en {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('Anterior '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ' | '));
		echo $this->Paginator->next(__(' Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
