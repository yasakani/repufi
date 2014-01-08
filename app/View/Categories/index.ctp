<div id="categories-index">
	
	<div class="row">
		
		<div class="span6">
			<h2>Categorías</h2>
		</div>
		
		<div class="span6 text-right">
			<?php echo $this->Html->link('Agregar categoría', array('action' => 'add'), array('class' => 'btn btn-small btn-primary')); ?>
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
	
	<table class="table">
		
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
				<th><?php echo $this->Paginator->sort('name', 'Nombre de categoría'); ?></th>
				<th>Acciones</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($categories as $category): ?>
			<tr>
				<td><?php echo h($category['Category']['id']); ?></td>
				<td><?php echo $this->Html->link(h($category['Category']['name']), array('action' => 'view', $category['Category']['id'])); ?></td>
				<td>
					<?php echo $this->Html->link('Editar', array('action' => 'edit', $category['Category']['id']), array('class' => 'btn btn-small btn-info')); ?>
					<?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $category['Category']['id']), array('class' => 'btn btn-small btn-danger'), "¿Eliminar categoría?"); ?>
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
	
</div>
