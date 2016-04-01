<?php
$root = $this->Html->link('Baneri', array('controller' => 'banners', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled banera');

$this->assign('title', 'Baneri');
$this->assign('page-title', 'Baneri <small>pregled podataka</small>');

echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));

echo $this->Html->script('/js/banners/index', array('block' => 'scriptBottom'));
?>
<div class="banners row">
    <div class="col-md-12">
    <table cellpadding="0" cellspacing="0" class="table table-condensed">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                <th><?php echo $this->Paginator->sort('title', 'Naslov'); ?></th>
                <th><?php echo $this->Paginator->sort('lid', 'Lid'); ?></th>
                <th><?php echo $this->Paginator->sort('link'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('status'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($banners as $banner): ?>
                <tr>
                    <td><?php echo h($banner['Banner']['id']); ?>&nbsp;</td>
                    <td><?php echo h($banner['Banner']['title']); ?>&nbsp;</td>
                    <td><?php echo h($banner['Banner']['lid']); ?>&nbsp;</td>
                    <td><?php echo h($banner['Banner']['link']); ?>&nbsp;</td>
                    <td><?php echo h($banner['Banner']['created']); ?>&nbsp;</td>
                    <td><?php echo $this->MyHtml->bannerStatus($banner['Banner']['status'], $banner['Banner']['id'], '/banners/changeStatus/'); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $banner['Banner']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $banner['Banner']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $banner['Banner']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $banner['Banner']['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-12">
        <?php echo $this->element('pagination'); ?>
    </div>
</div>
