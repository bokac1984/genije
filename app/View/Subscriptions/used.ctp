<?php

$this->assign('page-breadcrumbroot', $this->Html->link('Pretplata', array('controller' => 'subscriptions', 'action' => 'index')));
$this->assign('crumb', 'Potrošene objave');

$this->assign('title', 'Pretplata');
$this->assign('page-title', 'Pretplata <small>pregled</small>');
$this->assign('breadcrumb-icon', $icon);
?>
<div class="row">
    <div class="col-md-12">
        <p>Poštovani, potrošili ste limit objava za ovaj mjesec, ako želite da prije novog obračunskog perioda objavljujete
        kontaktirajte administraciju za kupovinu dodatka.</p>
    </div>
</div>
