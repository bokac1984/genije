<?php
$root = $this->Html->link('Kuponi', array('controller' => 'coupons', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled poslatih kupona');

$this->assign('title', 'Kuponi');
$this->assign('page-title', 'Kuponi <small>pregled podataka</small>');
//debug($eventsTickets);
?>
<div class="eventsTickets index">
    <h2><?php echo __('Kuponi'); ?></h2>
    <table cellpadding="0" cellspacing="0" class="table table-condensed">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                <th><?php echo $this->Paginator->sort('value', 'Vrijednost'); ?></th>
                <th><?php echo $this->Paginator->sort('fk_id_events', 'Događaj'); ?></th>
                <th><?php echo $this->Paginator->sort('fk_id_users', 'Korisnik'); ?></th>
                <th><?php echo $this->Paginator->sort('creation_date', 'Datum kreiranja'); ?></th>
                <th><?php echo $this->Paginator->sort('code_status', 'Status kupona'); ?></th
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventsTickets as $eventsTicket): ?>
                <tr>
                    <td><?php echo h($eventsTicket['Coupon']['id']); ?>&nbsp;</td>
                    <td><?php echo h($eventsTicket['Coupon']['value']); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($eventsTicket['Event']['name'], array('controller' => 'events', 'action' => 'view', $eventsTicket['Event']['id'])); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($eventsTicket['ApplicationUser']['display_name'], array('controller' => 'application_users', 'action' => 'view', $eventsTicket['ApplicationUser']['id'])); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format($eventsTicket['Coupon']['creation_date'], '%d.%m.%Y %H:%M %p'); ?>&nbsp;</td>
                    <td><?php echo $this->MyHtml->displayCouponStatus($eventsTicket['Coupon']['code_status']); ?>&nbsp;</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element('pagination'); ?>
</div>

