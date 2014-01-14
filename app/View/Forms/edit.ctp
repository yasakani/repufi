<div id="forms-edit">
	
	<h2>Editar datos de registro</h2>
	
	<div class="row">
		<div class="span6">
			<h4>Datos de registro con folio: <?php echo $this->request->data['Form']['id']; ?></h4>
		</div>
		<div class="span6 text-right">
			<ul class="inline">
				<li><?php echo $this->Html->link('Lista de registros', array('action' => 'index'), array('class' => 'btn btn-small')); ?></li>
				<li><?php echo $this->Html->link('Detalle del registro', array('action' => 'view', $this->request->data['Form']['id']), array('class' => 'btn btn-small')); ?></li>
				<li><?php echo $this->Html->link('Editar documentos', array('action' => 'docs', $this->request->data['Form']['id']), array('class' => 'btn btn-small btn-info')); ?></li>
				<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $this->Form->value('Form.id')), array('class' => 'btn btn-small btn-danger'), __('¿Eliminar registro #%s?', $this->Form->value('Form.id'))); ?></li>
			</ul>
		</div>
	</div>
	
	<?php echo $this->Form->create('Form', array('type' => 'file')); ?>
	
	<div class="row">
		
		<div class="span6">
			
			<h3>Datos del propietario</h3>
			
	        <div class="row">
	            <div class="span2">
	                <?php echo $this->Form->input('name', array('label' => 'Nombre(s)', 'class' => 'input-medium')); ?>
	            </div>
	            <div class="span2">
	                <?php echo $this->Form->input('lastname_pater', array('label' => 'Apellido Paterno', 'class' => 'input-medium')); ?>
	            </div>
	            <div class="span2">
	                <?php echo $this->Form->input('lastname_mater', array('label' => 'Apellido Materno', 'class' => 'input-medium')); ?>
	            </div>
	        </div>
			
			<div class="row">
                <div class="span6">
                    <label style="cursor:default;">Fecha de nacimiento (Dia, Mes, Año)</label>
                    <?php echo $this->Form->day('birthday', array('class' => 'input-small', 'empty' => false)); ?>
                    <?php echo $this->Form->month('birthday', array('class' => 'input-medium', 'empty' => false, 'monthNames' => $months_spanish)); ?>
                    <?php echo $this->Form->year('birthday', 1920, null, array('class' => 'input-small', 'empty' => false)); ?>
                </div>
			</div>
			
            <div class="row">
                <div class="span3">
                    <?php echo $this->Form->input('address', array('label' => 'Domicilio', 'class' => 'span3')); ?>
                </div>
                <div class="span3">
                    <?php echo $this->Form->input('suburb_id', array('label' => 'Colonia', 'class' => 'span3')); ?>
                </div>
            </div>
			
            <div class="row">
                <div class="span3">
                    <?php echo $this->Form->input('receipt_number', array('label' => 'Número de Recibo de Pago')); ?>
                </div>
                <div class="span3">
                    <?php echo $this->Form->label('owner_photo', 'Selecciona fotografía del propietario'); ?>
                    <input type="text" class="input-medium" id="upload-file" placeholder="Fotografía" disabled="disabled" />
                    <div class="file-upload btn">
                        <span>Selecciona</span>
                        <?php echo $this->Form->file('owner_photo', array('class' => 'upload')); ?>
                    </div>
                </div>
            </div>
			
		</div>
		
		<div class="span6">
			
			<h3>Datos del puesto</h3>
			
	        <div class="row">
	            
	            <div class="span3">
	                <?php echo $this->Form->input('commerce_location', array('label' => 'Lugar de ubicación', 'class' => 'span3')); ?>
	            </div>
                <div class="span3">
                	<?php echo $this->Form->input('commerce_suburb_id', array('label' => 'Colonia', 'options' => $suburbs)); ?>
                </div>
	            <div class="span3">
	                <label style="cursor:default;">Dimensiones del establecimiento</label>
	                <?php echo $this->Form->input('commerce_width', array('label' => false, 'div' => false, 'class' => 'input-small', 'placeholder' => 'Ancho')); ?>
	                <?php echo $this->Form->input('commerce_long', array('label' => false, 'div' => false, 'class' => 'input-small', 'placeholder' => 'Largo')); ?>
	            </div>
	            
	        </div>
	        
	        <div class="row">
	            <div class="span3">
	                <?php echo $this->Form->input('commerce_order', array('label' => 'Giro del puesto', 'class' => 'span3')); ?>
	            </div>
	            <div class="span3">
	                <?php echo $this->Form->input('category_id', array('label' => 'Categoría', 'class' => 'span3')); ?>
	            </div>
	        </div>
	        
	        <div class="row">
	            <div class="span3">
	                <?php echo $this->Form->input('schedule_id', array('label' => 'Horario', 'class' => 'span3')); ?>
	            </div>
	            <div class="span3">
	                <?php echo $this->Form->input('folio', array('label' => 'Número de Folio', 'class' => 'span3')); ?>
	            </div>
	        </div>
			
		</div>
		
	</div>
	
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary">Guardar</button>
	    <?php echo $this->Html->link('Cancelar', array('action' => 'view', $this->request->data['Form']['id']), array('class' => 'btn')); ?>
	</div>
	
	<?php echo $this->Form->end(); ?>
	
</div>
