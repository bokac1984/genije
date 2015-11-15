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
debug($location);
echo $this->Html->script('/js/lokacije/view', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("Maps.init($lat, $long, '$name');", array('block' => 'scriptBottom'));
?>
<div class="row">
    <div class="col-sm-5 col-md-4">
        <div class="user-left">
            <div class="center">
                <h4><?php echo $user['ApplicationUser']['display_name'] ?></h4>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="user-image">
                        <div class="fileupload-new thumbnail">
                            <?php
                            echo $this->Html->image($user['ApplicationUser']['img_url'], array(
                                'alt' => 'my image'
                                    )
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="3">Kontakt Informacije</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>URL</td>
                        <td>
                            <?php echo $this->Html->link($this->Text->truncate($user['ApplicationUser']['person_url'], 50), $user['ApplicationUser']['person_url']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <a href="mailto:<?php echo $user['ApplicationUser']['email']; ?>"><?php echo $user['ApplicationUser']['email']; ?></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="3">Osnovne informacije</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pol</td>
                        <td><?php echo $user['ApplicationUser']['gender'] == '0' ? 'Muški': 'Ženski'; ?></td>
                    </tr>
                    <tr>
                        <td>Registrovan</td>
                        <td><?php echo $this->Time->format($user['ApplicationUser']['creation_date'], '%d.%m.%Y %H:%M %p') ?></td>
                    </tr>
                    <tr>
                        <td>Vrsta logina</td>
                        <td>
                            <?php  if ($user['ApplicationUser']['login_type'] === '1'): ?>
                                    <a class="btn btn-google-plus btn-sm btn-squared">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                            <?php else: ?>
                                    <a class="btn btn-facebook btn-sm btn-squared">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                            <?php endif; ?>
                        </td>
                    </tr>                    
                    <tr>
                        <td>Status</td>
                        <td>
                            <?php  if ($user['ApplicationUser']['status'] === '1'): ?>
                                <span class="label label-sm label-success">Aktivan</span>
                            <?php else: ?>
                                <span class="label label-sm label-danger">Neaktivan</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="3">Dodatne informacije</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Datum rođenja</td>
                        <td><?php echo $this->Time->format($user['ApplicationUser']['birth_date'], '%d.%m.%Y') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-7 col-md-8">
        <h3>Lokacija</h3>
        <div class="panel-body">
            <div class="map" id="map2"></div>
        </div>
    </div> 
</div>
<div class="row">
    <div class="col-sm-12 col-md-2">
        <h3>Komentari</h3>
        <div class="row komentari">
            <div class="col-md-12">
                <div class="content"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <span class="center" id="load-more">Load more</span>
            </div>
        </div>
    </div>
</div>