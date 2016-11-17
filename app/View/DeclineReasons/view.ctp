<div class="declineReasons view">
<h2><?php echo __('Decline Reason'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($declineReason['DeclineReason']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($declineReason['DeclineReason']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Decline Reason'), array('action' => 'edit', $declineReason['DeclineReason']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Decline Reason'), array('action' => 'delete', $declineReason['DeclineReason']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $declineReason['DeclineReason']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Decline Reasons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Decline Reason'), array('action' => 'add')); ?> </li>
	</ul>
</div>
