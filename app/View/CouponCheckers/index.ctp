<?php
$root = $this->Html->link('Ponistavanje kodova', array('controller' => 'coupon_checkers', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled korisnika');

$this->assign('title', 'Ponistavaci');
$this->assign('page-title', 'Ponistavaci <small>pregled podataka</small>');
echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/checkers/index', array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));
//debug($mapObjectsUsers);
?>
<div class="row">
    <div class="col-md-12">
        <?php echo $this->Html->link('Dodaj novog korisnika <i class="fa fa-arrow-circle-right"></i>', 
                array('controller' => 'coupon_checkers', 'action' => 'add'),
                array('escape' => false, 'class' => 'btn btn-green btn-sm')
        ); ?>
    </div>
</div>
<div class="row top30">
    <div class="col-md-12">
    <table cellpadding="0" cellspacing="0" class="table table-condensed">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                <th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
                <th><?php echo $this->Paginator->sort('full_name', 'Puno ime'); ?></th>
                <th><?php echo $this->Paginator->sort('fk_id_map_objects', 'Lokacija'); ?></th>
                <th><?php echo $this->Paginator->sort('can_do_checks', 'Čekiranje?'); ?></th>
                <th><?php echo $this->Paginator->sort('creation_date', 'Datum kreiranja'); ?></th>
                <th class="actions"><?php echo __('Akcije'); ?></th>
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
                    <td><?php echo $this->MyHtml->onlineStatus($mapObjectsUser['CouponChecker']['can_do_checks'],
                            $mapObjectsUser['CouponChecker']['id'], '/coupon_checkers/checkPermission'); ?></td>
                    <td>
                        <?php echo $this->Time->format($mapObjectsUser['CouponChecker']['creation_date'], '%d.%m.%Y %H:%M %p'); ?>
                        &nbsp;</td>
                    <td class="actions">
                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                            <?php echo $this->Html->link('<i class="fa fa-eye"></i>', 
                                    array('action' => 'view', $mapObjectsUser['CouponChecker']['id']),
                                    array(
                                        'class' => 'btn btn-xs btn-green tooltips btn-edit',
                                        'data-placement' => 'top',
                                        'data-original-title' => 'Pogledaj',
                                        'escape' => false
                                    )
                                ); ?>
                        </div>
                        
                        <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $mapObjectsUser['CouponChecker']['id'])); ?>
                        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mapObjectsUser['CouponChecker']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mapObjectsUser['CouponChecker']['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

<?php echo $this->element('pagination'); ?>
</div>

