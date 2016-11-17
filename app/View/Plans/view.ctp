<div class="plans view">
<h2><?php echo __('Plan'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['duration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('News Quantity'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['news_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Events Quantity'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['events_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Products Quantity'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['products_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location Images Quantity'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['location_images_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('News Images Quantity'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['news_images_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Coupon Quantity'); ?></dt>
		<dd>
			<?php echo h($plan['Plan']['coupon_quantity']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plan'), array('action' => 'edit', $plan['Plan']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Plan'), array('action' => 'delete', $plan['Plan']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $plan['Plan']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Plans'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan'), array('action' => 'add')); ?> </li>
	</ul>
</div>
