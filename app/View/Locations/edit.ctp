<?php
$root = $this->Html->link('Lokacije', array('controller' => 'locations', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Izmjena lokacije' );

$this->assign('title', $location['Location']['name']);
$this->assign('page-title', $location['Location']['name'] . ' <small>pregled lokacija</small>');

$this->assign('breadcrumb-icon', $icon);

define("PHONE", 1);
define("MOBILE", 2);
define("WEB", 3);
define("EMAIL", 4);
// load CSS
echo $this->Html->css('/assets/plugins/select2/select2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-datetimepicker/css/datetimepicker', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/typeaheadjs/lib/typeahead.js-bootstrap', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/jquery-address/address', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color', array('block' => 'css'));
echo $this->Html->css('/lightbox/css/lightbox', array('block' => 'css'));

// load JS
echo $this->Html->script('/assets/plugins/jquery-mockjax/jquery.mockjax', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/moment/moment', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/typeaheadjs/typeaheadjs', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-address/address', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jQuery-Knob/js/jquery.knob', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/wysihtml5/wysihtml5', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/ladda-bootstrap/dist/spin.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/ladda-bootstrap/dist/ladda.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/lightbox/js/lightbox', array('block' => 'scriptBottom'));

echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/gmaps/gmaps.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/js/maps.js', array('block' => 'scriptBottom'));

echo $this->Html->scriptBlock("$.fn.editable.defaults.mode = 'popup';$.fn.editable.defaults.send = \"always\";Maps.init();", array('block'=>'scriptBottom'));
echo $this->Html->script('/js/lokacije/locations-edit', array('block' => 'scriptBottom'));

//debug($location);
$contacts = $location['Contact'];
$city = $location['City'];
$description = $location['LocationDescription'][0];
$m = $location['MapObjectSubtypeRelation'];
$location = $location['Location'];
$idLocation = $location['id'];

$phone = $mobile = $web = $email = 'Empty';

foreach ($contacts as $contact) {
    if ($contact['fk_id_contact_types'] == PHONE) {
        $phone = $contact;
    }
    if ($contact['fk_id_contact_types'] == MOBILE) {
        $mobile = $contact;
    }
    if ($contact['fk_id_contact_types'] == WEB) {
        $web = $contact;
    }
    if ($contact['fk_id_contact_types'] == EMAIL) {
        $email = $contact;
    }
}

$idLocation = $location['id'];
?>
<div class="row">
    <div class='col-md-6'>
        <table id="user" class="table table-bordered table-striped" style="clear: both">
            <tbody>
                <tr>
                    <td class="column-left">
                        Naziv lokacije
                    </td>
                    <td class="column-right">
                        <a href="#" 
                           id="name" 
                           data-url="/locations/ajaxEdit" 
                           data-type="text" 
                           data-pk="<?php echo $idLocation; ?>" 
                           data-original-title="Unesite naziv lokacije">
                            <?php echo $location['name']; ?>
                        </a></td>
                </tr>
                <tr>
                    <td>Slika <br>
                    <?php echo $this->Html->link('Galerija', '/locations/gallery/' . $idLocation) ?>
                    </td>
                    <td>
                        <div class="thumbnail" style="max-width: 200px; margin-bottom:0px;">
                            <?php 
                            if ('' !== $location['img_url']) { ?>
                                <a data-lightbox="galerija" class="group1" 
                                   href="/photos/<?php echo $location['img_url']; ?>" 
                                   >
                                    <img src="/photos/<?php echo $location['img_url']; ?>" 
                                         alt="" 
                                         class="img-responsive"
                                         >
                                </a>
                            <?php
                            } else {
                                echo $this->Html->image('no-photo.png',
                                        array(
                                            'url' => array(
                                            'controller' => 'locations', 
                                            'action' => 'gallery', 
                                            $idLocation))
                                        );
                            }
                             ?> 
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Tip lokacije</td>
                    <td>
                        <a href="#" id="sub_types" data-value="<?php
                        $kk = '';
                        foreach ($m as $k => $v) {
                            $kk .= $v['fk_id_object_subtypes'].',';
                        }
                        echo rtrim($kk,',');
                        ?>" data-type="select2" data-pk="<?php echo $idLocation; ?>" data-original-title="Tip lokacije"></a>
                    </td>
                </tr>
                <tr>
                    <td>Lid</td>
                    <td>
                        <a href="#" 
                           id="lid" 
                           data-url="/locations/ajaxEdit" 
                           data-pk="<?php echo $idLocation; ?>" 
                           data-type="textarea" data-original-title="Unesite lid"><?php echo $location['lid']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Rejting lokacije</td>
                    <td>
                        <input id="admin_rating" data-pk="<?php echo $idLocation; ?>" 
                               class="knob" name="data[Location][admin_rating]" data-width="160" data-min="0" 
                               value="<?php echo $location['admin_rating'] ?>">
<!--                        <a class="knob" data-min="0"  
                            data-url="/locations/ajaxEdit" data-type="text" data-original-title="Unesite rejting">
                            <?php echo $location['admin_rating']; ?>
</a>-->
                    </td>
                </tr>
                <tr>
                    <td>Grad</td>
                    <td>
                        <a href="#" id="fk_id_cities" data-pk="<?php echo $idLocation; ?>" data-source="/locations/getCities" data-url="/locations/ajaxEdit" data-type="select" data-value="<?php echo $city['id']; ?>" data-title="Izaberite grad">
                            <?php echo $city['name']; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Adresa</td>
                    <td>
                        <a href="#" id="address" data-pk="<?php echo $idLocation; ?>" data-url="/locations/ajaxEdit" data-type="text" data-original-title="Adresa lokacije"><?php echo $location['address']; ?></a>
                    </td>
                </tr> 
                <tr>
                    <td>Tel. Fiksni</td>
                    <td>                       
                        <a href="#" 
                           id="contact_phone"  
                           data-tip="<?php echo PHONE ?>" 
                           data-url="/locations/updateContactInfo" 
                           data-pk="<?php echo $idLocation; ?>" 
                           data-original-title="Telefon Fiksni">
                            <?php echo isset($phone['value']) ? $phone['value'] : ""; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Tel. Mobilni</td>
                    <td>
                        <a href="#" 
                           id="contact_mobile"  
                           data-tip="<?php echo MOBILE ?>" 
                           data-url="/locations/updateContactInfo" 
                           data-type="text" 
                           data-pk="<?php echo $idLocation; ?>" 
                           data-original-title="Mobilni">
                            <?php echo isset($mobile['value']) ? $mobile['value'] : ""; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>
                        <a href="#" 
                           id="contact_email"  
                           data-tip="<?php echo EMAIL ?>" 
                           data-url="/locations/updateContactInfo" 
                           data-type="text" 
                           data-pk="<?php echo $idLocation; ?>" 
                           data-original-title="E-mail">
                               <?php echo isset($email['value']) ? $email['value'] : ""; ?>
                        </a>
                    </td>
                </tr> 
                <tr>
                    <td>Web</td>
                    <td>
                        <a href="#" 
                           id="contact_web" 
                           data-tip="<?php echo WEB?>" 
                           data-url="/locations/updateContactInfo" 
                           data-type="text" 
                           data-pk="<?php echo $idLocation; ?>" 
                           data-original-title="Web">
                               <?php echo isset($web['value']) ? $web['value'] : ""; ?>
                        </a>
                    </td>
                </tr>                           
                <tr>
                    <td>Detaljan info <a id="pencil" href="#"><i class="fa fa-pencil"></i> [uredi]</a>
                    <td>
                        <div data-original-title="Enter notes" 
                             data-url="/locations/updateDescription" 
                             data-toggle="manual" data-type="wysihtml5" 
                             data-pk="<?php echo $idLocation ?>" id="note" class="editable" tabindex="-1" style="display: block;">
                            <?php echo $description['html_text']; ?>
                        </div></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Pretraži novu lokaciju" id="address_geocode" name="address_geocode">
                <span class="input-group-btn">
                    <button class="btn btn-bricky" id="search_map" type="button"> Pretraži </button>
                    <button data-style="zoom-in" data-lokacija="<?php echo $idLocation; ?>" id="save-location" class="btn btn-primary ladda-button">
                        <span class="ladda-label"> Sačuvaj </span>
                        <span class="ladda-spinner"></span>
                        <div class="ladda-progress" style="width: 0px;"></div>
                    </button>
                </span> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="popin">
                    <div id="map5" class="map"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"> Geografska širina <span class="symbol required"></span> </label>
                    <input disabled="disabled" class="form-control tooltips" type="text" name="longitude" id="longitude" value="<?php echo $location['longitude']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"> Geografska dužina <span class="symbol required"></span> </label>
                    <input disabled="disabled" class="form-control tooltips" type="text" name="latitude" id="latitude" value="<?php echo $location['latitude']; ?>">
                </div>
            </div>
        </div>        
    </div>
</div>

