<div id="categories-view">
	
	<h2>Detalles de la categoría</h2>
	
	<div class="text-right">
		<ul class="inline">
			<li><?php echo $this->Html->link('Lista de categorías', array('action' => 'index'), array('class' => 'btn btn-small')); ?> </li>
			<li><?php echo $this->Html->link('Agregar categoría', array('action' => 'add'), array('class' => 'btn btn-small btn-primary')); ?> </li>
			<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $category['Category']['id']), array('class' => 'btn btn-small btn-info')); ?> </li>
			<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $category['Category']['id']), array('class' => 'btn btn-small btn-danger'), '¿Eliminar categoría?'); ?></li>
		</ul>
	</div>
	
	<dl class="dl-horizontal">
		<dt>ID</dt>
		<dd>
			<h4><?php echo h($category['Category']['id']); ?></h4>
		</dd>
		<dt>Nombre</dt>
		<dd>
			<h4><?php echo h($category['Category']['name']); ?></h4>
		</dd>
		<dt>Fecha de creación</dt>
		<dd>
			<h4><?php echo h($category['Category']['created']); ?></h4>
		</dd>
		<dt>Fecha de modificación</dt>
		<dd>
			<h4><?php echo h($category['Category']['modified']); ?></h4>
		</dd>
	</dl>
	
	<h3>
		Registros asociados a esta categoría
	</h3>
	
	<?php if (!empty($category['Form'])): ?>
	<table class="table">
		
		<thead>
			<tr>
				<th>Folio</th>
				<th>Nombre del propietario</th>
				<th>Ubicación</th>
				<th>Superficie</th>
				<th>Estatus</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($category['Form'] as $form): ?>
			<tr>
				<td><?php echo $form['id']; ?></td>
				<td><?php echo $this->Html->link($form['full_name'], array('controller' => 'forms', 'action' => 'view', $form['id'])); ?></td>
				<td><?php echo $form['commerce_location']; ?></td>
				<td><?php echo round($form['commerce_square_meters'], 2); ?>m<sup>2</sup></td>
				<td>
	            	<?php if ( $form['status'] == '0' ) : ?>
	            	<span class="label label-important">No pagado</span>
	            	<?php else: ?>
	            	<span class="label label-success">Pagado</span>
	            	<?php endif; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		
	</table>
	<?php else: ?>
		<h5>No existen registros asociados a esta categoría.</h5>
	<?php endif; ?>
	
</div>