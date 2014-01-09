<div id="schedule-add-form-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<?php echo $this->Form->create('Schedule', array('id' => 'ScheduleAddFormModal', 'url' => array('controller' => 'schedules', 'action' => 'add'))); ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3>Agregar horario</h3>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->input('name', array('label' => 'Nombre para horario')); ?>
		<?php
			foreach (Configure::read('week') as $index => $day) :
				$id = "schedule_{$day['key']}";
				$name_open = "data[Schedule][data][{$day['key']}][open]";
				$id_openhour = "schedule_{$day['key']}_open";
				$name_openhour = "data[Schedule][data][{$day['key']}][openhour]";
				$id_closehour = "schedule_{$day['key']}_close";
				$name_closehour = "data[Schedule][data][{$day['key']}][closehour]";
		?>
        <div class="controls-row">
            <label class="checkbox inline">
                <input type="checkbox" id="<?php echo $id; ?>" value="1" name="<?php echo $name_open; ?>"> <?php echo $day['label'] ?>
            </label>
            <span>De:</span> 
            <select name="<?php echo $name_openhour; ?>" id="<?php echo $id_openhour; ?>" class="input-small">
                <?php foreach($hours_day as $hour) : ?>
                <option value="<?php echo $hour; ?>"><?php echo $hour; ?></option>
                <?php endforeach; ?>
            </select>
            <span>A:</span> 
            <select name="<?php echo $name_closehour; ?>" id="<?php echo $id_closehour; ?>" class="input-small">
                <?php foreach($hours_day as $hour) : ?>
                <option value="<?php echo $hour; ?>"><?php echo $hour; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endforeach; ?>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		<button type="submit" class="btn btn-primary">Agregar</button>
	</div>
	<?php echo $this->Form->end(); ?>
</div>