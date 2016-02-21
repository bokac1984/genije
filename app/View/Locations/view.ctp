<?php
$root = $this->Html->link('Lokacije', array('controller' => 'locations', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled podataka');

$this->assign('title', $location['Location']['name']);
$this->assign('page-title', $location['Location']['name'] . ' <small>pregled podataka</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/gmaps/gmaps.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/js/maps.js', array('block' => 'scriptBottom'));
$lat = $location['Location']['latitude'];
$long = $location['Location']['longitude'];
$name = $location['Location']['name'];
//debug($location);
echo $this->Html->script('/js/libs/stars/star-rating', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/lokacije/view', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("Maps.init($lat, $long, '$name');var locationId = {$location['Location']['id']};", array('block' => 'scriptBottom'));
echo $this->Html->css('dots', array('block' => 'css'));
echo $this->Html->css('/js/libs/stars/star-rating', array('block' => 'css'));

$img = !empty($location['Location']['img_url']) ? '/photos/' . $location['Location']['img_url'] : '/img/no-photo.png';

?>
<!--<style type="text/css">
    .tab-padding.tab-blue > li > a, .tab-padding.tab-blue > li > a:focus {
        background-color: #007AFF;
    }
    .tab-padding.tab-blue > li.active > a, .tab-padding.tab-blue > li.active > a:focus, .tab-padding.tab-teal > li.active > a:hover {
        border-color: #007AFF #DDDDDD transparent;
        color: #333333;
    }  
</style>-->
<div class="row">
    <div class="col-sm-5 col-md-4">      
        <div class="user-left">
            <div class="center">
                <h4><?php echo $location['Location']['name'] ?></h4>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="user-image">
                        <div class="fileupload-new thumbnail">
                            <img src="<?php echo $img ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="3">Detalji lokacije</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tip</td>
                        <td>
                            <?php foreach ($location['MapObjectSubtypeRelation'] as $tipLokacije) : ?>
                                <span class="label label-sm label label-inverse">
                                    <?php echo $tipLokacije['ObjectSubtype']['name']; ?>
                                </span>&nbsp;
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Ocjena korisnika:</td>
                        <td data-toggle="tooltip" title="<?php echo $location['Location']['users_rating'] ?>">
                            <span>
                                <input class="stars-location" value="<?php echo $location['Location']['users_rating'] ?>" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Ocjena admina:</td>
                        <td>
                            <?php echo $location['Location']['admin_rating'] ?>
                        </td>
                    </tr>                    
                </tbody>
            </table>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="3">Kontakt informacije</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Adresa</td>
                        <td><?php echo $location['Location']['address'] . ", " . $location['City']['name']; ?></td>
                    </tr>
                    <?php foreach ($location['Contact'] as $contact): ?>
                        <?php if (!empty($contact['value'])): ?>
                        <tr>
                            <td><?php echo $contact['ContactType']['name']; ?></td>
                            <td><?php echo $contact['value']; ?></td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="3">Lokacija na mapi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="map" id="map2"></div></td>
                    </tr>
                </tbody>
            </table>            
        </div>
    </div>
    <div class="col-sm-7 col-md-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="tabbable" style="margin-top: 10px;">
                    <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                        <li class="active">
                            <a data-toggle="tab" href="#panel_news">
                                Vijesti
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#panel_products">
                                Proizvodi
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#panel_events">
                                Događaji
                            </a>
                        </li>                
                        <li>
                            <a data-toggle="tab" href="#panel_comments">
                                Komentari
                            </a>
                        </li>                
                    </ul>
                    <div class="tab-content">
                        <div id="panel_news" class="tab-pane in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Pregled vijesti za ovu lokaciju</h3>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if ($news): ?>   
                                    <table class="table table-condensed">
                                        <thead>
                                            <th>#</th>
                                            <th>Naslov</th>
                                            <th>Datum objave</th>
                                            <th>Akcije</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($news as $single): ?>
                                            <tr>
                                                <td><?php echo $single['News']['id']; ?></td>
                                                <td><?php echo $this->MyHtml->displayEmpty($single['News']['title'], 'Nema naslova'); ?></td>
                                                <td><?php echo $this->Time->format($single['News']['creation_date'], '%d.%m.%Y %H:%M %p'); ?></td>
                                                <td><?php echo $this->Html->link('Detalji', array('controller' => 'news', 'action' => 'view', $single['News']['id'])); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                        <h4>Nema vijesti za ovu lokaciju</h4>
                                    <?php endif; ?>
                                </div>
                            </div>                    
                        </div>
                        <div id="panel_products" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Pregled proizvoda za ovu lokaciju <?php echo $this->Html->link('Dodajte novi proizvod',
                                            array(
                                                'controller' => 'products',
                                                'action' => 'add',
                                                $location['Location']['id']
                                            ), array(
                                                'class' => 'btn btn-primary'
                                            )); ?></h3> 
                                    <hr>
                                    <p></p>
                                </div>
                            </div>
                            <div class="row loading">
                                <div class="col-md-12 col-md-offset-5">
                                    <div class="dots-loader">
                                        Loading…
                                    </div>
                                </div>
                            </div>                    
                            <div class="row">
                                <div class="col-md-12 products-table"></div>
                            </div>     
                        </div>
                        <div id="panel_events" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Pregled dogadjaja za ovu lokaciju</h3>
                                    <hr>
                                </div>
                            </div>
                            <div class="row loading">
                                <div class="col-md-12 col-md-offset-5">
                                    <div class="dots-loader">
                                        Loading…
                                    </div>
                                </div>
                            </div>                    
                            <div class="row">
                                <div class="col-md-12 events-table"></div>
                            </div>     
                        </div>                
                        <div id="panel_comments" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Pregled nedavnih komentara</h3>
                                    <hr>
                                </div>
                            </div>
                            <div class="row loading">
                                <div class="col-md-12 col-md-offset-5">
                                    <div class="dots-loader">
                                        Loading…
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12 comments-table"></div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div> 
</div>
