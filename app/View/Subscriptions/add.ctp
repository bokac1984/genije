<div class="subscriptions form">
<?php echo $this->Form->create('Subscription'); ?>
	<fieldset>
		<legend><?php echo __('Add Subscription'); ?></legend>
	<?php
		echo $this->Form->input('additional_data');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('admin_users_id');
		echo $this->Form->input('plans_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Subscriptions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Admin Users'), array('controller' => 'admin_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Users'), array('controller' => 'admin_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plans'), array('controller' => 'plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plans'), array('controller' => 'plans', 'action' => 'add')); ?> </li>
	</ul>
</div>
