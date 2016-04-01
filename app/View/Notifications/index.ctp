<?php
$root = $this->Html->link('Notifikacije', array('controller' => 'notifications', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Prgled' );

$this->assign('title', 'Notifikacije');
$this->assign('page-title', 'Notifikacije <small>pregled podataka</small>');

$this->assign('breadcrumb-icon', $icon);
?>
<div class="notifications index">
    <table cellpadding="0" cellspacing="0" class="table table-condensed">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('title', 'Naslov'); ?></th>
                <th><?php echo $this->Paginator->sort('text', 'Text'); ?></th>
                <th><?php echo $this->Paginator->sort('date'); ?></th>
                <th><?php echo $this->Paginator->sort('ApplicationUser.id', 'Korisnik'); ?></th>
                <th><?php echo $this->Paginator->sort('status'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notifications as $notification): ?>
                <tr>
                    <td><?php echo h($notification['Notification']['id']); ?>&nbsp;</td>
                    <td><?php echo h($notification['Notification']['title']); ?>&nbsp;</td>
                    <td><?php echo h($notification['Notification']['text']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Time->format($notification['Notification']['date'], '%d.%m.%Y %H:%M %p'); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($notification['ApplicationUser']['display_name'], array('controller' => 'application_users', 'action' => 'view', $notification['ApplicationUser']['id']));  ?>&nbsp;</td>
                    <td><?php echo $this->MyHtml->displayStatusNotify($notification['Notification']['status']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $notification['Notification']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $notification['Notification']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $notification['Notification']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $notification['Notification']['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php echo $this->element('pagination'); ?>
</div>
