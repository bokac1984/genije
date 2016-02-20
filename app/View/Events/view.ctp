<?php
$root = $this->Html->link('Događaji', array('controller' => 'events', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled podataka');

$this->assign('title', $event['Event']['name']);
$this->assign('page-title', $event['Event']['name'] . ' <small>pregled podataka</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->css('/lightbox/css/lightbox', array('block' => 'css'));
echo $this->Html->script('/lightbox/js/lightbox', array('block' => 'scriptBottom'));
//debug($event);
?>
<style type="text/css">
	.table {
		border-bottom:0px !important;
	}
	.table th, .table td {
		border: 0px !important;
	}
</style>
<div class="row" style="margin-bottom: 20px;">
	<div class="col-md-6">
		<?php echo $this->Html->link('Pogledaj lokaciju', array(
			'controller' => 'locations',
			'action' => 'view',
			$event['Location']['id']
		),array(
			'class' => 'btn btn-primary btn-sm'
		)	); ?>
		<?php echo $this->Html->link('Izmjeni događaj', array(
			'controller' => 'events',
			'action' => 'edit',
			$event['Event']['id']
		),array(
			'class' => 'btn btn-success btn-sm'
		)	); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tbody>
				<tr>
					<td class="column-left">Početak</td>
					<td class="column-right">
						<?php echo $event['Event']['start_time']; ?>
					</td>
				</tr>
				<tr>
					<td class="column-left">Kraj</td>
					<td class="column-right">
						<?php echo $event['Event']['end_time']; ?>
					</td>
				</tr>
				<tr>
					<td>Slika</td>
					<td>
						<div class="thumbnail" style="max-width: 200px; margin-bottom:0px;">
							<?php
							$image = '/photos/' . $event['Event']['img_url'];
							if ('' !== $image) { ?>
								<a data-lightbox="galerija" class="group1"
								   href="<?php echo $image; ?>"
									>
									<img src="<?php echo $image; ?>"
										 alt=""
										 class="img-responsive"
										>
								</a>
                                                        <?php
							} else {
								echo $this->Html->image('no-photo.png');
							}
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td class="column-left">Tekst</td>
					<td class="column-right">
						<?php echo $event['Event']['html_text']; ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<table class="table	">
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
