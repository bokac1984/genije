<div class="plans form">
<?php echo $this->Form->create('Plan'); ?>
	<fieldset>
		<legend><?php echo __('Edit Plan'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('duration');
		echo $this->Form->input('price');
		echo $this->Form->input('news_quantity');
		echo $this->Form->input('events_quantity');
		echo $this->Form->input('products_quantity');
		echo $this->Form->input('location_images_quantity');
		echo $this->Form->input('news_images_quantity');
		echo $this->Form->input('coupon_quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Plan.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Plan.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Plans'), array('action' => 'index')); ?></li>
	</ul>
</div>
