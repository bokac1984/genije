<div class="usersAddons form">
<?php echo $this->Form->create('UsersAddon'); ?>
	<fieldset>
		<legend><?php echo __('Add Users Addon'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Users Addons'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Admin Users'), array('controller' => 'admin_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Users'), array('controller' => 'admin_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Addons'), array('controller' => 'addons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Addons'), array('controller' => 'addons', 'action' => 'add')); ?> </li>
	</ul>
</div>
