<div class="row">
    <div class="col-md-6"
         <?php
         echo $this->Form->create('User');
         $this->Form->inputDefaults(
                 array(
                     'error' => array(
                         'attributes' => array(
                             'wrap' => 'span',
                             'class' => 'help-block'
                         )
                     ),
                     'class' => 'form-control',
                     'div' => array(
                         'class' => 'form-group'
                     )
         ));
         ?>
         <fieldset>
                 <?php
                 echo $this->Form->input('group_id', array(
                     'label' => 'Tip korisnika'
                 ));
                 echo $this->Form->input('username', array(
                     'label' => 'Username'
                 ));
                 echo $this->Form->input('password', array(
                     'label' => 'Šifra'
                 ));
                 echo $this->Form->input('first_name', array(
                     'label' => 'Ime'
                 ));
                 echo $this->Form->input('last_name', array(
                     'label' => 'Prezime'
                 ));
                 echo $this->Form->input('email', array(
                     'label' => 'Email'
                 ));
                 echo $this->Form->button('Sačuvaj korisnika <i class="fa fa-arrow-circle-right"></i>', array(
                     'class' => 'btn btn-yellow btn-block'
                 ));                 
                 ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
