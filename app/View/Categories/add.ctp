<div id="categories-add">

	<h2>
		Agregar categoría
	</h2>
	
	<div class="text-right">
		<ul class="inline">
			<li><?php echo $this->Html->link('Lista de categorías', array('action' => 'index'), array('class' => 'btn btn-small')); ?></li>
		</ul>
	</div>
	
	<?php echo $this->Form->create('Category'); ?>
		<?php echo $this->Form->input('name', array('label' => 'Nombre de la categoría')); ?>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Guradar</button>
			<?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn')); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>