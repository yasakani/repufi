<div class="schedule-presets-index">
    
    <h2>Horarios para comercios</h2>
    
    <?php if ( empty( $schedules ) ) : ?>
    
    <h4>
        No existen registros de horarios para comercios.
    </h4>
    
    <?php echo $this->Html->link('Agregar horario', array('controller' => 'schedules', 'action' => 'add'), array('class' => 'btn ')); ?>
    
    <?php else : ?>
    
    <table class="table">
        
        <thead>
            <tr>
                <th>Orden</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?php echo $schedule['Schedule']['sequence']; ?></td>
                <td><?php echo $schedule['Schedule']['name']; ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Ver'), array('action' => 'view', $schedule['Schedule']['id']), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $schedule['Schedule']['id']), array('class' => 'btn btn-small')); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
    
    <?php endif; ?>
    
</div>
