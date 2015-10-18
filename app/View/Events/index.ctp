<?php
$root = $this->Html->link('Događaji', array('controller' => 'events', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled' );

$this->assign('title', 'Događaji');
$this->assign('page-title', 'Događaji <small>izmjena događaja</small>');

echo $this->Html->script('/assets/plugins/bootbox/bootbox.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/jquery-mockjax/jquery.mockjax', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/select2/select2.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/DataTables/media/js/jquery.dataTables.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/DataTables/media/js/DT_bootstrap', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/js/table-data', array('block'=>'scriptBottom'));
echo $this->DataTable->render('Event', array('class' => 'table table-hover dataTable'));

echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));
echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("$.fn.editable.defaults.mode = 'popup';", array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/x-editable/lokacije', array('block' => 'scriptBottom'));
?>

<!--<table class="table table-hover" id="sample-table-1">
    <thead>
        <tr>
            <th width="5%" class="center">#</th>
            <th width="15%">Naziv</th>
            <th width="30%" class="hidden-xs">Lid</th>
            <th width="10%" class="center">Važi od</th>
            <th width="10%" class="center">Važi do</th>
            <th width="15%" class="center">Lokacija</th>
            <th width="10%" class="center">Status</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($events as $event): ?>
        <tr>
            <td class="center"><?php echo $event['Event']['id']; ?></td>
            <td><?php echo $event['Event']['name']; ?></td>
            <td><?php echo $event['Event']['lid']; ?></td>
            <td class="center"><?php echo $event['Event']['start_time']; ?></td>
            <td class="center"><?php echo $event['Event']['end_time']; ?></td>
            <td class="center"><?php echo $event['Location']['name']; ?></td>
            <td class="center">
            <?php 
            $status = array();
             if ($event['Event']['online_status'] == 0) {
                 $status = array(
                     'css' => 'label-danger',
                     'value' => 0,
                     'id' => $event['Event']['id'],
                     'text' => 'Offline'
                 );
             } else if ($event['Event']['online_status'] == 1) {
                 $status = array(
                     'css' => 'label-warning',
                     'value' => 1,
                     'id' => $event['Event']['id'],
                     'text' => 'Pending'
                 );
             } else {
                 $status = array(
                     'css' => 'label-success',
                     'value' => 0,
                     'id' => $event['Event']['id'],
                     'text' => 'Online'
                 );
             }
            ?>
            <a href="#" id="online_status" class="online-status label label-sm <?php echo $status['css'] ?> editable editable-click" data-pk="<?php echo $status['id'] ?>" data-value="<?php echo $status['value'] ?>" data-title="Izmjeni status"><?php echo $status['text'] ?></a>
            </td>
            <td class="center">
                <div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
                                    <i class="fa fa-times"></i> Remove
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>-->
