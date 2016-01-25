<?php
$root = $this->Html->link('Događaji', array('controller' => 'events', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Nova događaj' );

$this->assign('title', 'Događaji');
$this->assign('page-title', 'Događaj <small>novi događaj</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/jquery-validation/dist/jquery.validate.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/summernote/build/summernote.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modal.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/bootstrap-daterangepicker/moment.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-daterangepicker/daterangepicker', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-switch/static/js/bootstrap-switch', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min', array('block' => 'scriptBottom'));

echo $this->Html->script('/js/event-new', array('block' => 'scriptBottom'));

$validateEvent = $this->Html->url(array('controller' => 'events', 'action' => 'validateEvent'));

echo $this->Html->scriptBlock("var validateEvent = '$validateEvent';", array('block'=>'scriptBottom'));
echo $this->Html->scriptBlock("FormValidator.init();", array('block'=>'scriptBottom'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min', array('block' => 'css'));
?>
<style type="text/css">
    .album-label {
        font-size: 1.8em;
        margin-top: 1em;
    }
    .switch-css {
        margin-top: -10px;
    }
</style>
<?php echo $this->Form->create('Event', array('type' => 'file', 'id' => 'form_new_event')); ?>
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
                <input type="text" placeholder="Naziv događaja" class="form-control" id="name" name="data[Event][name]">
            </div>                
            <div class="form-group">
                <label class="control-label"> Lid </label>
                <div>
                    <textarea maxlength="240" placeholder="Uvodna rečenica" name="data[Event][lid]" class="form-control limited"></textarea>
                </div>                    
            </div>
            <div class="form-group">
                <label class="control-label"> Vrijeme važenja </label>
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                    <input type="text" class="form-control date-range" name="value_time">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-field-city"> Grad </label>
                        <select id="city_id" class="form-control" name="city_id">
                            <option value="">Izaberite grad...</option>
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
                        <label for="control-label">
                            Lokacija <span class="symbol required"></span> 
                        </label>
                        <select id="map_object" name="data[Event][fk_id_map_objects]" class="form-control search-select">
                            <option selected="selected" value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"> Opis </label>
                <div class="summernote"></div>
                <textarea class="form-control no-display" id="html_text" name="data[Event][html_text]" cols="10" rows="10"></textarea>          
            </div>     

        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="cold-md-12">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="control-label album-label">
                            Uzmi sliku sa lokacije?
                        </label>
                        <div class="switch switch-css" data-on-label="Da" data-off-label="Ne" data-on="success" data-off="danger">
                            <input type="checkbox" id="location_image" checked name="data[Event][use_loc_image]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row slika_upload" style="margin-top: 20px; display: none;">
                <div class="cold-md-6">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="user-image" style="position: relative;display: inline-block;">
                            <div class="fileupload-new thumbnail">
                                <img src="/img/no-photo.png" />
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div class="user-image-buttons">
                                <span class="btn btn-teal btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
                                    <input type="file" name="data[Event][img_url]">
                                </span>
                                <a href="#" class="btn fileupload-exists btn-bricky btn-sm" data-dismiss="fileupload">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
            <input type="hidden" value="" id="start_time" name="data[Event][start_time]"/>
            <input type="hidden" value="" id="end_time" name="data[Event][end_time]"/>
            <button class="btn btn-yellow btn-block" type="submit"> Kreiraj događaj <i class="fa fa-arrow-circle-right"></i> </button>
        </div>    
    </div>
</form>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body alert alert-success" style="margin-bottom:0">
    	<i class="fa fa-check-circle"></i>
        <strong>Događaj uspješno kreiran!</strong> Molimo izaberite vaš sledeći korak.
    </div>
    <div class="modal-footer" style="margin-top:0">       
       <button type="button" data-dismiss="modal" onClick="window.location.href = '<?php echo $this->Html->url(array('controller' => 'events', 'action' => 'index'));?>'" class="btn btn-default">Pregled događaja</button> 
       <button type="button" data-dismiss="modal" onClick="window.location.href = '<?php echo $this->Html->url(array('controller' => 'events', 'action' => 'add'));?>';" class="btn btn-primary">Kreiraj novi</button>
    </div>
</div>