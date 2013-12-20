<div id="forms-docs">
    
    <h3>
    	Administración de documentos
    </h3>
    
    <div class="row">
        
        <div class="span12">
	        
	        <div class="row">
	        	
	        	<div class="span6">
			        <h4>
			            Documentos del puesto con folio: <strong><?php echo $form_id; ?></strong>
			        </h4>
	        	</div>
	        	
				<div class="span6 text-right">
					<ul class="unstyled inline">
						<li><?php echo $this->Html->link('Detalles del registro', array('action' => 'view', $form_id), array('class' => 'btn btn-small btn-info')); ?></li>
					</ul>
				</div>
	        	
	        	
	        </div>
	        
	        <table class="table table-hover">
	        	<thead>
	        		<tr>
	        			<th>Detalle</th>
	        			<th>Documento</th>
	        			<th>Fecha de carga en sistema</th>
	        			<th>Cambiar</th>
	        			<th>Eliminar</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<?php foreach ( $documents as $index => $data ) : ?>
	        		<tr>
						<td>
							<?php
								if ( !$data['exists'] ) :
									echo $this->Html->image($data['img'], array('class' => 'img-polaroid', 'alt' => $data['caption']));
								else :
									echo $this->Html->link($this->Html->image($data['img'], array('alt' => $data['caption'])), '/' . IMAGES_URL . $data['img'], array('escape' => false, 'class' => 'thumbnail'));
								endif;
							?>
						</td>
						<td><?php echo $data['caption']; ?></td>
						<td><?php echo $data['date']; ?></td>
						<td>
							<?php
								echo $this->Form->create(null, array('action' => 'replace_document', 'type' => 'file', 'id' => "replace_" . $data['type'], 'class' => 'form-inline'));
								echo $this->Form->hidden('type', array('id' => false, 'value' => $data['type']));
								echo $this->Form->hidden('form_id', array('id' => false, 'value' => $form_id));
							?>
							<div class="file-upload btn btn-small">
								<span>Selecciona</span>
								<?php echo $this->Form->file('file', array('class' => 'upload', 'id' => false)); ?>
							</div>
							<input type="text" placeholder="documento" disabled="disabled" class="input-small upload-file" />
							<button type="submit" class="btn btn-primary btn-small">Cambiar</button>
							<?php echo $this->Form->end(); ?>
						</td>
						<td>
							<?php if ( !$data['exists'] ) : ?>
							<button type="button" class="btn btn-small btn-danger disabled">Eliminar</button>
							<?php else: ?>
							<?php echo $this->Form->postLink('Eliminar', array('action' => 'delete_document', $data['type'], $form_id), array('class' => 'btn btn-danger btn-small'), '¿Eliminar documento?'); ?>
							<?php endif; ?>
						</td>
		        	</tr>
		        	<?php endforeach; ?>
	        	</tbody>
	        </table>
	        
		</div>
		
	</div>
	
</div>