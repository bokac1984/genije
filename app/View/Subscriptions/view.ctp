<div class="subscriptions view">
<h2><?php echo __('Subscription'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Additional Data'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['additional_data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subscription['AdminUsers']['id'], array('controller' => 'admin_users', 'action' => 'view', $subscription['AdminUsers']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plans'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subscription['Plans']['name'], array('controller' => 'plans', 'action' => 'view', $subscription['Plans']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subscription'), array('action' => 'edit', $subscription['Subscription']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Subscription'), array('action' => 'delete', $subscription['Subscription']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $subscription['Subscription']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriptions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscription'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Admin Users'), array('controller' => 'admin_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Users'), array('controller' => 'admin_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plans'), array('controller' => 'plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plans'), array('controller' => 'plans', 'action' => 'add')); ?> </li>
	</ul>
</div>
