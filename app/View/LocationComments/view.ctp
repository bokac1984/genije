<div class="mapObjectsComments view">
<h2><?php echo __('Map Objects Comment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mapObjectsComment['MapObjectsComment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($mapObjectsComment['MapObjectsComment']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rating'); ?></dt>
		<dd>
			<?php echo h($mapObjectsComment['MapObjectsComment']['rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datetime'); ?></dt>
		<dd>
			<?php echo h($mapObjectsComment['MapObjectsComment']['datetime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment Rating'); ?></dt>
		<dd>
			<?php echo h($mapObjectsComment['MapObjectsComment']['comment_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mapObjectsComment['Location']['name'], array('controller' => 'locations', 'action' => 'view', $mapObjectsComment['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mapObjectsComment['ApplicationUser']['name'], array('controller' => 'application_users', 'action' => 'view', $mapObjectsComment['ApplicationUser']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Map Objects Comment'), array('action' => 'edit', $mapObjectsComment['MapObjectsComment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Map Objects Comment'), array('action' => 'delete', $mapObjectsComment['MapObjectsComment']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mapObjectsComment['MapObjectsComment']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Map Objects Comments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Map Objects Comment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Application Users'), array('controller' => 'application_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application User'), array('controller' => 'application_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
