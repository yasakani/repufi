<div id="forms-view">
    
    <div class="row">
        <div class="span6">
            <h2>
                Detalles del registro
            </h2>
        </div>
        <div class="span6">
            <div class="actions">
                <ul class="inline">
                    <li><?php echo $this->Html->link('Lista', array('action' => 'index'), array('class' => 'btn btn-small')); ?></li>
                    <li><?php echo $this->Html->link('Cédula', array('action' => 'cedula', 'ext' => 'pdf', $form['Form']['id'], "cedula_registro_{$form['Form']['id']}"), array('class' => 'btn btn-small btn-primary')); ?></li>
                    <li><?php echo $this->Html->link('Etiqueta', array('action' => 'etiqueta', 'ext' => 'pdf', $form['Form']['id'], "etiqueta_registro_{$form['Form']['id']}"), array('class' => 'btn btn-small btn-primary')); ?></li>
                    <li><?php echo $this->Html->link('Editar', array('action' => 'edit', $form['Form']['id']), array('class' => 'btn btn-small')); ?></li>
                    <li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $form['Form']['id']), array('class' => 'btn btn-small btn-danger'), '¿Eliminar registro?', $form['Form']['id']); ?></li>
                </ul>
            </div>
        </div>
    </div>
    
    <h3>
        Propietario
    </h3>
    
    <div class="row">
    	
    	<div class="span2">
    		<a href="#" class="thumbnail">
    			<?php echo $this->Html->image($form['Form']['owner_photo']); ?>
    		</a>
    	</div>
                
        <div class="span6">
            
            <ul class="unstyled detail-block">
                <li>
                    Número de folio: <strong><?php echo $form['Form']['id']; ?></strong>
                </li>
                <li>
                    <span class="full-name"><?php echo $form['Form']['full_name']; ?></span> <span class="label"><?php echo $form['Form']['age'] ?> años</span>
                </li>
                <li>
                    Dirección: <strong><?php echo $form['Form']['address']; ?></strong>
                </li>
                <li>
                    Colonia: <strong><?php echo $form['Suburb']['name']; ?></strong>
                </li>
                <li>
                    No. de recibo: <strong><?php echo $form['Form']['receipt_number']; ?></strong>
                    <?php if ( $form['Form']['status'] == 1 ) : ?>
                        <span class="label label-success">Pagado</span>
                    <?php else: ?>
                        <span class="label label-important">Sin pagar</span>
                    <?php endif; ?>
                </li>
            </ul>
            
        </div>
        
        <div class="span4 text-right">
        	<?php echo $this->Html->image($form['Form']['qrcode'], array('alt' => 'QRcode', 'title' => 'QRcode', 'class' => 'img-polaroid')); ?>
        </div>
        
    </div>
    
    <h3>
        Comercio
    </h3>
    
    <div class="row">
        <div class="span8">
            
            <ul class="unstyled detail-block">
                <li>
                    Ubicación del puesto: <strong><?php echo $form['Form']['commerce_location']; ?></strong>
                </li>
                <li>
                    Colonia de ubicación: <strong><?php echo $form['Form']['commerce_suburb']; ?></strong>
                </li>
                <li>
                    Categoría: <strong><?php echo $form['Category']['name']; ?></strong>
                </li>
                <li>
                    Giro: <strong><?php echo $form['Form']['commerce_order']; ?></strong>
                </li>
                <li>
                    Dimensiones:
                    <dl class="dl-horizontal">
                    	<dt>Area</dt>
                    	<dd><?php echo $form['Form']['commerce_square_meters']; ?> m<sup>2</sup></dd>
                    	<dt>Ancho</dt>
                    	<dd><?php echo $form['Form']['commerce_width']; ?> m</dd>
                    	<dt>Largo</dt>
                    	<dd><?php echo $form['Form']['commerce_long']; ?> m</dd>
                    </dl>
                </li>
                <li>
                    Horario:
                    <dl class="dl-horizontal">
                        <?php foreach ( $form['Form']['schedule'] as $day => $details ) : ?>
                        <dt><?php echo $day; ?></dt>
                        <dd>De <strong><?php echo $details['openhour']; ?></strong> hrs. a <strong><?php echo $details['closehour']; ?></strong> hrs.</dd>
                        <?php endforeach; ?>
                    </dl>
                </li>
            </ul>
            
        </div>
    </div>
    
    <h3>
        Documentos
        <?php echo $this->Html->link('Editar documentos', array('action' => 'docs', $form['Form']['id']), array('class' => 'btn btn-info btn-mini')); ?>
    </h3>
    
    <div class="row">
        <div class="span12">
            <ul class="thumbnails">
                <?php foreach ( $form['Documents'] as $index => $data ) : ?>
                    <li class="span2">
                        <div class="thumbnail">
                            <?php echo $this->Html->image( $data['img'] ); ?>
                        </div>
                        <div class="caption">
                            <h4><?php echo $data['caption']; ?></h4>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
</div>