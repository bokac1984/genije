<?php
$root = $this->Html->link('Komandna tabla', array('controller' => 'dashboards', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled');

$this->assign('title', 'Komandna tabla');
$this->assign('page-title', 'Komandna tabla <small>pregled & statistike</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/flot/jquery.flot', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/flot/jquery.flot.pie', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/flot/jquery.flot.resize.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery.sparkline/jquery.sparkline', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/dashboard', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("Index.init();", array('block'=>'scriptBottom'));
?>
<div class="row">
    <div class="col-sm-4">
        <div class="core-box">
            <div class="heading">
                <i class="clip-user-4 circle-icon circle-green"></i>
                <h2>Upravljaj korisnicima</h2>
            </div>
            <div class="content">
                Pregledajte sve korisnike Genie android aplikacije, pogledajte njihove lokacije, saznajte sve relevantne podatke.
            </div>
            <?php echo $this->Html->link('Pogledajte Više <i class="clip-arrow-right-2"></i>', array(
                'controller' => 'application_users',
                'action' => 'index'
            ),array(
                'escape' => false,
                'class' => 'view-more'
            )); ?>            
        </div>
    </div>
    <div class="col-sm-4">
        <div class="core-box">
            <div class="heading">
                <i class="clip-clip circle-icon circle-teal"></i>
                <h2>Upravljaj kuponima</h2>
            </div>
            <div class="content">
                Pošaljite novi kupon, pogledajte poslane kupone. Kreirajte super ponudu koju ćete poslati kuponom.
            </div>
            <?php echo $this->Html->link('Pogledajte Više <i class="clip-arrow-right-2"></i>', array(
                'controller' => 'tickets',
                'action' => 'index'
            ),array(
                'escape' => false,
                'class' => 'view-more'
            )); ?> 
        </div>
    </div>
    <div class="col-sm-4">
        <div class="core-box">
            <div class="heading">
                <i class="clip-location circle-icon circle-bricky"></i>
                <h2>Upravljaj lokcijama</h2>
            </div>
            <div class="content">
                Dodajte novu lokaciju, uredite postojeću. Pregledajte komentare za lokacije.
            </div>
            <?php echo $this->Html->link('Pogledajte Više <i class="clip-arrow-right-2"></i>', array(
                'controller' => 'locations',
                'action' => 'index'
            ),array(
                'escape' => false,
                'class' => 'view-more'
            )); ?> 
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-stats"></i>
                Site Visits
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                    </a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#">
                        <i class="fa fa-refresh"></i>
                    </a>
                    <a class="btn btn-xs btn-link panel-close" href="#">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="flot-medium-container">
                    <div id="placeholder-h1" class="flot-placeholder"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="clip-pie"></i>
                        Acquisition
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-mini-container">
                            <div id="placeholder-h2" class="flot-placeholder"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="clip-bars"></i>
                        Pageviews real-time
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-mini-container">
                            <div id="placeholder-h3" class="flot-placeholder"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>