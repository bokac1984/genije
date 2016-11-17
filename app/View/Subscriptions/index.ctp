<div class="subscriptions index">
    <h2><?php echo __('Subscriptions'); ?></h2>
    <table class="table table-condensed" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('additional_data', 'Dodatni podaci'); ?></th>
                <th><?php echo $this->Paginator->sort('start_date', 'Početak'); ?></th>
                <th><?php echo $this->Paginator->sort('end_date', 'Kraj'); ?></th>
                <th><?php echo $this->Paginator->sort('admin_users_id', 'Korisnik'); ?></th>
                <th><?php echo $this->Paginator->sort('plans_id', 'Plan'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscriptions as $subscription): ?>
                <tr>
                    <td><?php echo h($subscription['Subscription']['additional_data']); ?>&nbsp;</td>
                    <td><?php echo h($subscription['Subscription']['start_date']); ?>&nbsp;</td>
                    <td><?php echo h($subscription['Subscription']['end_date']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($subscription['User']['first_name'], array('controller' => 'users', 'action' => 'overview', $subscription['User']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($subscription['Plan']['name'], array('controller' => 'plans', 'action' => 'view', $subscription['Plan']['id'])); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $subscription['Subscription']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $subscription['Subscription']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $subscription['Subscription']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $subscription['Subscription']['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->element('pagination'); ?>
</div>

