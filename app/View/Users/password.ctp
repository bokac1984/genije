<?php
$root = $this->Html->link('Korisnici', array('controller' => 'users', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Promjena šifre' );

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Korisnici <small>promjena šifre</small>');
?>
<div class="row">
  <div class="col-md-6">
    <?php
        echo $this->Form->create('User', array(
            'plugin' => null,
            'controller' => 'users',
            'action' => 'password',
            'method' => 'post'
        ));
        $this->Form->inputDefaults(array(
                'error' => array(
                    'attributes' => array(
                        'wrap' => 'span',
                        'class' => 'help-block'
                    )
                ),

            )
        );   
        echo $this->Form->input('password', array(
            'class' => 'form-control',
            'type' => 'password',
            'placeholder' => 'Nova šifra',
            'label' => false,
            'div' => 'form-group '.($this->Form->isFieldError('password') ? 'has-error' : '')
        ));
        echo $this->Form->input('password2', array(
            'class' => 'form-control',
            'type' => 'password',
            'placeholder' => 'Nova šifra ponovo',
            'label' => false,
            'div' => 'form-group '.($this->Form->isFieldError('password2') ? 'has-error' : '')
        ));
        
        echo $this->Form->button('Ažuriraj <i class="fa fa-arrow-circle-right"></i>', 
                array(
                    'type' => 'submit', 
                    'class' => 'btn btn-teal btn-block'
            ));
        echo $this->Form->end();
    ?>
  </div>
</div>
