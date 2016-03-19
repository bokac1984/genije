<div class="eventsTickets view">
<h2><?php echo __('Events Ticket'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fk Id Events'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['fk_id_events']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fk Id Users'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['fk_id_users']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creation Date'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['creation_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code Status'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['code_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fk Id Map Objects Users'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['fk_id_map_objects_users']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checked Date'); ?></dt>
		<dd>
			<?php echo h($eventsTicket['EventsTicket']['checked_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Events Ticket'), array('action' => 'edit', $eventsTicket['EventsTicket']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Events Ticket'), array('action' => 'delete', $eventsTicket['EventsTicket']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $eventsTicket['EventsTicket']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Events Tickets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Events Ticket'), array('action' => 'add')); ?> </li>
	</ul>
</div>
