<?php
$root = $this->Html->link('Ponistavanje kodova', array('controller' => 'coupon_checkers', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled korisnika');

$this->assign('title', 'Ponistavaci');
$this->assign('page-title', 'Ponistavaci <small>pregled podataka</small>');
?>
<div class="mapObjectsUsers view">
    <dl>
        <dt><?php echo __('#'); ?></dt>
        <dd>
            <?php echo h($mapObjectsUser['CouponChecker']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Username'); ?></dt>
        <dd>
            <?php echo h($mapObjectsUser['CouponChecker']['username']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Puno ime'); ?></dt>
        <dd>
            <?php echo h($mapObjectsUser['CouponChecker']['full_name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Kod'); ?></dt>
        <dd>
            <h2><?php echo h($mapObjectsUser['CouponCheckerLogin']['activation_code']); ?></h2>
            &nbsp;
        </dd>        
        <dt><?php echo __('Datum kreiranja'); ?></dt>
        <dd>
            <?php  echo $this->Time->format($mapObjectsUser['CouponChecker']['creation_date'], '%d.%m.%Y %H:%M %p'); ?>
            &nbsp;
        </dd>
    </dl>
</div>
