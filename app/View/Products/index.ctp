<?php
$root = $this->Html->link('Proizvodi', array('controller' => 'products', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled' );

$this->assign('title', 'Proizvodi');
$this->assign('page-title', 'Proizvodi <small>pregled proizvoda</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/bootbox/bootbox.min', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-mockjax/jquery.mockjax', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/DataTables/media/js/jquery.dataTables.min', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/DataTables/media/js/DT_bootstrap', array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/js/table-data', array('block'=>'scriptBottom'));

echo $this->DataTable->render('Product', array('class' => 'table table-hover dataTable'));

echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));
echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("$.fn.editable.defaults.mode = 'popup';", array('block'=>'scriptBottom'));
echo $this->Html->script('/assets/plugins/x-editable/lokacije', array('block' => 'scriptBottom'));
?>