<div class="categories view">
<h2><?php  echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($category['Category']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($category['Category']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($category['Category']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Forms'); ?></h3>
	<?php if (!empty($category['Form'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Lastname Pater'); ?></th>
		<th><?php echo __('Lastname Mater'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Suburb Id'); ?></th>
		<th><?php echo __('Age'); ?></th>
		<th><?php echo __('Receipt Number'); ?></th>
		<th><?php echo __('Commerce Location'); ?></th>
		<th><?php echo __('Commece Latitude'); ?></th>
		<th><?php echo __('Commerce Longitude'); ?></th>
		<th><?php echo __('Commerce Order'); ?></th>
		<th><?php echo __('Commerce Width'); ?></th>
		<th><?php echo __('Commerce Long'); ?></th>
		<th><?php echo __('Commerce Squedule'); ?></th>
		<th><?php echo __('Squedule Preset Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Modified By'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['Form'] as $form): ?>
		<tr>
			<td><?php echo $form['id']; ?></td>
			<td><?php echo $form['user_id']; ?></td>
			<td><?php echo $form['name']; ?></td>
			<td><?php echo $form['lastname_pater']; ?></td>
			<td><?php echo $form['lastname_mater']; ?></td>
			<td><?php echo $form['address']; ?></td>
			<td><?php echo $form['suburb_id']; ?></td>
			<td><?php echo $form['age']; ?></td>
			<td><?php echo $form['receipt_number']; ?></td>
			<td><?php echo $form['commerce_location']; ?></td>
			<td><?php echo $form['commece_latitude']; ?></td>
			<td><?php echo $form['commerce_longitude']; ?></td>
			<td><?php echo $form['commerce_order']; ?></td>
			<td><?php echo $form['commerce_width']; ?></td>
			<td><?php echo $form['commerce_long']; ?></td>
			<td><?php echo $form['commerce_squedule']; ?></td>
			<td><?php echo $form['squedule_preset_id']; ?></td>
			<td><?php echo $form['status']; ?></td>
			<td><?php echo $form['category_id']; ?></td>
			<td><?php echo $form['modified']; ?></td>
			<td><?php echo $form['created']; ?></td>
			<td><?php echo $form['created_by']; ?></td>
			<td><?php echo $form['modified_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forms', 'action' => 'view', $form['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forms', 'action' => 'edit', $form['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forms', 'action' => 'delete', $form['id']), null, __('Are you sure you want to delete # %s?', $form['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
