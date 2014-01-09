<?php header('Content-type: text/html'); ?>
<?php foreach ($schedules as $schedule) : ?>
<option value="<?php echo $schedule['Schedule']['id']; ?>"><?php echo $schedule['Schedule']['name']; ?></option>
<?php endforeach; ?>