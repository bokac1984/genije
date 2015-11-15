<?php 
$root = $this->Html->link('Lokacije', array('controller' => 'locations', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled' );

$this->assign('title', 'Lokacije');
$this->assign('page-title', 'Lokacije <small>pregled lokacija</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/bootbox/bootbox.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/jquery-mockjax/jquery.mockjax', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/select2/select2.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/DataTables/media/js/jquery.dataTables.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/DataTables/media/js/DT_bootstrap', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/js/table-data', array('block'=>'scriptBottom'));
?>
<!--<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-filter"></i>
        Filter lokacija
        <div class="panel-tools">
            <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group"> 
                    <label class="control-label">
                        Grad
                    </label>
                    <select id="filter-3" class="form-control">
                        <option value="">Svi gradovi</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">
                        Status
                    </label>
                    <select id="filter-7" class="form-control">
                        <option value="">Sve</option>
                        <option value="0">Offline</option>
                        <option value="1">Pending</option>
                        <option value="2">Online</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>-->
<?php
echo $this->DataTable->render('Location', array('class' => 'table table-hover dataTable'));

echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));
echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("$.fn.editable.defaults.mode = 'popup';", array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/x-editable/lokacije', array('block' => 'scriptBottom'));
?>
<!-- DIALOG -->
<div class="modal fade" id="dialog-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Brisanje lokacije</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">
                    Odustani
                </button>
                <button id="dialogDelete" class="btn btn-bricky" data-dismiss="modal">
                    Obriši
                </button>
            </div>
        </div>
    </div>
</div>