<div class="notifications view">
<h2><?php echo __('Notification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img Url'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['img_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fk Id Users'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['fk_id_users']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type Id'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['type_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Notification'), array('action' => 'edit', $notification['Notification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Notification'), array('action' => 'delete', $notification['Notification']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $notification['Notification']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Application Users'), array('controller' => 'application_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application User'), array('controller' => 'application_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Application Users'); ?></h3>
	<?php if (!empty($notification['ApplicationUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Social Id'); ?></th>
		<th><?php echo __('Display Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Img Url'); ?></th>
		<th><?php echo __('Person Url'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Birth Date'); ?></th>
		<th><?php echo __('Latitude'); ?></th>
		<th><?php echo __('Longitude'); ?></th>
		<th><?php echo __('Creation Date'); ?></th>
		<th><?php echo __('Password Hash'); ?></th>
		<th><?php echo __('Access Token'); ?></th>
		<th><?php echo __('Gcm Regid'); ?></th>
		<th><?php echo __('Login Type'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($notification['ApplicationUser'] as $applicationUser): ?>
		<tr>
			<td><?php echo $applicationUser['id']; ?></td>
			<td><?php echo $applicationUser['social_id']; ?></td>
			<td><?php echo $applicationUser['display_name']; ?></td>
			<td><?php echo $applicationUser['email']; ?></td>
			<td><?php echo $applicationUser['img_url']; ?></td>
			<td><?php echo $applicationUser['person_url']; ?></td>
			<td><?php echo $applicationUser['gender']; ?></td>
			<td><?php echo $applicationUser['birth_date']; ?></td>
			<td><?php echo $applicationUser['latitude']; ?></td>
			<td><?php echo $applicationUser['longitude']; ?></td>
			<td><?php echo $applicationUser['creation_date']; ?></td>
			<td><?php echo $applicationUser['password_hash']; ?></td>
			<td><?php echo $applicationUser['access_token']; ?></td>
			<td><?php echo $applicationUser['gcm_regid']; ?></td>
			<td><?php echo $applicationUser['login_type']; ?></td>
			<td><?php echo $applicationUser['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'application_users', 'action' => 'view', $applicationUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'application_users', 'action' => 'edit', $applicationUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'application_users', 'action' => 'delete', $applicationUser['id']), array('confirm' => __('Are you sure you want to delete # %s?', $applicationUser['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Application User'), array('controller' => 'application_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
