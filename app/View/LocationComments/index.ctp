<?php
$root = $this->Html->link('Komentari', array('controller' => 'location_comments', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled kometara');

$this->assign('title', 'Komentari');
$this->assign('page-title', 'Komentari <small>pregled podataka</small>');
//debug($LocationComments);
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <table class="table table-condensed" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                    <th><?php echo $this->Paginator->sort('text', 'Sadržaj'); ?></th>
                    <th><?php echo $this->Paginator->sort('rating', 'Ocjena'); ?></th>
                    <th><?php echo $this->Paginator->sort('datetime', 'Vrijeme'); ?></th>
                    <th><?php echo $this->Paginator->sort('comment_rating', 'Rejting'); ?></th>
                    <th><?php echo $this->Paginator->sort('fk_id_map_objects', 'Lokacija'); ?></th>
                    <th><?php echo $this->Paginator->sort('fk_id_users', 'Korisnik'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($LocationComments as $mapObjectsComment): ?>
                    <tr>
                        <td><?php echo h($mapObjectsComment['LocationComment']['id']); ?>&nbsp;</td>
                        <td><?php echo !empty($mapObjectsComment['LocationComment']['text']) ?
                                $mapObjectsComment['LocationComment']['text'] :
                                '<i class="no-comment">Nema komenatara</i>'; ?></td>
                        <td><?php echo h($mapObjectsComment['LocationComment']['rating']); ?>&nbsp;</td>
                        <td><?php echo h($this->Time->format($mapObjectsComment['LocationComment']['datetime'], '%d.%m.%Y %H:%M %p')); ?>&nbsp;</td>
                        <td><?php
                        echo h($mapObjectsComment['LocationComment']['comment_rating']);
                         ?>&nbsp;</td>
                        <td>
                            <?php 
                        if ($loggedInUser === '1') {
                            echo $this->Html->link($mapObjectsComment['Location']['name'], array('controller' => 'locations', 'action' => 'view', $mapObjectsComment['Location']['id']));
                        } else {
                            echo $mapObjectsComment['Location']['name'];
                        }
                             ?>
                        </td>
                        <td>
                            <?php 
                            if ($loggedInUser === '1') {
                                echo $this->Html->link($mapObjectsComment['ApplicationUser']['display_name'], array('controller' => 'application_users', 'action' => 'view', $mapObjectsComment['ApplicationUser']['id']));
                            } else {
                                echo $mapObjectsComment['ApplicationUser']['display_name'];
                            }                            
                             ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>
