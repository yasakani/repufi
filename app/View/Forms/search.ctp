<div id="form-search">
	
	<h2>Resultado de busqueda</h2>
	
	<h4>Criterio de busqueda: <span style="color:#A9302A;"><?php echo $query; ?></span></h4>
	
	<table class="table table-striped table-bordered table-hover">
	   
	   <tr>
	       <th>Registro</th>
	       <th>Folio</th>
            <th>Nombre del propietario</th>
            <th>Ubicación</th>
            <th>Superficie</th>
            <th>Estatus</th>
        </tr>
        
        <?php foreach ($forms as $form): ?>
        <tr>
            <td>
                <?php echo h($form['Form']['id']); ?>
                <div class="btn-group">
                    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-cog">&nbsp;</i>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li><?php echo $this->Html->link('Editar', array('controller' => 'forms', 'action' => 'edit', $form['Form']['id'])); ?></li>
                        <li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $form['Form']['id']), null, '¿Eliminar registro?'); ?></li>
                    </ul>
                </div>
            </td>
            <td><?php echo $form['Form']['folio']; ?></td>
            <td><?php echo $this->Html->link($form['Form']['full_name'], array('controller' => 'forms', 'action' => 'view', $form['Form']['id'])); ?></td>
            <td><?php echo h($form['Form']['commerce_location']); ?></td>
            <td><?php echo round($form['Form']['commerce_square_meters'], 2); ?>m<sup>2</sup></td>
            <td>
            	<?php if ( $form['Form']['status'] == '0' ) : ?>
            	<span class="label label-important">No pagado</span>
            	<?php else: ?>
            	<span class="label label-success">Pagado</span>
            	<?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        
    </table>
	
	
</div>
