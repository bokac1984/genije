<?php
$root = $this->Html->link('Korisnici', array('controller' => 'locations', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Dodavanje novog korisnika');

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Korisnici <small>novi korisnik</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/select2/select2.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload', array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/select2/select2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload', array('block' => 'css'));

echo $this->Html->css('errors', array('block' => 'css'));
?>
<div class="row">
    <?php
    echo $this->Form->create('User', array('type' => 'file', 'id' => 'user_form'));
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
    <div class="col-md-4">
        <?php
        echo $this->Form->input('username', array(
            'label' => array(
                'text' => 'Korisničko ime',
                'class' => 'control-label'
            ),
        ));
        echo $this->Form->input('password', array(
            'label' => array(
                'text' => 'Šifra',
                'class' => 'control-label'
            ),
        ));
        echo $this->Form->input('password2', array(
            'label' => array(
                'text' => 'Šifra ponovo',
                'class' => 'control-label'
            ),
            'type' => 'password'
        ));        
        echo $this->Form->input('first_name', array(
            'label' => array(
                'text' => 'Ime',
                'class' => 'control-label'
            ),
        ));
        echo $this->Form->input('last_name', array(
            'label' => array(
                'text' => 'Prezime',
                'class' => 'control-label'
            ),
        ));
        echo $this->Form->input('email', array(
            'label' => array(
                'text' => 'E-mail',
                'class' => 'control-label'
            ),
        ));
        echo $this->Form->button('Sačuvaj korisnika <i class="fa fa-arrow-circle-right"></i>', array(
            'class' => 'btn btn-yellow btn-block'
        ));
        ?>
    </div>
    <div class="col-md-4">
        <label>Odaberite sliku korisnika</label>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                <?php echo $this->Html->image('/img/empty.png') ?>
            </div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">

            </div>
            <div>
                <span class="btn btn-light-grey btn-file"><span class="fileupload-new">
                        <i class="fa fa-picture-o"></i> Odaberi sliku
                    </span>
                    <span class="fileupload-exists"><i class="fa fa-picture-o"></i> Promjeni</span>
                    <input type="file" name="data[User][img]">
                </span>
                <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                    <i class="fa fa-times"></i> Ukloni
                </a>
            </div>
        </div>  
    </div>
    <div class="col-md-4">
        <?php if (!empty($this->validationErrors['User']['img'])): ?>
            <div class="form-group error">
                <?php
                foreach ($this->validationErrors['User']['img'] as $error) {
                    echo '<span for="name" class="help-block">' . $error . '</span>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div> 
    <?php echo $this->Form->end(); ?>
</div>
