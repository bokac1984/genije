<?php
$root = $this->Html->link('Vijesti', array('controller' => 'news', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Istekla pretplata');

$this->assign('title', 'Vijesti');
$this->assign('page-title', 'Vijesti <small>istekla pretplata</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/jquery-validation/dist/jquery.validate.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/summernote/build/summernote.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min.js', array('block' => 'scriptBottom'));

echo $this->Html->script('/assets/plugins/nestable/jquery.nestable', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/js/ui-nestable', array('block' => 'scriptBottom'));

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
echo $this->Html->scriptBlock("FormValidator.init();UINestable.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/summernote/build/summernote.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal.css', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3', array('block' => 'css'));
echo $this->Html->css('grid', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch', array('block' => 'css'));
?>
Istekla pretplata