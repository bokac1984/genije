<?php
$root = $this->Html->link('Komandna tabla', array('controller' => 'dashboards', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled');

$this->assign('title', 'Komandna tabla');
$this->assign('page-title', 'Komandna tabla <small>pregled & statistike</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/js/libs/flot/jquery.flot.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/libs/flot/jquery.flot.pie.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/libs/flot/jquery.flot.resize.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/libs/jquery.sparkline/jquery.sparkline', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/libs/jquery-easy-pie-chart/jquery.easy-pie-chart', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/libs/jquery-ui-touch-punch/jquery.ui.touch-punch.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/dashboard', array('block' => 'scriptBottom'));
// ako nije admin daj neki znak javascirptu
$admin = $loggedInUser['group_id'] === '1' ? '1' : '0';
echo $this->Html->scriptBlock("Index.init($admin);", array('block' => 'scriptBottom'));
?>
<div class="row">
    <div class="col-sm-4">
        <div class="core-box">
            <div class="heading">
                <i class="clip-user-4 circle-icon circle-green"></i>
                <h2>Upravljaj dogadjajima</h2>
            </div>
            <div class="content">
                Pregledajte događaje u Vašoj lokaciji, upravljajte sa njima. Ako želite dodajte novi.
            </div>
            <?php
            echo $this->Html->link('Pogledajte Više <i class="clip-arrow-right-2"></i>', array(
                'controller' => 'events',
                'action' => 'index'
                    ), array(
                'escape' => false,
                'class' => 'view-more'
            ));
            ?>            
        </div>
    </div>
    <div class="col-sm-4">
        <div class="core-box">
            <div class="heading">
                <i class="clip-clip circle-icon circle-teal"></i>
                <h2>Dodajte novu vijest</h2>
            </div>
            <div class="content">
                Pogledajte postojeće vijesti, dodajte novu, izmjenite vijest. Sve na jednom mjestu.
            </div>
            <?php
            echo $this->Html->link('Pogledajte Više <i class="clip-arrow-right-2"></i>', array(
                'controller' => 'news',
                'action' => 'index'
                    ), array(
                'escape' => false,
                'class' => 'view-more'
            ));
            ?> 
        </div>
    </div>
    <div class="col-sm-4">
        <div class="core-box">
            <div class="heading">
                <i class="clip-location circle-icon circle-bricky"></i>
                <h2>Upravljaj lokacijom</h2>
            </div>
            <div class="content">
                Upravljajte Vašom lokacijom. Pregledajte komentare za lokacije.
            </div>
            <?php
            echo $this->Html->link('Pogledajte Više <i class="clip-arrow-right-2"></i>', array(
                'controller' => 'locations',
                'action' => 'index'
                    ), array(
                'escape' => false,
                'class' => 'view-more'
            ));
            ?> 
        </div>
    </div>
</div> 

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-stats"></i>
                Količina mjesečnih objava
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
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
                    <div class="row space12">
                        <div class="col-sm-4">
                            <div class="easy-pie-chart">
                                <span class="news number" data-percent="<?php echo $newsPercent; ?>"> <span class="percent"><?php echo $newsPercent; ?></span> </span>
                                <div class="label-chart">
                                    Vijesti
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="easy-pie-chart">
                                <span class="event number" data-percent="<?php echo $eventsPercent; ?>"> <span class="percent"><?php echo $eventsPercent; ?></span> </span>
                                <div class="label-chart">
                                    Događaji
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="easy-pie-chart">
                                <span class="products number" data-percent="<?php echo $productsPercent; ?>"> <span class="percent"><?php echo $productsPercent; ?></span> </span>
                                <div class="label-chart">
                                    Proizvodi
                                </div>
                            </div>
                        </div>            
                    </div>  
                </div>
            </div>
        </div>        
    </div>
</div>