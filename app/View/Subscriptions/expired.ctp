<?php

$this->assign('page-breadcrumbroot', $this->Html->link('Pretplata', array('controller' => 'subscription', 'action' => 'index')));
$this->assign('crumb', 'Istekla pretplata');

$this->assign('title', 'Pretplata');
$this->assign('page-title', 'Pretplata <small>pregled</small>');
$this->assign('breadcrumb-icon', $icon);
?>
<div class="row">
    <div class="col-md-12">
        <p>Poštovani, istekla Vam je pretplata. Kontaktirajte administraciju za produženje iste.</p>
    </div>
</div>