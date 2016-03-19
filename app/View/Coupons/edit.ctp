<div class="eventsTickets form">
<?php echo $this->Form->create('EventsTicket'); ?>
	<fieldset>
		<legend><?php echo __('Edit Events Ticket'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('value');
		echo $this->Form->input('fk_id_events');
		echo $this->Form->input('fk_id_users');
		echo $this->Form->input('creation_date');
		echo $this->Form->input('code_status');
		echo $this->Form->input('fk_id_map_objects_users');
		echo $this->Form->input('checked_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EventsTicket.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('EventsTicket.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Events Tickets'), array('action' => 'index')); ?></li>
	</ul>
</div>
