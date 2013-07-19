<div id="forms-add-form">
    
    <h2>
        Formulario de captura
    </h2>
    
    <?php echo $this->Form->create('Form', array('type' => 'file')); ?>
	
	<fieldset>
	    
	    <legend>Datos de usuario</legend>
    	
    	<div class="row">
    	    
            <div class="span4">
                <?php echo $this->Form->input('name', array('label' => 'Nombre(s)')); ?>
            </div>
            
            <div class="span4">
                <?php echo $this->Form->input('lastname_pater', array('label' => 'Apellido Paterno')); ?>
            </div>
            
            <div class="span4">
                <?php echo $this->Form->input('lastname_mater', array('label' => 'Apellido Materno')); ?>
            </div>
            
    	</div>
    	
    	<div class="row">
    	    
    	    <div class="span4">
    	        <?php echo $this->Form->input('address', array('label' => 'Domicilio')); ?>
    	    </div>
    	    
    	    <div class="span4">
    	        <?php echo $this->Form->input('suburb_id', array('label' => 'Colonia')); ?>
    	    </div>
    	    
    	    <div class="span4">
    	        <?php echo $this->Form->input('age', array('label' => 'Edad')); ?>
    	    </div>
    	    
    	</div>
    	
    	<div class="row">
    	    
    	    <div class="span6">
    	        <?php echo $this->Form->input('receipt_number', array('label' => 'No. de Recibo de Pago')); ?>
    	    </div>
    	    
    	    <div class="span6">
    	        <?php echo $this->Form->input('photo', array('label' => 'Fotografía', 'type' => 'file')); ?>
    	    </div>
    	        	    
    	</div>
    	
	</fieldset>
	
	<fieldset>
	    
	    <legend>Datos del negocio</legend>
	    
	    <div class="row">
	        
            <div class="span4">
                <?php echo $this->Form->input('commerce_location', array('label' => 'Lugar de ubicación')); ?>
            </div>
            
            <div class="span4">
                <?php echo $this->Form->input('order', array('label' => 'Giro')); ?>
            </div>
            
            <div class="span4">
                
                <label>Dimensiones</label>
                
                <div class="controls controls-row">
                    <?php echo $this->Form->input('commerce_width', array('label' => false, 'div' => false, 'class' => 'span2', 'placeholder' => 'Ancho')); ?>
                    <?php echo $this->Form->input('commerce_long', array('label' => false, 'div' => false, 'class' => 'span2', 'placeholder' => 'Largo')); ?>
                </div>
            </div>
            
            <?php
                //echo $this->Form->input('commece_latitude');
                //echo $this->Form->input('commerce_longitude');
            ?>
            
	    </div>
	    
	    <div class="row">
	        
	        <div class="span2">
	            <label class="checkbox inline">
                    <input type="checkbox" id="schedule_monday" value="1" name="data[Form][schedules][monday][open]"> Lunes
                </label>
                <label for="schedule_monday_open">De:</label> 
                <select name="data[Form][schedules][monday][openhour]" id="schedule_monday_open" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="schedule_monday_close">A:</label> 
                <select name="data[Form][schedules][monday][closehour]" id="schedule_monday_close" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
	        </div>
	        
            <div class="span2">
                <label class="checkbox inline">
                    <input type="checkbox" id="schedule_tuesday" value="1" name="data[Form][schedules][tuesday][open]"> Martes
                </label>
                <label for="schedule_tuesday_open">De:</label> 
                <select name="data[Form][schedules][tuesday][openhour]" id="schedule_tuesday_open" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="schedule_tuesday_close">A:</label> 
                <select name="data[Form][schedules][tuesday][closehour]" id="schedule_tuesday_close" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
	        
            <div class="span2">
                <label class="checkbox inline">
                    <input type="checkbox" id="schedule_wednesday" value="1" name="data[Form][schedules][wednesday][open]"> Miércoles
                </label>
                <label for="schedule_wednesday_open">De:</label> 
                <select name="data[Form][schedules][wednesday][openhour]" id="schedule_wednesday_open" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="schedule_wednesday_close">A:</label> 
                <select name="data[Form][schedules][wednesday][closehour]" id="schedule_wednesday_close" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="span2">
                <label class="checkbox inline">
                    <input type="checkbox" id="schedule_thursday" value="1" name="data[Form][schedules][thursday][open]"> Jueves
                </label>
                <label for="schedule_thursday_open">De:</label> 
                <select name="data[Form][schedules][thursday][openhour]" id="schedule_thursday_open" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="schedule_thursday_close">A:</label> 
                <select name="data[Form][schedules][thursday][closehour]" id="schedule_thursday_close" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
	        
            <div class="span2">
                <label class="checkbox inline">
                    <input type="checkbox" id="schedule_friday" value="1" name="data[Form][schedules][friday][open]"> Viernes
                </label>
                <label for="schedule_friday_open">De:</label> 
                <select name="data[Form][schedules][friday][openhour]" id="schedule_friday_open" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="schedule_friday_close">A:</label> 
                <select name="data[Form][schedules][friday][closehour]" id="schedule_friday_close" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
	        
	    </div>
	    
        <div class="row">
            
            <div class="span2">
                <label class="checkbox inline">
                    <input type="checkbox" id="schedule_saturday" value="1" name="data[Form][schedules][saturday][open]"> Sábado
                </label>
                <label for="schedule_saturday_open">De:</label> 
                <select name="data[Form][schedules][saturday][openhour]" id="schedule_saturday_open" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="schedule_saturday_close">A:</label> 
                <select name="data[Form][schedules][saturday][closehour]" id="schedule_saturday_close" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="span2">
                <label class="checkbox inline">
                    <input type="checkbox" id="schedule_sunday" value="1" name="data[Form][schedules][sunday][open]"> Domingo
                </label>
                <label for="schedule_sunday_open">De:</label> 
                <select name="data[Form][schedules][sunday][openhour]" id="schedule_sunday_open" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="schedule_sunday_close">A:</label> 
                <select name="data[Form][schedules][sunday][closehour]" id="schedule_sunday_close" class="input-small">
                    <?php foreach($hours_a_day as $hour_a_day) : ?>
                    <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
        </div>
        
	</fieldset>
	
	<fieldset>
	    
	    <legend>Documentación</legend>
	    
	    <?php
	        echo $this->Form->input('scan_receipts2k11', array('label' => 'Recibo de Pago 2011', 'type' => 'file'));
            echo $this->Form->input('scan_receipts2k12', array('label' => 'Recibo de Pago 2012', 'type' => 'file'));
            echo $this->Form->input('scan_properties', array('label' => 'Fotografía reciente del comercio', 'type' => 'file'));
            echo $this->Form->input('scan_rights', array('label' => 'Pago de derechos 2013', 'type' => 'file'));
            echo $this->Form->input('scan_idphotos', array('label' => 'Fotografía tamaño credencial', 'type' => 'file'));
            echo $this->Form->input('scan_address', array('label' => 'Constancia domiciliaria', 'type' => 'file'));
            echo $this->Form->input('scan_sanity', array('label' => 'Tarjeta sanitaria', 'type' => 'file'));
            echo $this->Form->input('scan_ife', array('label' => 'IFE', 'type' => 'file'));
            echo $this->Form->input('scan_repecos', array('label' => 'Cédula de Identificación Fiscal', 'type' => 'file'));
            echo $this->Form->input('scan_ambient', array('label' => 'Dictamen Favorable', 'type' => 'file'));
	    ?>
	    
	</fieldset>
	
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary">Guardar</button>
	</div>
	
	<?php echo $this->Form->end(); ?>
	
</div>

Motorola MB860

