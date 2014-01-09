<div class="schedules-index">
    
	<div class="row">
		
		<div class="span6">
			<h2>Horarios</h2>
		</div>
		
		<div class="span6 text-right">
			<?php echo $this->Html->link('Agregar horario', array('action' => 'add'), array('class' => 'btn btn-small btn-primary')); ?>
		</div>
		
	</div>
    
	<p>
		<?php echo $this->Paginator->counter(array('format' => __('Pagina {:page} de {:pages}, mostrando {:current} registros de {:count} totales, primer registro {:start}, ultimo {:end}.'))); ?>
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
    
    <?php if ( empty( $schedules ) ) : ?>
    
    <h4>
        No existen registros de horarios.
    </h4>
    
    <?php else : ?>
    
    <table class="table">
        
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?php echo $this->Paginator->sort('name', 'Horario'); ?></th>
                <th>Acciones</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?php echo $schedule['Schedule']['id']; ?></td>
                <td><?php echo $this->Html->link($schedule['Schedule']['name'], array('action' => 'view', $schedule['Schedule']['id'])); ?></td>
                <td class="actions">
                    <?php echo $this->Html->link('Editar', array('action' => 'edit', $schedule['Schedule']['id']), array('class' => 'btn btn-small btn-info')); ?>
                    <?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $schedule['Schedule']['id']), array('class' => 'btn btn-small btn-danger'), "¿Eliminar horario?"); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
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
    
    <?php endif; ?>
    
</div>
