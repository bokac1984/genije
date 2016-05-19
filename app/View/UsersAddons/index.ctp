<div class="usersAddons index">
	<h2><?php echo __('Users Addons'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('admin_users_id'); ?></th>
			<th><?php echo $this->Paginator->sort('addons_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($usersAddons as $usersAddon): ?>
	<tr>
		<td><?php echo h($usersAddon['UsersAddon']['id']); ?>&nbsp;</td>
		<td><?php echo h($usersAddon['UsersAddon']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($usersAddon['UsersAddon']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($usersAddon['UsersAddon']['created']); ?>&nbsp;</td>
		<td><?php echo h($usersAddon['UsersAddon']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usersAddon['AdminUsers']['id'], array('controller' => 'admin_users', 'action' => 'view', $usersAddon['AdminUsers']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($usersAddon['Addons']['name'], array('controller' => 'addons', 'action' => 'view', $usersAddon['Addons']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $usersAddon['UsersAddon']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $usersAddon['UsersAddon']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $usersAddon['UsersAddon']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersAddon['UsersAddon']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Users Addon'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Admin Users'), array('controller' => 'admin_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Users'), array('controller' => 'admin_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Addons'), array('controller' => 'addons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Addons'), array('controller' => 'addons', 'action' => 'add')); ?> </li>
	</ul>
</div>
