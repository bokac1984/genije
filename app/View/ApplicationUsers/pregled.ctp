<?php
$root = $this->Html->link('Korisnici', array('controller' => 'application_users', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled' );

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Interaktivna mapa <small>pregled</small>');

echo $this->Html->script('/js/libs/mc/markerclusterer', array('block' => 'scriptBottom'));
echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/gmaps/gmaps.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/users-map-view.js', array('block' => 'scriptBottom'));

echo $this->Html->scriptBlock("PageInitalization.init();", array('block'=>'scriptBottom'));
?>
<div class="row">
    <div class="col-md-12">
        <!-- start: BASIC MAP PANEL -->
        <div class="map large" id="map1"></div>
        <!-- end: BASIC MAP PANEL -->
    </div>
</div>