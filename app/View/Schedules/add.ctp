<div id="schedules-add">
    
    <h2>
        Agregar horario para establecimientos
    </h2>
    
	<div class="text-right">
		<ul class="inline">
			<li><?php echo $this->Html->link('Lista de horarios', array('action' => 'index'), array('class' => 'btn btn-small')); ?></li>
		</ul>
	</div>
    
    <?php echo $this->Form->create('Schedule'); ?>
    
    <div class="row">
        
        <div class="span12">
                
            <?php echo $this->Form->input('name', array('label' => 'Nombre para horario', 'class' => 'input-xxlarge')); ?>
            
            <div class="row">
                
                <div class="span6">
                    
                    <h4>Lunes a Viernes</h4>
                    
                    <div class="controls-row">
                        <label class="checkbox inline">
                            <input type="checkbox" id="schedule_monday" value="1" name="data[Schedule][data][monday][open]"> Lunes
                        </label>
                        <span>De:</span> 
                        <select name="data[Schedule][data][monday][openhour]" id="schedule_monday_open" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>A:</span> 
                        <select name="data[Schedule][data][monday][closehour]" id="schedule_monday_close" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="controls-row">
                        <label class="checkbox inline">
                            <input type="checkbox" id="schedule_tuesday" value="1" name="data[Schedule][data][tuesday][open]"> Martes
                        </label>
                        <span>De:</span> 
                        <select name="data[Schedule][data][tuesday][openhour]" id="schedule_tuesday_open" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>A:</span> 
                        <select name="data[Schedule][data][tuesday][closehour]" id="schedule_tuesday_close" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="controls-row">
                        <label class="checkbox inline">
                            <input type="checkbox" id="schedule_wednesday" value="1" name="data[Schedule][data][wednesday][open]"> Miércoles
                        </label>
                        <span>De:</span> 
                        <select name="data[Schedule][data][wednesday][openhour]" id="schedule_wednesday_open" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>A:</span> 
                        <select name="data[Schedule][data][wednesday][closehour]" id="schedule_wednesday_close" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="controls-row">
                        <label class="checkbox inline">
                            <input type="checkbox" id="schedule_thursday" value="1" name="data[Schedule][data][thursday][open]"> Jueves
                        </label>
                        <span>De:</span> 
                        <select name="data[Schedule][data][thursday][openhour]" id="schedule_thursday_open" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>A:</span> 
                        <select name="data[Schedule][data][thursday][closehour]" id="schedule_thursday_close" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="controls-row">
                        <label class="checkbox inline">
                            <input type="checkbox" id="schedule_friday" value="1" name="data[Schedule][data][friday][open]"> Viernes
                        </label>
                        <span>De:</span> 
                        <select name="data[Schedule][data][friday][openhour]" id="schedule_friday_open" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>A:</span> 
                        <select name="data[Schedule][data][friday][closehour]" id="schedule_friday_close" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                </div>
                
                <div class="span6">
                    
                    <h4>Fin de semana</h4>
                    
                    <div class="controls-row">
                        <label class="checkbox inline">
                            <input type="checkbox" id="schedule_saturday" value="1" name="data[Schedule][data][saturday][open]"> Sábado
                        </label>
                        <span>De:</span> 
                        <select name="data[Schedule][data][saturday][openhour]" id="schedule_saturday_open" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>A:</span>
                        <select name="data[Schedule][data][saturday][closehour]" id="schedule_saturday_close" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="controls-row">
                        <label class="checkbox inline">
                            <input type="checkbox" id="schedule_sunday" value="1" name="data[Schedule][data][sunday][open]"> Domingo
                        </label>
                        <span>De:</span> 
                        <select name="data[Schedule][data][sunday][openhour]" id="schedule_sunday_open" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>A:</span> 
                        <select name="data[Schedule][data][sunday][closehour]" id="schedule_sunday_close" class="input-small">
                            <?php foreach($hours_a_day as $hour_a_day) : ?>
                            <option value="<?php echo $hour_a_day; ?>"><?php echo $hour_a_day; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                                            
                </div>
            
        </div>
        
    </div>
        
    </div>
    
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn')); ?>
    </div>
    
    <?php echo $this->Form->end(); ?>
    
</div>