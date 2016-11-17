<div class="plans form">
<?php echo $this->Form->create('Plan'); ?>
	<fieldset>
		<legend><?php echo __('Add Plan'); ?></legend>
	<?php
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
