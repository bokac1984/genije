<div class="declineReasons form">
<?php echo $this->Form->create('DeclineReason'); ?>
	<fieldset>
		<legend><?php echo __('Add Decline Reason'); ?></legend>
	<?php
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Decline Reasons'), array('action' => 'index')); ?></li>
	</ul>
</div>
