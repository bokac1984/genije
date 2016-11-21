<?php

$this->assign('page-breadcrumbroot', $this->Html->link('Vijesti', array('controller' => 'news', 'action' => 'index')));
$this->assign('crumb', 'Potrošene vijesti');

$this->assign('title', 'Vijesti');
$this->assign('page-title', 'Vijesti <small>pregled</small>');
?>
<div class="row">
    <div class="col-md-12">
        <?php echo $usedCount; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php echo $subscribedCount; ?>
    </div>
</div>