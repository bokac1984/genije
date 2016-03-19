<?php
$root = $this->Html->link('Notifikacije', array('controller' => 'notifications', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Nova notifikacija' );

$this->assign('title', 'Notifikacije');
$this->assign('page-title', 'Notifikacije <small>nova notifikacija</small>');

$this->assign('breadcrumb-icon', $icon);
?>
<div class="notifications form row">
    <div class="col-md-6">
    <?php echo $this->Form->create('Notification'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('title', array(
            'label' => 'Naslov',
            'class' => 'form-control'
        ));
        echo $this->Form->input('text', array(
            'type' => 'textarea',
            'label' => 'Tekst notifikacije',
            'class' => 'form-control'
        ));
        ?>
    </fieldset>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-yellow btn-block" type="submit"> 
                Pošalji notifikacije <i class="fa fa-arrow-circle-right"></i> 
            </button>
        </div>
    </div>        
    <?php echo $this->Form->end(); ?>
    </div>
</div>
