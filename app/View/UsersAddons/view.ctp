<div class="usersAddons view">
<h2><?php echo __('Users Addon'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usersAddon['UsersAddon']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($usersAddon['UsersAddon']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($usersAddon['UsersAddon']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($usersAddon['UsersAddon']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($usersAddon['UsersAddon']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersAddon['AdminUsers']['id'], array('controller' => 'admin_users', 'action' => 'view', $usersAddon['AdminUsers']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Addons'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersAddon['Addons']['name'], array('controller' => 'addons', 'action' => 'view', $usersAddon['Addons']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Users Addon'), array('action' => 'edit', $usersAddon['UsersAddon']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Users Addon'), array('action' => 'delete', $usersAddon['UsersAddon']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersAddon['UsersAddon']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Addons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Addon'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Admin Users'), array('controller' => 'admin_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Users'), array('controller' => 'admin_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Addons'), array('controller' => 'addons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Addons'), array('controller' => 'addons', 'action' => 'add')); ?> </li>
	</ul>
</div>
