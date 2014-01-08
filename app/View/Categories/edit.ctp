<div id="categories-edit">
	
	<h2>
		Editar categoría
	</h2>
	
	<div class="text-right">
		<ul class="inline">
			<li><?php echo $this->Html->link('Lista de categorías', array('action' => 'index'), array('class' => 'btn btn-small')); ?></li>
			<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $this->Form->value('Category.id')), array('class' => 'btn btn-small btn-danger'), '¿Eliminar categoría?'); ?></li>
		</ul>
	</div>
	
	<?php
		echo $this->Form->create('Category');
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nombre de la categoría'));
	?>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Editar</button>
		<?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn')); ?>
	</div>
	<?php echo $this->Form->end(); ?>
	
</div>
