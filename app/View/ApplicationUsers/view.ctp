<?php
$root = $this->Html->link('Korisnici', array('controller' => 'application_users', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled podataka');

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Korisnici <small>pregled podataka</small>');

// zbog neke gluposti nije radilo, pa mora prije svega da se ucita gmaps
echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/gmaps/gmaps.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/js/maps.js', array('block' => 'scriptBottom'));
$lat = $user['ApplicationUser']['latitude'];
$long = $user['ApplicationUser']['longitude'];
$name = $user['ApplicationUser']['display_name'];

echo $this->Html->script('/js/libs/stars/star-rating', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/app_users/view', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("Maps.init($lat, $long, '$name');", array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/bootstrap-social-buttons/social-buttons-3', array('block' => 'css'));
echo $this->Html->css('/js/libs/stars/star-rating', array('block' => 'css'));
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
    <div class="col-sm-12">
        <div class="tabbable">
            <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">             
                <li class="active">
                    <a data-toggle="tab" href="#panel_comments">
                        Komentari
                    </a>
                </li>
            </ul>
            <div class="tab-content">             
                <div id="panel_comments"  class="tab-pane in active">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Pregled komentara za <strong><?php echo $name ?></strong></h3>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 comments-table">
                            <?php if (!empty($user['LocationComment'])): ?>
                                <table class="table table-condensed">
                                    <thead>
                                        <th>Sadržaj</th>
                                        <th>Ocjena</th>
                                        <th>Rejting</th>
                                        <th>Vrijeme</th>
                                        <th>Lokacija</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user['LocationComment'] as $comment): ?>
                                        <tr>
                                            <td><?php echo $comment['text']; ?>&nbsp;</td>
                                            <td>
                                                <input class="stars" value="<?php echo $comment['rating']; ?>" />
                                            </td>
                                            <td><?php echo $comment['comment_rating']; ?>&nbsp;</td>
                                            <td><?php echo $this->Time->format($comment['datetime'], '%d.%m.%Y %H:%M %p'); ?></td>
                                            <td><?php echo $this->Html->link($comment['Location']['name'], array('controller' => 'locations', 'action' => 'view', $comment['Location']['id'])); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                Ovaj korisnik nije ništa komentarisao.
                            <?php endif; ?>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div> 