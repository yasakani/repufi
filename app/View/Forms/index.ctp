<div class="forms index">
    
	<h2>Registros</h2>
	
    <p>
       <?php echo $this->Paginator->counter(array(
           'format' => __('Pagina {:page} de {:pages}, mostrando {:current} registros de {:count} totales, primer registro: {:start}, ultimo {:end}.')
        ));?>
    </p>
	
	<div class="pagination">
	    <ul>
        <?php
            echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), null, array('escape' => false, 'class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('tag' => 'li','separator' => '', 'currentClass' => 'active', 'currentTag' => 'a'));
            echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('escape' => false, 'class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
        ?>
        </ul>
	</div>
	
	<table class="table table-striped table-bordered table-hover">
	   
	   <tr>
	       <th><?php echo $this->Paginator->sort('id', 'Registro'); ?></th>
	       <th><?php echo $this->Paginator->sort('folio', 'Folio'); ?></th>
            <th><?php echo $this->Paginator->sort('full_name', 'Nombre del propietario'); ?></th>
            <th><?php echo $this->Paginator->sort('commerce_location', 'Ubicación'); ?></th>
            <th><?php echo $this->Paginator->sort('commerce_square_meters', 'Superficie'); ?></th>
            <th><?php echo $this->Paginator->sort('receipt_number', 'Estatus'); ?></th>
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
    
    <div class="pagination">
        <ul>
        <?php
            echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), null, array('escape' => false, 'class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('tag' => 'li','separator' => '', 'currentClass' => 'active', 'currentTag' => 'a'));
            echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('escape' => false, 'class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
        ?>
        </ul>
    </div>
    
</div>
