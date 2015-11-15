<?php
$root = $this->Html->link('Gradovi', array('controller' => 'cities', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled');
$this->assign('breadcrumb-icon', $icon);

$this->assign('title', 'Gradovi');
$this->assign('page-title', 'Gradovi <small>pregled</small>');
?>
<div class="row">
	<div class="col-md-12">
		<table class="table" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id', '#'); ?></th>
				<th><?php echo $this->Paginator->sort('name', 'Naziv'); ?></th>
				<th><?php echo $this->Paginator->sort('weather_code'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($cities as $city): ?>
				<tr>
					<td><?php echo h($city['City']['id']); ?>&nbsp;</td>
					<td><?php echo h($city['City']['name']); ?>&nbsp;</td>
					<td><?php echo h($city['City']['weather_code']); ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $city['City']['id']), array(
							'escape' => false,
							'class' => 'btn btn-xs btn-teal tooltips'
						)); ?>
						<?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $city['City']['id']), array(
							'escape' => false,
							'class' => 'btn btn-xs btn-green tooltips'
						)); ?>
						<?php echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>',
							array('action' => 'delete', $city['City']['id']),
							array('escape' => false, 'class' => 'btn btn-xs btn-bricky tooltips')
						); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class='col-md-12'>
		<?php echo $this->element('pagination'); ?>
	</div>
</div>