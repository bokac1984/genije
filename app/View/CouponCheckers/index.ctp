<?php
$root = $this->Html->link('Ponistavanje kodova', array('controller' => 'coupon_checkers', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled korisnika');

$this->assign('title', 'Ponistavaci');
$this->assign('page-title', 'Ponistavaci <small>pregled podataka</small>');
//debug($eventsTickets);
?>
<div class="mapObjectsUsers index">
    <table cellpadding="0" cellspacing="0" class="table table-condensed">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                <th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
                <th><?php echo $this->Paginator->sort('full_name', 'Puno ime'); ?></th>
                <th><?php echo $this->Paginator->sort('fk_id_map_objects', 'Lokacija'); ?></th>
                <th><?php echo $this->Paginator->sort('creation_date', 'Datum kreiranja'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mapObjectsUsers as $mapObjectsUser): ?>
                <tr>
                    <td><?php echo h($mapObjectsUser['CouponChecker']['id']); ?>&nbsp;</td>
                    <td><?php echo h($mapObjectsUser['CouponChecker']['username']); ?>&nbsp;</td>
                    <td><?php echo h($mapObjectsUser['CouponChecker']['full_name']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($mapObjectsUser['Location']['name'], array('controller' => 'locations', 'action' => 'view', $mapObjectsUser['Location']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Time->format($mapObjectsUser['CouponChecker']['creation_date'], '%d.%m.%Y %H:%M %p'); ?>
                        &nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $mapObjectsUser['CouponChecker']['id'])); ?>
                        <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $mapObjectsUser['CouponChecker']['id'])); ?>
                        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mapObjectsUser['CouponChecker']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mapObjectsUser['CouponChecker']['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php echo $this->element('pagination'); ?>
</div>

