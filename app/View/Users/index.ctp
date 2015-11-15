<div class="users index">
    <div class="row">
        <div class="col-xs-3 col-sm-3">
            <div class="well sidebar-nav">
                <ul class="nav">
                    <li>Actions</li>
                    <li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
                    <li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
                </ul>
            </div><!--/.well -->
        </div><!--/span-->
        <div class="col-xs-9 col-sm-9">
            <h2><?php echo __('Users'); ?></h2>
            <table class="table table-bordered table-hover users-table" cellpadding="0" cellspacing="0">
                <tr>                  
                    <th><?php echo $this->Paginator->sort('group_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('username'); ?></th>
                    <th><?php echo $this->Paginator->sort('first_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('last_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('email'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th><?php echo $this->Paginator->sort('is_active'); ?></th>
                    <th><?php echo $this->Paginator->sort('is_banned'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?php echo $this->Html->link($user['Group']['group_name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
                        </td>
                        <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                        <td><?php echo $this->Time->format('F jS, Y h:i A', $user['User']['created']); ?>&nbsp;</td>
                        <td><?php echo $this->Time->format('F jS, Y h:i A', $user['User']['modified']); ?>&nbsp;</td>
                        <td><?php echo ($user['User']['is_active']) ? "Yes" : "No"; ?>&nbsp;</td>
                        <td><?php echo ($user['User']['is_banned']) ? "Yes" : "No"; ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Link->cLink(__(''), array('action' => 'view', $user['User']['id']), 'eye-open'); ?>
                            <?php echo $this->Link->cLink(__(''), array('action' => 'edit', $user['User']['id']), 'edit'); ?>
                            <?php echo $this->Link->dLink("", array('action' => 'delete', $user['User']['id']), 'trash', $user['User']['id']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table> 
        </div>
    </div>

    <?php echo $this->element('pagination'); ?>
</div>

