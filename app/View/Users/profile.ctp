<?php
//
//debug($user);
$this->assign('page-breadcrumbroot', $this->Html->link('Korisnici', array('controller' => 'users', 'action' => 'index')));
$this->assign('crumb', 'Pregled profila');

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Korisnici <small>pregled profila</small>');

echo $this->Html->script('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery.pulsate/jquery.pulsate.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/admins/profile', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("PagesUserProfile.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-social-buttons/social-buttons-3', array('block' => 'css'));
$slika = '/photos-profiles/default.jpg';
if (!empty($user['User']['img'])) {
    $slika = '/photos-profiles/' . $user['User']['img'];
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
<!--                <li>
                    <a data-toggle="tab" href="#panel_projects">
                        Lokacije
                    </a>
                </li>-->
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
                                    <ul class="activities">
                                        <li>
                                            <a class="activity" href="javascript:void(0)">
                                                <i class="clip-upload-2 circle-icon circle-green"></i>
                                                <span class="desc">You uploaded a new release.</span>
                                                <div class="time">
                                                    <i class="fa fa-time bigger-110"></i>
                                                    2 hours ago
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="activity" href="javascript:void(0)">
                                                <img alt="image" src="assets/images/avatar-2.jpg">
                                                <span class="desc">Nicole Bell sent you a message.</span>
                                                <div class="time">
                                                    <i class="fa fa-time bigger-110"></i>
                                                    3 hours ago
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="activity" href="javascript:void(0)">
                                                <i class="clip-data circle-icon circle-bricky"></i>
                                                <span class="desc">DataBase Migration.</span>
                                                <div class="time">
                                                    <i class="fa fa-time bigger-110"></i>
                                                    5 hours ago
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="activity" href="javascript:void(0)">
                                                <i class="clip-clock circle-icon circle-teal"></i>
                                                <span class="desc">You added a new event to the calendar.</span>
                                                <div class="time">
                                                    <i class="fa fa-time bigger-110"></i>
                                                    8 hours ago
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="activity" href="javascript:void(0)">
                                                <i class="clip-images-2 circle-icon circle-green"></i>
                                                <span class="desc">Kenneth Ross uploaded new images.</span>
                                                <div class="time">
                                                    <i class="fa fa-time bigger-110"></i>
                                                    9 hours ago
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="activity" href="javascript:void(0)">
                                                <i class="clip-image circle-icon circle-green"></i>
                                                <span class="desc">Peter Clark uploaded a new image.</span>
                                                <div class="time">
                                                    <i class="fa fa-time bigger-110"></i>
                                                    12 hours ago
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
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
                <?php echo $this->element('editing'); ?>
<!--                <div id="panel_projects" class="tab-pane">
                    <table class="table table-striped table-bordered table-hover" id="projects">
                        <thead>
                            <tr>
                                <th class="center">
                        <div class="checkbox-table">
                            <label>
                                <input type="checkbox" class="flat-grey">
                            </label>
                        </div></th>
                        <th>Project Name</th>
                        <th class="hidden-xs">Client</th>
                        <th>Proj Comp</th>
                        <th class="hidden-xs">%Comp</th>
                        <th class="hidden-xs center">Priority</th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey">
                                        </label>
                                    </div></td>
                                <td>IT Help Desk</td>
                                <td class="hidden-xs">Master Company</td>
                                <td>11 november 2014</td>
                                <td class="hidden-xs">
                                    <div class="progress progress-striped active progress-sm">
                                        <div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="progress-bar progress-bar-warning">
                                            <span class="sr-only"> 70% Complete (danger)</span>
                                        </div>
                                    </div></td>
                                <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                        <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-share"></i> Share
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div></td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey">
                                        </label>
                                    </div></td>
                                <td>PM New Product Dev</td>
                                <td class="hidden-xs">Brand Company</td>
                                <td>12 june 2014</td>
                                <td class="hidden-xs">
                                    <div class="progress progress-striped active progress-sm">
                                        <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                            <span class="sr-only"> 40% Complete</span>
                                        </div>
                                    </div></td>
                                <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                        <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-share"></i> Share
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div></td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey">
                                        </label>
                                    </div></td>
                                <td>ClipTheme Web Site</td>
                                <td class="hidden-xs">Internal</td>
                                <td>11 november 2014</td>
                                <td class="hidden-xs">
                                    <div class="progress progress-striped active progress-sm">
                                        <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
                                            <span class="sr-only"> 90% Complete</span>
                                        </div>
                                    </div></td>
                                <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                        <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-share"></i> Share
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div></td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey">
                                        </label>
                                    </div></td>
                                <td>Local Ad</td>
                                <td class="hidden-xs">UI Fab</td>
                                <td>15 april 2014</td>
                                <td class="hidden-xs">
                                    <div class="progress progress-striped active progress-sm">
                                        <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
                                            <span class="sr-only"> 50% Complete</span>
                                        </div>
                                    </div></td>
                                <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                        <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-share"></i> Share
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div></td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey">
                                        </label>
                                    </div></td>
                                <td>Design new theme</td>
                                <td class="hidden-xs">Internal</td>
                                <td>2 october 2014</td>
                                <td class="hidden-xs">
                                    <div class="progress progress-striped active progress-sm">
                                        <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-success">
                                            <span class="sr-only"> 20% Complete (warning)</span>
                                        </div>
                                    </div></td>
                                <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                        <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-share"></i> Share
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div></td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            <input type="checkbox" class="flat-grey">
                                        </label>
                                    </div></td>
                                <td>IT Help Desk</td>
                                <td class="hidden-xs">Designer TM</td>
                                <td>6 december 2014</td>
                                <td class="hidden-xs">
                                    <div class="progress progress-striped active progress-sm">
                                        <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                            <span class="sr-only"> 40% Complete (warning)</span>
                                        </div>
                                    </div></td>
                                <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                        <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-share"></i> Share
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>-->
            </div>
        </div>
    </div>
</div>