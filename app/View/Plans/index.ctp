<?php
$root = $this->Html->link('Vijesti', array('controller' => 'plans', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Planovi pretplate' );

$this->assign('title', 'Planovi pretplate');
$this->assign('page-title', 'Planovi pretplate <small>pregled planova</small>');
$this->assign('breadcrumb-icon', $icon);
?>

<div class="row plans index">
    <div class="col-sm-12">
         <table class="table table-condensed" cellpadding="0" cellspacing="0">
         <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('name', 'Naziv'); ?></th>
                <th><?php echo $this->Paginator->sort('description', 'Opis'); ?></th>
                <th><?php echo $this->Paginator->sort('duration', 'Period'); ?></th>
                <th><?php echo $this->Paginator->sort('price', 'Cijena'); ?></th>
                <th><?php echo $this->Paginator->sort('news_quantity', '# Vijesti'); ?></th>
                <th><?php echo $this->Paginator->sort('events_quantity', '# Dogadjaja'); ?></th>
                <th><?php echo $this->Paginator->sort('products_quantity', '# Proizvoda'); ?></th>
                <th><?php echo $this->Paginator->sort('location_images_quantity', '# slika na lokaciji'); ?></th>
                <th><?php echo $this->Paginator->sort('news_images_quantity', '# slika na vijestima'); ?></th>
                <th><?php echo $this->Paginator->sort('coupon_quantity', '# kupona'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plans as $plan): ?>
                <tr>
                    <td><?php echo h($plan['Plan']['id']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['name']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['description']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['duration']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['price']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['news_quantity']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['events_quantity']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['products_quantity']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['location_images_quantity']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['news_images_quantity']); ?>&nbsp;</td>
                    <td><?php echo h($plan['Plan']['coupon_quantity']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $plan['Plan']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $plan['Plan']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $plan['Plan']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $plan['Plan']['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>