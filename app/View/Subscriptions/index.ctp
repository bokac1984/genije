<div class="subscriptions index">
	<h2><?php echo __('Subscriptions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('additional_data'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('admin_users_id'); ?></th>
			<th><?php echo $this->Paginator->sort('plans_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($subscriptions as $subscription): ?>
	<tr>
		<td><?php echo h($subscription['Subscription']['id']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['additional_data']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['end_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subscription['AdminUsers']['first_name'], array('controller' => 'admin_users', 'action' => 'view', $subscription['AdminUsers']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($subscription['Plans']['name'], array('controller' => 'plans', 'action' => 'view', $subscription['Plans']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $subscription['Subscription']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $subscription['Subscription']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $subscription['Subscription']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $subscription['Subscription']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Subscription'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Admin Users'), array('controller' => 'admin_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Users'), array('controller' => 'admin_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plans'), array('controller' => 'plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plans'), array('controller' => 'plans', 'action' => 'add')); ?> </li>
	</ul>
</div>
