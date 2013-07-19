<div class="forms view">
<h2><?php  echo __('Form'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($form['Form']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($form['Form']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname Pater'); ?></dt>
		<dd>
			<?php echo h($form['Form']['lastname_pater']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname Mater'); ?></dt>
		<dd>
			<?php echo h($form['Form']['lastname_mater']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($form['Form']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Suburb Id'); ?></dt>
		<dd>
			<?php echo h($form['Form']['suburb_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Age'); ?></dt>
		<dd>
			<?php echo h($form['Form']['age']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receipt Id'); ?></dt>
		<dd>
			<?php echo h($form['Form']['receipt_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($form['Form']['photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commerce Location'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commerce_location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commece Latitude'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commece_latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commerce Longitude'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commerce_longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($form['Form']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commerce Width'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commerce_width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commerce Long'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commerce_long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commerce Square Meters'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commerce_square_meters']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commerce Squedule Open'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commerce_squedule_open']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commerce Squedule Close'); ?></dt>
		<dd>
			<?php echo h($form['Form']['commerce_squedule_close']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Receipt'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_receipt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Commerce Photo'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_commerce_photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Rights'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_rights']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan User Photo'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_user_photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Address'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Sanity'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_sanity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Ife'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_ife']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Repecos'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_repecos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scan Ambient'); ?></dt>
		<dd>
			<?php echo h($form['Form']['scan_ambient']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Form'), array('action' => 'edit', $form['Form']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Form'), array('action' => 'delete', $form['Form']['id']), null, __('Are you sure you want to delete # %s?', $form['Form']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('action' => 'add')); ?> </li>
	</ul>
</div>
