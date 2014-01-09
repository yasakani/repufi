<div id="schedule-preset-view">
    
    <h2>
        Detalles de horario
    </h2>
    
	<div class="text-right">
		<ul class="inline">
			<li><?php echo $this->Html->link('Lista de horarios', array('action' => 'index'), array('class' => 'btn btn-small')); ?> </li>
			<li><?php echo $this->Html->link('Agregar horario', array('action' => 'add'), array('class' => 'btn btn-small btn-primary')); ?> </li>
			<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $schedule['Schedule']['id']), array('class' => 'btn btn-small btn-info')); ?> </li>
			<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $schedule['Schedule']['id']), array('class' => 'btn btn-small btn-danger'), '¿Eliminar horario?'); ?></li>
		</ul>
	</div>
    
    <div class="row">
    	<div class="span6">
		    <table class="table table-bordered table-striped table-condensed">
		    	<tbody>
		    		<tr>
		    			<td>ID</td>
		    			<td><strong><?php echo h($schedule['Schedule']['id']); ?></strong></td>
		    		</tr>
		    		<tr>
		    			<td>Nombre</td>
		    			<td><strong><?php echo h($schedule['Schedule']['name']); ?></strong></td>
		    		</tr>
		    		<tr>
		    			<td>Fecha de creación</td>
		    			<td><strong><?php echo $this->Time->format('j F Y @ h:i A', $schedule['Schedule']['created']); ?></strong></td>
		    		</tr>
		    		<tr>
		    			<td>Creado por</td>
		    			<td><strong><?php echo $schedule['Schedule']['created_by']; ?></strong></td>
		    		</tr>
		    		<tr>
		    			<td>Fecha de modificación</td>
		    			<td><strong><?php echo $this->Time->format('j F Y @ h:i A', $schedule['Schedule']['modified']); ?></strong></td>
		    		</tr>
		    		<tr>
		    			<td>Modificado por</td>
		    			<td><strong><?php echo $schedule['Schedule']['modified_by']; ?></strong></td>
		    		</tr>
		    		<tr>
		    			<td>Detalle de horario</td>
		    			<td>
				            <dl class="dl-horizontal">
				                <?php foreach ( $schedule['Schedule']['data'] as $day => $details ) : ?>
				                <dt><?php echo $day; ?></dt>
				                <dd>De <strong><?php echo $details['openhour']; ?></strong> hrs. a <strong><?php echo $details['closehour']; ?></strong> hrs.</dd>
				                <?php endforeach; ?>
				            </dl>
		    			</td>
		    		</tr>
		    	</tbody>
		    </table>
    	</div>
    </div>
    
    <h3>
    	Registros asociados a este horario
    </h3>
    
    <?php if ( !empty($schedule['Form']) ) : ?>
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
			<?php foreach ($schedule['Form'] as $form): ?>
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
    <h5>No existen registros asociados a este horario.</h5>
    <?php endif; ?>
    
</div>
