<div id="forms-add-form">
    
    <h2>
        Formulario de captura
    </h2>
    
    <?php echo $this->Form->create('Form', array('type' => 'file')); ?>
	
	<div class="row">
	    
	    <div class="span6">
	        
	        <fieldset>
	            
	            <legend>Propietario</legend>
	            
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
	                    <label>Fecha de nacimiento (Dia, Mes, Año)</label>
	                    <?php echo $this->Form->day('birthday', array('class' => 'input-small', 'empty' => false, 'value' => date('d'))); ?>
	                    <?php echo $this->Form->month('birthday', array('class' => 'input-medium', 'empty' => false, 'value' => date('M'), 'monthNames' => $months_spanish)); ?>
	                    <?php echo $this->Form->year('birthday', 1920, null, array('class' => 'input-small', 'empty' => false, 'value' => date('Y'))); ?>
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
	                    <?php echo $this->Form->input('receipt_number', array('label' => 'Número de Recibo de Pago', 'value' => 0)); ?>
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
	            
	        </fieldset>
	        
	    </div>
	    
	    <div class="span6">
	        
	        <fieldset>
	            
	            <legend>Comercio</legend>
	            
	            <div class="row">
	                
	                <div class="span3">
	                    <?php echo $this->Form->input('commerce_location', array('label' => 'Lugar de ubicación', 'class' => 'span3')); ?>
	                </div>
	                <div class="span3">
	                    <label>Dimensiones del establecimiento</label>
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
	                <div class="span6">
	                    <?php echo $this->Form->input('schedule_id', array('label' => 'Horario', 'class' => 'span3')); ?>
	                </div>
	            </div>
	            
            </fieldset>
	        
	    </div>
	    
	</div>
	
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary">Guardar</button>
	</div>
	
	<?php echo $this->Form->end(); ?>
	
</div>
