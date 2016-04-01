<?php
$root = $this->Html->link('Baneri', array('controller' => 'banners', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Dodavanje banera');

$this->assign('title', 'Baneri');
$this->assign('page-title', 'Baneri <small>dodavanje banera</small>');

echo $this->Html->script('/assets/plugins/select2/select2.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload', array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/select2/select2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload', array('block' => 'css'));

echo $this->Html->script('/js/checkers/new', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("FormValidator.init();", array('block'=>'scriptBottom'));
?>
<div class="banners row">
    <div class="col-md-6">
        <?php
        echo $this->Form->create('Banner', array('type' => 'file', 'id' => 'banner_form'));
        $this->Form->inputDefaults(array(
            'error' => array(
                'attributes' => array(
                    'wrap' => 'span',
                    'class' => 'help-block'
                )
            ),
            'div' => 'form-group',
            'class' => 'form-control'
                )
        );
        ?>        
        <div class="row">
            <div class="col-md-12">

            <?php
            echo $this->Form->input('title', array(
                'label' => 'Naslov'
            ));
            echo $this->Form->input('lid', array(
                'label' => 'Lid'
            ));
            ?>
            <div class="row">
                <div class="col-md-6">
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
                                <input type="file" name="data[Banner][img_url]">
                            </span>
                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                <i class="fa fa-times"></i> Ukloni
                            </a>
                        </div>
                    </div>  
                </div>
                <div class="col-md-6">
                    <?php if (!empty($this->validationErrors['Banner'])): ?>
                    <div class="form-group has-error">
                    <?php
                    foreach ($this->validationErrors['Banner']['img_url'] as $error) {
                        echo '<span for="name" class="help-block">'.$error.'</span>';
                    }
                    
                    ?>
                    </div>
                    <?php endif; ?>
                </div>                
            </div>
      
            <?php
            echo $this->Form->input('link', array(
                'label' => 'URL'
            ));
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-yellow btn-block" type="submit"> 
                    Sačuvaj podatke o baneru <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>