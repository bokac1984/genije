<div class="addons index">
    <h2><?php echo __('Addons'); ?></h2>
    <table class="table table-condensed" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('duration'); ?></th>
                <th><?php echo $this->Paginator->sort('quantity'); ?></th>
                <th><?php echo $this->Paginator->sort('price'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($addons as $addon): ?>
                <tr>
                    <td><?php echo h($addon['Addon']['id']); ?>&nbsp;</td>
                    <td><?php echo h($addon['Addon']['name']); ?>&nbsp;</td>
                    <td><?php echo h($addon['Addon']['duration']); ?>&nbsp;</td>
                    <td><?php echo h($addon['Addon']['quantity']); ?>&nbsp;</td>
                    <td><?php echo h($addon['Addon']['price']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $addon['Addon']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $addon['Addon']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $addon['Addon']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $addon['Addon']['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element('pagination'); ?>
</div>

