<?php
$root = $this->Html->link('Korisnici', array('controller' => 'locations', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled korisnika' );

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Korisnici <small>pregled podataka</small>');

$this->assign('breadcrumb-icon', $icon);
?>
<div class="row">
    <div class="col-md-12">
        <p>
        <?php echo $this->Html->link('Dodaj novog korisnika <i class="fa fa-arrow-circle-right"></i>', 
                array('controller' => 'users', 'action' => 'add'),
                array('escape' => false, 'class' => 'btn btn-green btn-sm')
        ); ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <table class="table table-bordered table-hover users-table" cellpadding="0" cellspacing="0">
            <tr>                  
                <th><?php echo $this->Paginator->sort('username', 'Korisničko ime'); ?></th>
                <th><?php echo $this->Paginator->sort('first_name', 'Ime'); ?></th>
                <th><?php echo $this->Paginator->sort('last_name', 'Prezime'); ?></th>
                <th><?php echo $this->Paginator->sort('creation_date', 'Kreiran'); ?></th>
                <th><?php echo $this->Paginator->sort('last_login_time', 'Zadnji put online'); ?></th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php 
                    echo $this->Html->link(h($user['User']['username']), array(
                        'controller' => 'users',
                        'action' => 'overview',
                        $user['User']['id']
                    )); 
                    ?>&nbsp;</td>
                    <td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format($user['User']['creation_date'], '%d.%m.%Y %H:%M %p') ?>&nbsp;</td>
                    <td><?php echo $this->Time->format($user['User']['last_login_time'], '%d.%m.%Y %H:%M %p') ?>&nbsp;</td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </div>
</div>
<?php echo $this->element('pagination'); ?>

