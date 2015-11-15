<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Edit Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('img_name');
		echo $this->Form->input('label');
		echo $this->Form->input('price');
		echo $this->Form->input('date');
		echo $this->Form->input('online_status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Product.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Product.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Product Features'), array('controller' => 'product_features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Feature'), array('controller' => 'product_features', 'action' => 'add')); ?> </li>
	</ul>
</div>
