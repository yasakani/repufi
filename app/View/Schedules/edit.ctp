<div id="schedule-presets-add">
    
    <h2>
        Editar datos de  horario para establecimientos
    </h2>
    
    <?php echo $this->Form->create('Schedule'); ?>
    
    <div class="row">
        
        <div class="span12">
            
            <fieldset>
                
                <legend>Datos para horario</legend>
                
                <?php echo $this->Form->input('name', array('label' => 'Nombre para horario', 'class' => 'input-xxlarge')); ?>
                
                <div class="row">
                    
                    <div class="span6">
                        
                        <h4>Lunes a Viernes</h4>
                        
                        <div class="controls-row">
                            <label class="checkbox inline">
                                <?php $checked = ( isset( $schedule['Schedule']['data']['monday']['open'] ) ) ? 'checked="checked"' : ''; ?>
                                <input type="checkbox" id="schedule_monday" value="1" name="data[Schedule][data][monday][open]" <?php echo $checked; ?>> Lunes
                            </label>
                            <span>De:</span> 
                            <select name="data[Schedule][data][monday][openhour]" id="schedule_monday_open" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php echo $selected = ( $schedule['Schedule']['data']['monday']['openhour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span>A:</span> 
                            <select name="data[Schedule][data][monday][closehour]" id="schedule_monday_close" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['monday']['closehour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="controls-row">
                            <label class="checkbox inline">
                                <?php $checked = ( isset( $schedule['Schedule']['data']['tuesday']['open'] ) ) ? 'checked="checked"' : ''; ?>
                                <input type="checkbox" id="schedule_tuesday" value="1" name="data[Schedule][data][tuesday][open]" <?php echo $checked; ?>> Martes
                            </label>
                            <span>De:</span> 
                            <select name="data[Schedule][data][tuesday][openhour]" id="schedule_tuesday_open" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['tuesday']['openhour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span>A:</span> 
                            <select name="data[Schedule][data][tuesday][closehour]" id="schedule_tuesday_close" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['tuesday']['closehour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="controls-row">
                            <label class="checkbox inline">
                                <?php $checked = ( isset( $schedule['Schedule']['data']['wednesday']['open'] ) ) ? 'checked="checked"' : ''; ?>
                                <input type="checkbox" id="schedule_wednesday" value="1" name="data[Schedule][data][wednesday][open]" <?php echo $checked; ?>> Miércoles
                            </label>
                            <span>De:</span> 
                            <select name="data[Schedule][data][wednesday][openhour]" id="schedule_wednesday_open" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['wednesday']['openhour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span>A:</span> 
                            <select name="data[Schedule][data][wednesday][closehour]" id="schedule_wednesday_close" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['wednesday']['closehour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="controls-row">
                            <label class="checkbox inline">
                                <?php $checked = ( isset( $schedule['Schedule']['data']['thursday']['open'] ) ) ? 'checked="checked"' : ''; ?>
                                <input type="checkbox" id="schedule_thursday" value="1" name="data[Schedule][data][thursday][open]" <?php echo $checked; ?>> Jueves
                            </label>
                            <span>De:</span> 
                            <select name="data[Schedule][data][thursday][openhour]" id="schedule_thursday_open" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['thursday']['openhour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span>A:</span> 
                            <select name="data[Schedule][data][thursday][closehour]" id="schedule_thursday_close" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['thursday']['closehour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="controls-row">
                            <label class="checkbox inline">
                                <?php $checked = ( isset( $schedule['Schedule']['data']['friday']['open'] ) ) ? 'checked="checked"' : ''; ?>
                                <input type="checkbox" id="schedule_friday" value="1" name="data[Schedule][data][friday][open]" <?php echo $checked; ?>> Viernes
                            </label>
                            <span>De:</span> 
                            <select name="data[Schedule][data][friday][openhour]" id="schedule_friday_open" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['friday']['openhour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span>A:</span> 
                            <select name="data[Schedule][data][friday][closehour]" id="schedule_friday_close" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['friday']['closehour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="span6">
                        
                        <h4>Fin de semana</h4>
                        
                        <div class="controls-row">
                            <label class="checkbox inline">
                                <?php $checked = ( isset( $schedule['Schedule']['data']['saturday']['open'] ) ) ? 'checked="checked"' : ''; ?>
                                <input type="checkbox" id="schedule_saturday" value="1" name="data[Schedule][data][saturday][open]" <?php echo $checked; ?> > Sábado
                            </label>
                            <span>De:</span> 
                            <select name="data[Schedule][data][saturday][openhour]" id="schedule_saturday_open" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['saturday']['openhour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span>A:</span>
                            <select name="data[Schedule][data][saturday][closehour]" id="schedule_saturday_close" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['saturday']['closehour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?>><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="controls-row">
                            <label class="checkbox inline">
                                <?php $checked = ( isset( $schedule['Schedule']['data']['sunday']['open'] ) ) ? 'checked="checked"' : ''; ?>
                                <input type="checkbox" id="schedule_sunday" value="1" name="data[Schedule][data][sunday][open]" <?php echo $checked; ?>> Domingo
                            </label>
                            <span>De:</span> 
                            <select name="data[Schedule][data][sunday][openhour]" id="schedule_sunday_open" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['sunday']['openhour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?> ><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span>A:</span>
                            <select name="data[Schedule][data][sunday][closehour]" id="schedule_sunday_close" class="input-small">
                                <?php foreach($hours_a_day as $hour_a_day) : ?>
                                <?php $selected = ( $schedule['Schedule']['data']['sunday']['closehour'] == $hour_a_day ) ? 'selected="selected"': ''; ?>
                                <option value="<?php echo $hour_a_day; ?>" <?php echo $selected; ?> ><?php echo $hour_a_day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    </div>

            </fieldset>
            
        </div>
        
    </div>
    
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Editar</button>
      <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn')); ?>
    </div>
    
    <?php echo $this->Form->end(); ?>
    
</div>