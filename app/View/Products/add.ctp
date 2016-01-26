<?php
$root = $this->Html->link('Proizvodi', array('controller' => 'products', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Novi proizvod' );
$this->assign('breadcrumb-icon', $icon);

$this->assign('title', 'Proizvodi');
$this->assign('page-title', 'Proizvodi <small>novi proizvod</small>');

echo $this->Html->script('/assets/plugins/jquery-validation/dist/jquery.validate.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/summernote/build/summernote.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modal.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/bootstrap-daterangepicker/moment.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-daterangepicker/daterangepicker', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/bootstrap-switch/static/js/bootstrap-switch', array('block' => 'scriptBottom'));

echo $this->Html->script('/js/products/new', array('block' => 'scriptBottom'));

$saveProducts = $this->Html->url(array(
    'controller' => 'products',
    'action' => 'saveProduct'
));

echo $this->Html->scriptBlock("var saveProducts = '$saveProducts';", array('block'=>'scriptBottom'));
echo $this->Html->scriptBlock("FormValidator.init();", array('block'=>'scriptBottom'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3', array('block' => 'css'));

echo $this->Html->css('/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch', array('block' => 'css'));
echo $this->Form->create('Product');
//debug($locationsForCity);
$this->Form->inputDefaults(array(
        'error' => array(
            'attributes' => array(
                'wrap' => 'div',
                'class' => 'label label-warning'
            )
        ),
        'div' => 'form-group',
        'class' => 'form-control'
    )
);
?>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->Form->input('name', array(
                    'label' => 'Naziv',
                    'required' => true,
                    'placeholder' => 'Naziv'
                ));

                echo $this->Form->input('', array(
                    'label' => 'Labela',
                    'placeholder' => 'Labela'
                ));
                echo $this->Form->input('price', array(
                    'label' => 'Cijena (KM)',
                ));
                ?>
                <div class="form-group">
                    <label for="control-label">
                        Grad <span class="symbol"></span> 
                    </label>
                    <select id="city_id" name="data[City][id]" class="form-control">
                        <option value="-1">Odaberite grad</option>
                    <?php
                        foreach ($cities as $k => $v) {
                            $selected = $k === $cityId ? 'selected' : '';
                            echo "<option value=\"$k\" $selected>" . $v . "</option>";
                        }
                        ?>
                    </select>                    
                </div>                
                <div class="form-group">
                    <label for="control-label">
                        Lokacija <span class="symbol required"></span> 
                    </label>
                    <select multiple="multiple" id="map_object" name="data[Location][Location][]" class="form-control search-select">
                        <?php
                        if (!empty($locationsForCity)) {
                            foreach ($locationsForCity as $loc) {
                                $selected = (int)$loc['id'] === $location ? 'selected' : '';
                                echo "<option value=\"{$loc['id']}\" $selected>{$loc['name']}</option>";
                            }
                        }
                         ?>
                    </select>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-condensed table-hover feature">
                            <thead>
                                <tr>
                                    <th colspan="3">Osobine proizvoda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        echo $this->Form->input('ProductFeature.0.title', array(
                                            'label' => false,
                                            'placeholder' => 'Naziv'
                                        ));
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $this->Form->input('ProductFeature.0.value', array(
                                            'label' => false,
                                            'placeholder' => 'Vrijednost'
                                        ));
                                        ?>
                                    </td>
                                    <td>
                                        <div style="margin-top: -13px;">
                                            <a href="#" class="dodaj_red btn btn-xs btn-teal tooltips"
                                               data-placement="top"><i class="fa fa-plus fa fa-white"></i></a>
                                            <a href="#" class="ukloni_red btn btn-xs btn-bricky tooltips"
                                               data-placement="top"><i class="fa fa-times fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <?php
        echo $this->Form->input('description', array(
            'label' => 'Opis',
            'class' => 'summernote',
            'id' => 'text'
        ));
        ?>
    </div>
</div>

<div class="row">
    <div class="separator"></div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <?php 
        echo $this->Form->button('Sačuvaj podatke', array(
            'type' => 'submit', 
            'class' => 'btn btn-yellow btn-block',
            'id' => 'save-product'
        ));
        echo $this->Form->end(); ?>
    </div>
</div>
