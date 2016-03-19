<div class="mapObjectsUsers form">
<?php echo $this->Form->create('MapObjectsUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Map Objects User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('full_name');
		echo $this->Form->input('fk_id_map_objects');
		echo $this->Form->input('creation_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MapObjectsUser.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('MapObjectsUser.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Map Objects Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
