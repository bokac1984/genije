<?php

$this->assign('page-breadcrumbroot', $this->Html->link('Pretplata', array('controller' => 'subscription', 'action' => 'index')));
$this->assign('crumb', 'Pregled podataka');

$this->assign('title', 'Pretplata');
$this->assign('page-title', 'Pretplata <small>pregled</small>');
$this->assign('breadcrumb-icon', $icon);
?>
<div class="subscriptions index">
    <h2><?php echo __('Subscriptions'); ?></h2>
    <table class="table table-condensed" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('additional_data', 'Dodatni podaci'); ?></th>
                <th><?php echo $this->Paginator->sort('start_date', 'Početak'); ?></th>
                <th><?php echo $this->Paginator->sort('end_date', 'Kraj'); ?></th>
                <th><?php echo $this->Paginator->sort('plans_id', 'Plan'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscriptions as $subscription): ?>
                <tr>
                    <td><?php echo h($subscription['Subscription']['additional_data']); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format($subscription['Subscription']['start_date'], '%d.%m.%Y %H:%M %p'); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format($subscription['Subscription']['end_date'], '%d.%m.%Y %H:%M %p'); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($subscription['Plan']['name'], array('controller' => 'plans', 'action' => 'view', $subscription['Plan']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element('pagination'); ?>
</div>


