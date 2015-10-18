<?php
echo $this->Html->script('http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerclusterer/1.0/src/markerclusterer.js', array('block' => 'scriptBottom'));
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