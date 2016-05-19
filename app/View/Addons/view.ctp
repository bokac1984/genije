<div class="addons view">
<h2><?php echo __('Addon'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($addon['Addon']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($addon['Addon']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($addon['Addon']['duration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($addon['Addon']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($addon['Addon']['price']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Addon'), array('action' => 'edit', $addon['Addon']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Addon'), array('action' => 'delete', $addon['Addon']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $addon['Addon']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Addons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Addon'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($addon['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Birth Date'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Img'); ?></th>
		<th><?php echo __('Facebook'); ?></th>
		<th><?php echo __('Twitter'); ?></th>
		<th><?php echo __('Google Plus'); ?></th>
		<th><?php echo __('Linkedin'); ?></th>
		<th><?php echo __('Skype'); ?></th>
		<th><?php echo __('Creation Date'); ?></th>
		<th><?php echo __('Last Login Time'); ?></th>
		<th><?php echo __('Last Logout Time'); ?></th>
		<th><?php echo __('Salt'); ?></th>
		<th><?php echo __('Access Admins'); ?></th>
		<th><?php echo __('Access Locations'); ?></th>
		<th><?php echo __('Access Token'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($addon['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['group_id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['phone']; ?></td>
			<td><?php echo $user['birth_date']; ?></td>
			<td><?php echo $user['gender']; ?></td>
			<td><?php echo $user['address']; ?></td>
			<td><?php echo $user['img']; ?></td>
			<td><?php echo $user['facebook']; ?></td>
			<td><?php echo $user['twitter']; ?></td>
			<td><?php echo $user['google_plus']; ?></td>
			<td><?php echo $user['linkedin']; ?></td>
			<td><?php echo $user['skype']; ?></td>
			<td><?php echo $user['creation_date']; ?></td>
			<td><?php echo $user['last_login_time']; ?></td>
			<td><?php echo $user['last_logout_time']; ?></td>
			<td><?php echo $user['salt']; ?></td>
			<td><?php echo $user['access_admins']; ?></td>
			<td><?php echo $user['access_locations']; ?></td>
			<td><?php echo $user['access_token']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
