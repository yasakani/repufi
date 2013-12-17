<div id="schedule-preset-view">
    
    <h2>
        Detalles de horario
    </h2>
    
    <div class="row">
        <div class="span6 schedule-detail">
            
            <dl class="dl-horizontal">
                <dt>Nombre</dt>
                <dd><?php echo $schedule['Schedule']['name']; ?></dd>
                <dt>Orden en lista</dt>
                <dd><?php echo $schedule['Schedule']['sequence']; ?></dd>
                <dt>Creado por</dt>
                <dd><?php echo $schedule['Schedule']['created_by']; ?></dd>
                <dt>Fecha de creación</dt>
                <dd><?php echo $this->Time->format('j F Y @ h:i A', $schedule['Schedule']['created']); ?></dd>
                <dt>Horario</dt>
                <dd>0</dd>
                <dd>1</dd>
            </dl>
            
        </div>
    </div>
    
    
</div>
