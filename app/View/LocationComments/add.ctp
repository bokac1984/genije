<div class="mapObjectsComments form">
<?php echo $this->Form->create('MapObjectsComment'); ?>
	<fieldset>
		<legend><?php echo __('Add Map Objects Comment'); ?></legend>
	<?php
		echo $this->Form->input('text');
		echo $this->Form->input('rating');
		echo $this->Form->input('datetime');
		echo $this->Form->input('comment_rating');
		echo $this->Form->input('fk_id_map_objects');
		echo $this->Form->input('fk_id_users');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Map Objects Comments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Application Users'), array('controller' => 'application_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application User'), array('controller' => 'application_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
