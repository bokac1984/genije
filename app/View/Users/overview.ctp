<?php
//debug($this->request->data);
$this->assign('page-breadcrumbroot', $this->Html->link('Korisnici', array('controller' => 'users', 'action' => 'index')));
$this->assign('crumb', 'Pregled profila');

$this->assign('title', 'Korisnici');
$this->assign('page-title', $this->request->data['User']['fullname'] . ' <small>pregled profila</small>');

echo $this->Html->script('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery.pulsate/jquery.pulsate.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/iCheck/jquery.icheck.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/admins/overview', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("UsersOverview.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-social-buttons/social-buttons-3', array('block' => 'css'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/iCheck/skins/square/green', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));

// sredi sliku da prikaze
$slika = '/photos-profiles/default.jpg';
if (!empty($this->request->data['User']['img'])) {
    $slika = '/photos-profiles/' . $this->request->data['User']['img'];
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="tabbable">
            <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                <li class="active">
                    <a data-toggle="tab" href="#panel_overview">
                        Pregled
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#panel_edit_account">
                        Uredi Nalog
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#panel_locations">
                        Lokacije
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#panel_subscriptions">
                        Pretplata
                    </a>
                </li>                
            </ul>
            <div class="tab-content">
                <div id="panel_overview" class="tab-pane in active">
                    <div class="row">
                        <div class="col-sm-5 col-md-4">
                            <div class="user-left">
                                <div class="center">
                                    <h4><?php echo $this->request->data['User']['fullname'] ?></h4>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="user-image">
                                            <div class="fileupload-new thumbnail">
                                                <img src="<?php echo $slika;?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Contact Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>url</td>
                                            <td>
                                                <a href="#">
                                                    www.example.com
                                                </a></td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>email:</td>
                                            <td>
                                                <a href="">
                                                    peter@example.com
                                                </a></td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>phone:</td>
                                            <td>(641)-734-4763</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>skye</td>
                                            <td>
                                                <a href="">
                                                    peterclark82
                                                </a></td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">General information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Position</td>
                                            <td>UI Designer</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Last Logged In</td>
                                            <td>56 min</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>Senior Marketing Manager</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Supervisor</td>
                                            <td>
                                                <a href="#">
                                                    Kenneth Ross
                                                </a></td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td><span class="label label-sm label-info">Administrator</span></td>
                                            <td>
                                                <a href="#panel_edit_account" class="show-tab">
                                                    <i class="fa fa-pencil edit-user-info"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Additional information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Birth</td>
                                            <td>21 October 1982</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Groups</td>
                                            <td>New company web site development, HR Management</td>
                                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-7 col-md-8">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas convallis porta purus, pulvinar mattis nulla tempus ut. Curabitur quis dui orci. Ut nisi dolor, dignissim a aliquet quis, vulputate id dui. Proin ultrices ultrices ligula, dictum varius turpis faucibus non. Curabitur faucibus ultrices nunc, nec aliquet leo tempor cursus.
                            </p>
                            <div class="row">
                                <div class="col-sm-3">
                                    <button class="btn btn-icon btn-block">
                                        <i class="clip-clip"></i>
                                        Projects <span class="badge badge-info"> 4 </span>
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-icon btn-block pulsate">
                                        <i class="clip-bubble-2"></i>
                                        Messages <span class="badge badge-info"> 23 </span>
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-icon btn-block">
                                        <i class="clip-calendar"></i>
                                        Calendar <span class="badge badge-info"> 5 </span>
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-icon btn-block">
                                        <i class="clip-list-3"></i>
                                        Notifications <span class="badge badge-info"> 9 </span>
                                    </button>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <i class="clip-menu"></i>
                                    Recent Activities
                                    <div class="panel-tools">
                                        <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                        </a>
                                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <a class="btn btn-xs btn-link panel-refresh" href="#">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                        <a class="btn btn-xs btn-link panel-close" href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body panel-scroll" style="height:300px">
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <i class="clip-checkmark-2"></i>
                                    To Do
                                    <div class="panel-tools">
                                        <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                        </a>
                                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <a class="btn btn-xs btn-link panel-refresh" href="#">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                        <a class="btn btn-xs btn-link panel-close" href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body panel-scroll" style="height:300px">
                                    <ul class="todo">
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-warning"> tommorow</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc">Staff Meeting</span>
                                                <span class="label label-warning"> tommorow</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> New frontend layout</span>
                                                <span class="label label-success"> this week</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-success"> this week</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> New frontend layout</span>
                                                <span class="label label-info"> this month</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-info"> this month</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-warning"> tommorow</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->element('editing', array('slika' => $slika)); ?>
                <div id="panel_locations" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                            <button id="dodijeli-lokaciju" class="btn btn-green btn-sm">Dodijeli lokaciju <i class="fa fa-arrow-circle-right"></i></button>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="rezultati">
                                <?php if (!empty($location)) {
                                    echo "Lokacija {$location['Location']['name']} je povezana";
                                }
                                ?>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div id="panel_subscriptions" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                            <button id="btn-subscribe" class="btn btn-green btn-sm">Odaberi tip pretplate <i class="fa fa-arrow-circle-right"></i></button>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="odabrani-planovi">
                                <p>Ispod je prikaz odabranog plana</p>
                                <div class="plan">
                                    <?php echo $this->element('user_subscriptions', array('subscription' => $subscription)); ?>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
    </div>
</div>
<!-- DIALOG -->
<div id="assign-location" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false" style="display: none;">
   <div class="modal-body" style="margin-bottom:0">
       <div class="row">
           <div class="col-md-12">
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
       </div>
       <div class="row">
           <div class="col-md-12">
            <div class="form-group">
                <label for="control-label">
                    Lokacija
                </label>
                <select id="map_object" name="data[News][fk_id_map_objects]" class="form-control search-select">
                    <option selected="selected" value=""></option>
                </select>
                
            </div>
           </div>
           <input type="hidden" class="user-id" value="<?php echo $this->request->data['User']['id']; ?>" >
       </div>       
   </div>
   <div class="modal-footer" style="margin-top:0">       
       <button id="btn-dialog-save" class="btn btn-green" data-dismiss="modal">
           <i class="fa fa-check"></i> Sačuvaj
       </button>
       <button id="btn-dialog-dismiss" class="btn btn-bricky" data-dismiss="modal">
           Odustani
       </button>       
   </div>
</div>

<!-- DIALOG Subscription -->
<div id="subscription" class="modal-overflow modal fade" tabindex="-1" data-width="760" 
     data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
        <input type="hidden" class="sub-user-id" value="<?php echo $this->request->data['User']['id']; ?>" >
        <h4 class="modal-title">Planovi pretplate</h4>
    </div>
   <div class="modal-body" style="margin-bottom:0">
       <div class="rezultati-sub"></div>
       <div class="error-sub"></div>
   </div>
   <div class="modal-footer" style="margin-top:0">       
       <button id="btn-dialog-save-subs" class="btn btn-green">
           <i class="fa fa-check"></i> Sačuvaj
       </button>
       <button id="btn-dialog-dismiss-subs" class="btn btn-bricky" data-dismiss="modal">
           Odustani
       </button>       
   </div>
</div>

<!-- DIALOG renew Subscription -->
<div id="renew-subscription" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
        <input type="hidden" class="sub-user-id" value="" >
        <h4 class="modal-title">Promjeni plan</h4>
    </div>
   <div class="modal-body" style="margin-bottom:0">
       <div class="rezultati-sub"></div>
       <div class="error-sub"></div>
   </div>
   <div class="modal-footer" style="margin-top:0">       
       <button id="btn-dialog-save-subs" class="btn btn-green">
           <i class="fa fa-check"></i> Sačuvaj
       </button>
       <button id="btn-dialog-dismiss-subs" class="btn btn-bricky" data-dismiss="modal">
           Odustani
       </button>       
   </div>
</div>

<!-- DIALOG Cancel Subscription -->
<div id="cancel-subscription" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
        <input type="hidden" class="sub-user-id" value="" >
        <h4 class="modal-title">Prekini plan</h4>
    </div>
   <div class="modal-body" style="margin-bottom:0">
       <div class="row">
           <div class="hidden" id="subscription-id" data-id=""></div>
           <div class="col-md-12">
            <div class="form-group">
                <label for="control-label">
                    Razlog prekida
                </label>
                <select id="decline_reason" name="data[DeclineReason][id]" class="form-control select">
                    
                </select>
                
            </div>
           </div>
           <input type="hidden" class="user-id" value="<?php echo $this->request->data['User']['id']; ?>" >
       </div> 
       <div class="error-sub"></div>
   </div>
   <div class="modal-footer" style="margin-top:0">       
       <button id="btn-dialog-save-canceled-sub" class="btn btn-green">
           <i class="fa fa-check"></i> Sačuvaj
       </button>
       <button id="btn-dialog-dismiss-subs" class="btn btn-bricky" data-dismiss="modal">
           Odustani
       </button>       
   </div>
</div>