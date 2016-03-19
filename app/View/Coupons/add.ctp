<?php
$root = $this->Html->link('Kuponi', array('controller' => 'coupons', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Novi kupon');

$this->assign('title', 'Kuponi');
$this->assign('page-title', 'Kuponi <small>novi kupon</small>');

$this->assign('breadcrumb-icon', $icon);

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

echo $this->Html->script('/js/coupon/new', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("FormValidator.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal.css', array('block' => 'css'));
?>
<style>
    .select2-search-choice-close {
        margin-right: 5px;
    }
</style>

<div class="row">
    <?php echo $this->Form->create('Coupon'); ?>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label class="control-label" for="form-field-city"> Grad <span class="symbol required"></span> </label>
                    <select id="city_id" class="form-control" name="data[Coupon][fk_id_cities]">
                        <option value="">Izaberite grad...</option>
                        <?php
                        foreach ($cities as $k => $v) {
                            echo '<option value="' . $k . '">' . $v . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group" style="margin-top: -3px;">
                    <label for="control-label">
                        Događaj <span class="symbol required"></span>
                    </label>
                    <select id="fk_id_events" name="data[Coupon][fk_id_events]" class="form-control search-select">
                        <option selected="selected" value=""></option>
                    </select>
                </div>                 
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label class="control-label"> 
                        Broj kupona <span class="symbol required"></span> 
                    </label>
                    <input type="text" placeholder="Broj kupona" class="form-control" id="coupon_count" name="data[Coupon][coupon_count]">
                </div> 
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label class="control-label"> 
                        Ciljani pol
                    </label>
                    <select id="gender" class="form-control" name="data[Coupon][gender]">
                        <option value="-1">Svi</option>
                        <option value="0">Muški</option>
                        <option value="1">Ženski</option>
                    </select>
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label"> 
                        Vrijednost kupona <span class="symbol required"></span> 
                    </label>
                    <input type="text" placeholder="Unesite vrijednost kupona" class="form-control" id="coupon_count" name="data[Coupon][value]">
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label"> Tekst poruke </label>
                    <div>
                        <textarea maxlength="255" placeholder="Unesite tekst poruke" name="data[Coupon][value]" class="form-control limited"></textarea>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label"> Pronađi lokaciju </label>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tekst za pretragu" id="address_geocode" name="address_geocode">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"> Geografska širina <span class="symbol required"></span> </label>
                    <input class="form-control tooltips" type="text" name="data[Coupon][longitude]" id="longitude">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"> Geografska dužina <span class="symbol required"></span> </label>
                    <input class="form-control tooltips" type="text" name="data[Coupon][latitude]" id="latitude">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"> Radius (m)<span class="symbol required"></span> </label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="U metrima" id="radius" name="data[Coupon][radius]">
                            <span class="input-group-btn">
                                <button class="btn btn-bricky" id="draw_radius" type="button"> Iscrtaj </button>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>            
        </div>  
        <div class="row">
            <div class="col-md-12">
                <input class="form-control tooltips" type="hidden" name="data[Coupon][check]" value="1" id="check">
                <button class="btn btn-yellow btn-block" type="submit"> 
                    Generiši tikete <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div> 
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<div id="ajax-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-body alert" style="margin-bottom:0">

    </div>
    <div class="modal-footer" style="margin-top:0">  
        <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">Odustani</button>     
        <button id="btn-generate-tickets" type="button" data-dismiss="modal" class="btn btn-primary">Nastavi</button>
    </div>
</div>