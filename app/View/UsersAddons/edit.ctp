<div class="usersAddons form">
<?php echo $this->Form->create('UsersAddon'); ?>
	<fieldset>
		<legend><?php echo __('Edit Users Addon'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('admin_users_id');
		echo $this->Form->input('addons_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UsersAddon.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('UsersAddon.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Users Addons'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Admin Users'), array('controller' => 'admin_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Users'), array('controller' => 'admin_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Addons'), array('controller' => 'addons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Addons'), array('controller' => 'addons', 'action' => 'add')); ?> </li>
	</ul>
</div>
