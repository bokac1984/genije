<?php
$root = $this->Html->link('Gradovi', array('controller' => 'cities', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Novi grad');
$this->assign('breadcrumb-icon', $icon);

$this->assign('title', 'Gradovi');
$this->assign('page-title', 'Gradovi <small>novi grad</small>');

// zbog neke gluposti nije radilo, pa mora prije svega da se ucita gmaps
echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/gmaps/gmaps.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/js/maps.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/jquery-validation/dist/jquery.validate.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/summernote/build/summernote.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modal.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/js/cities/add-city', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("FormValidator.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal.css', array('block' => 'css'));
?>
<div class="row">
    <div class="col-md-6">
        <?php
            echo $this->Form->create('City');
            $this->Form->inputDefaults(array(
                    'error' => array(
                        'attributes' => array(
                            'wrap' => 'span',
                            'class' => 'help-block'
                        )
                    ),

                )
            );
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Unesite naziv grada" id="address_geocode" name="data[City][name]">
                                    <span class="input-group-btn">
                                        <button class="btn btn-bricky" id="search_map" type="button"> Pretraži </button>
                                    </span>
                            </div>
                        </div>
                        <div class="map" id="map1"></div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"> Geografska širina <span class="symbol required"></span> </label>
                    <?php echo $this->Form->input('longitude', array(
                        'class' => 'form-control tooltips',
                        'id' => 'longitude',
                        'label' => false,
                        'div' => false
                    )) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"> Geografska dužina <span class="symbol required"></span> </label>
                    <?php echo $this->Form->input('latitude', array(
                        'class' => 'form-control tooltips',
                        'id' => 'latitude',
                        'label' => false,
                        'div' => false
                    )) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php
        echo $this->Form->input('weather_code', array(
            'class' => 'form-control',
            'placeholder' => 'Weather Code',
            'label' => false,
            'div' => 'form-group ' . ($this->Form->isFieldError('weather_code') ? 'has-error' : '')
        ));
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php
        echo $this->Form->button('Sačuvaj <i class="fa fa-arrow-circle-right"></i>',
            array(
                'type' => 'submit',
                'class' => 'btn btn-teal btn-block'
            ));

        ?>
    </div>
    <div class="col-md-6"></div>
</div>
<?php echo $this->Form->end(); ?>