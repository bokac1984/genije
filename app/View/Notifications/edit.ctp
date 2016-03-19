<div class="notifications form">
<?php echo $this->Form->create('Notification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('text');
		echo $this->Form->input('img_url');
		echo $this->Form->input('date');
		echo $this->Form->input('fk_id_users');
		echo $this->Form->input('type');
		echo $this->Form->input('type_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Notification.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Notification.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Application Users'), array('controller' => 'application_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application User'), array('controller' => 'application_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
