<?php
$root = $this->Html->link('Lokacije', array('controller' => 'locations', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Nova lokacija' );

$this->assign('title', 'Lokacije');
$this->assign('page-title', 'Lokacije <small>nova lokacija</small>');

$this->assign('breadcrumb-icon', $icon);

// zbog neke gluposti nije radilo, pa mora prije svega da se ucita gmaps
echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/gmaps/gmaps.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/js/maps.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/jquery-validation/dist/jquery.validate.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/summernote/build/summernote.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jQuery-Knob/js/jquery.knob.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modal.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js', array('block' => 'scriptBottom'));



echo $this->Html->script('/js/lokacije/location-new', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/lokacije/add-location-map', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("FormValidator.init();", array('block'=>'scriptBottom'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal.css', array('block' => 'css'));
?>
<form action="/locations/add" id="form_new_location" method="post" accept-charset="utf-8">
    <div class="row">
        <div class="col-md-12">
            <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> Imate greške. Molimo provjerite podatke ispod. </div>
            <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Podaci su uspješno popunjeni! </div>
        </div>
        <div class="col-md-6">                
            <div class="form-group">
                <label class="control-label"> 
                    Naziv <span class="symbol required"></span> 
                </label>
                <input type="text" placeholder="Naziv lokacije" class="form-control" id="name" name="data[Location][name]">
            </div>
            <div class="form-group">
                <label for="control-label">
                    Tip lokacije <span class="symbol required"></span> 
                </label>
                <select multiple="multiple" id="sub_types" name="data[MapObjectSubtypeRelation][sub_types][]" class="form-control search-select">
                    <?php
                    foreach ($subtypes as $k => $v) {
                        echo '<option value="' . $k . '">' . $v . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">
                    Lid
                </label>
                <div>
                    <textarea maxlength="200" placeholder="Uvodna rečenica" name="data[Location][lid]" class="form-control limited"></textarea>
                </div>                    
            </div>   
            <div class="form-group">
                <hr>
                <label class="control-label">
                    Rejting lokacije
                </label>
                <div>
                    <input class="knob" name="data[Location][admin_rating]" data-width="160" data-min="0" value="50">
                </div>
            </div>             
            <div class="form-group">
                <hr>
                <label class="control-label"> <strong>Kontakt podaci</strong> </label>
                <p> Tel. Mobilni <small class="text-warning">+387 99-999-999</small></p>
                <span class="input-icon">
                    <input id="contact_mobile" class="form-control" type="text" name="data[Contact][mobile]">
                    <i class="clip-mobile"></i> 
                </span>
            </div>
            <div class="form-group">
                <label class="control-label"> Tel. Fiksni <small class="text-warning">+387 99-999-999</small> </label>
                <span class="input-icon">
                    <input id="contact_phone" class="form-control" type="text" name="data[Contact][phone]">
                    <i class="clip-phone"></i> 
                </span>
            </div>
            <div class="form-group">
                <label class="control-label"> E-mail </label>
                <span class="input-icon">
                    <input id="contact_email" class="form-control" type="text" name="data[Contact][email]">
                    <i class="clip-bubble"></i> 
                </span>
            </div>
            <div class="form-group">
                <label class="control-label"> Web <small class="text-warning">(npr.: http://www.yoursite.com)</small> </label>
                <span class="input-icon">
                    <input id="contact_web" class="form-control" type="text" name="data[Contact][web]">
                    <i class="clip-world "></i> 
                </span>
            </div>                                 
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-field-city"> Grad <span class="symbol required"></span> </label>
                        <select id="city_id" class="form-control" name="data[Location][fk_id_cities]">
                            <option value="">&nbsp;</option>
                            <?php
                            foreach ($cities as $k => $v) {
                                echo '<option value="' . $k . '">' . $v . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label"> Adresa <span class="symbol required"></span> </label>
                        <input class="form-control tooltips" type="text" placeholder="Naziv ulice i broj" data-rel="tooltip"  title="" data-placement="top" name="data[Location][address]" id="address">
                    </div>
                </div>
            </div>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"> Geografska širina <span class="symbol required"></span> </label>
                        <input class="form-control tooltips" type="text" name="data[Location][longitude]" id="longitude">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"> Geografska dužina <span class="symbol required"></span> </label>
                        <input class="form-control tooltips" type="text" name="data[Location][latitude]" id="latitude">
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"> 
                    <strong>Detaljan opis</strong> <span class="symbol required"></span> 
                </label>
                <div class="summernote"></div>
                <textarea class="form-control no-display" id="html_text" name="data[Location][html_text]" cols="10" rows="10"></textarea>          
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <button class="btn btn-yellow btn-block" type="submit"> Unesi lokaciju <i class="fa fa-arrow-circle-right"></i> </button>
        </div>    
    </div>
</form>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body alert alert-success" style="margin-bottom:0">
    	<i class="fa fa-check-circle"></i>
        <strong>Lokacija uspješno kreirana!</strong> Molimo izaberite vaš sledeći korak.
    </div>
    <div class="modal-footer" style="margin-top:0">       
       <button type="button" data-dismiss="modal" onClick="window.location.href = '<?php echo $this->Html->url(array('controller' => 'locations', 'action' => 'index')) ?>';" class="btn btn-default">Pregled lokacija</button> 
       <button type="button" data-dismiss="modal" onClick="window.location.href = '<?php echo $this->Html->url(array('controller' => 'locations', 'action' => 'add')) ?>';" class="btn btn-primary">Kreiraj novu</button>
    </div>
</div>