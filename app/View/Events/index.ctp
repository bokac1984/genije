<?php
$root = $this->Html->link('Događaji', array('controller' => 'events', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled' );

$this->assign('title', 'Događaji');
$this->assign('page-title', 'Događaji <small>izmjena događaja</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/bootbox/bootbox.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/jquery-mockjax/jquery.mockjax', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/select2/select2.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/DataTables/media/js/jquery.dataTables.min', array('block'=>'scriptBottom')); 
echo $this->Html->script('/assets/plugins/DataTables/media/js/DT_bootstrap', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/js/table-data', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("$.fn.editable.defaults.mode = 'popup';", array('block'=>'scriptBottom'));
echo $this->Html->script('/js/events/index', array('block' => 'scriptBottom'));

echo $this->DataTable->render('Event', array('class' => 'table table-hover dataTable'));

echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));

?>

<!-- DIALOG -->
<div class="modal fade" id="dialog-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Brisanje događaja</h4>
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