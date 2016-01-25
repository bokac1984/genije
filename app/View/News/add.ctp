<?php
$root = $this->Html->link('Vijesti', array('controller' => 'news', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Nova vijest');

$this->assign('title', 'Vijesti');
$this->assign('page-title', 'Vijesti <small>nova vijest</small>');

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

echo $this->Html->script('/js/news/news-new', array('block' => 'scriptBottom'));

$saveNews = $this->Html->url(array(
    'controller' => 'news',
    'action' => 'saveNews'
        ));

$addImages = $this->Html->url(array(
    'controller' => 'news',
    'action' => 'images'
        ));
echo $this->Html->scriptBlock("var saveNews = '$saveNews', add_images = '$addImages';", array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("FormValidator.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3', array('block' => 'css'));
echo $this->Html->css('grid', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch', array('block' => 'css'));
?>
<style type="text/css">
    .form-control.search-select {margin-top: -3px; }
    .select2-container .select2-choice abbr { right: 30px; }
    .album-label {
        font-size: 1.8em;
    }
    .switch-css {
        margin-top: -10px;
    }    
    .no-location {
        color: #a94442;
        margin-left: 1em;
        margin-top: 0.75em;
        float: left;
        display: none;
    }
    .btn-prpizvodi {
        float: left;
    }

    .proizvodi-opener { display: none; }
</style>
<form action="#" id="form_new_event">
    <div class="row">
        <div class="col-md-12">
            <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> Imate greške. Molimo provjerite podatke ispod. </div>
            <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Podaci su uspješno popunjeni! </div>
        </div>
        <div class="col-md-6">                
            <div class="form-group">
                <label class="control-label"> 
                    Naslov <span class="symbol required"></span> 
                </label>
                <input type="text" placeholder="Naslov vijesti" class="form-control" id="name" name="data[News][title]">
            </div>                
            <div class="form-group">
                <label class="control-label"> Lid <span class="symbol required"></span>  </label>
                <div>
                    <textarea maxlength="240" placeholder="Uvodna rečenica" name="data[News][lid]" class="form-control limited"></textarea>
                </div>                    
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="form-field-city"> 
                            Grad <span class="symbol required"></span> 
                        </label>
                        <select id="city_id" class="form-control" name="data[News][fk_id_cities]">
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
                            Lokacija
                        </label>
                        <select id="map_object" name="data[News][fk_id_map_objects]" class="form-control search-select">
                            <option selected="selected" value=""></option>
                        </select>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="control-label">
                            Događaj
                        </label>
                        <select id="fk_id_events" name="data[News][fk_id_events]" class="form-control search-select">
                            <option selected="selected" value=""></option>
                        </select>
                    </div>
                </div>  
                <div class="col-md-12" id="show_products">
                    <div class="form-group">
                        <label class="control-label album-label"> 
                            Prikaži proizvode? <span class="symbol required"></span> 
                        </label>
                        <div class="switch switch-css" data-on-label="Da" data-off-label="Ne" data-on="success" data-off="danger">
                            <input type="checkbox" id="show_products" name="data[News][show_products]" />
                        </div>

                    </div>  
                </div>   
                <div class="col-md-12 proizvodi-opener">
                    <button id="otvori-proizvode" class="btn btn-default btn-prpizvodi">Pregledajte proizvode</button>
                    <p class="no-location">Morate prvo odabrati lokaciju</p>
                </div>               
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label"> 
                    Text <span class="symbol required"></span> 
                </label>
                <div class="summernote"></div>
                <textarea class="form-control no-display" id="text" name="data[News][text]" cols="10" rows="10"></textarea>          
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
            <button class="btn btn-yellow btn-block" type="submit"> Sačuvaj vijest <i class="fa fa-arrow-circle-right"></i> </button>
        </div>    
    </div>
    <div class="selected-products"></div>
</form>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-body alert alert-success" style="margin-bottom:0">
        <i class="fa fa-check-circle"></i>
        <strong>Uspješno ste dodali vijest!</strong> Molimo izaberite vaš sledeći korak.
    </div>
    <div class="modal-footer" style="margin-top:0">       
        <button type="button" data-dismiss="modal" onClick="window.location.href = '<?php echo $this->Html->url(array('controller' => 'news', 'action' => 'index')) ?>';" class="btn btn-default">Pregled vijesti</button> 
        <button type="button" data-dismiss="modal" onClick="window.location.href = '<?php echo $this->Html->url(array('controller' => 'news', 'action' => 'images')) ?>';" class="btn btn-primary">Dodajte slike za ovu vijest</button>
        <button type="button" data-dismiss="modal" onClick="window.location.href = '<?php echo $this->Html->url(array('controller' => 'news', 'action' => 'add')) ?>';" class="btn btn-primary">Kreiraj novu</button>
    </div>
</div>

<div id="choose-products-modal" data-width="760" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header" style="margin-bottom:0">
        Odaberite proizvode
    </div>
    <div class="modal-body" style="margin-bottom:0; overflow: auto;">
    </div>
    <div class="modal-footer" style="margin-top:0">       
        <button type="button" data-dismiss="modal" class="btn btn-default"> Odustani </button>
        <button id="sacuvajproizvode" type="button" data-dismiss="modal" class="btn btn-primary"> Sačuvaj </button>
    </div>
</div>