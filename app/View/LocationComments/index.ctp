<?php 
$root = $this->Html->link('Komentari', array('controller' => 'location_comments', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled kometara');

$this->assign('title', 'Komentari');
$this->assign('page-title', 'Komentari <small>pregled podataka</small>');
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <table class="table" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('text'); ?></th>
                    <th><?php echo $this->Paginator->sort('rating', 'Ocjena'); ?></th>
                    <th><?php echo $this->Paginator->sort('datetime', 'Vrijeme'); ?></th>
                    <th><?php echo $this->Paginator->sort('comment_rating', 'Ocjena komentara'); ?></th>
                    <th><?php echo $this->Paginator->sort('fk_id_map_objects', 'Lokacija'); ?></th>
                    <th><?php echo $this->Paginator->sort('fk_id_users', 'Korisnik'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($LocationComments as $mapObjectsComment): ?>
                    <tr>
                        <td><?php echo h($mapObjectsComment['LocationComment']['id']); ?>&nbsp;</td>
                        <td><?php echo h($mapObjectsComment['LocationComment']['text']); ?>&nbsp;</td>
                        <td><?php echo h($mapObjectsComment['LocationComment']['rating']); ?>&nbsp;</td>
                        <td><?php echo h($mapObjectsComment['LocationComment']['datetime']); ?>&nbsp;</td>
                        <td><?php echo h($mapObjectsComment['LocationComment']['comment_rating']); ?>&nbsp;</td>
                        <td>
                            <?php echo $this->Html->link($mapObjectsComment['Location']['name'], array('controller' => 'locations', 'action' => 'view', $mapObjectsComment['Location']['id'])); ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link($mapObjectsComment['ApplicationUser']['display_name'], array('controller' => 'application_users', 'action' => 'view', $mapObjectsComment['ApplicationUser']['id'])); ?>
                        </td>
                        <td class="actions">
                            <?php //echo $this->Html->link(__('View'), array('action' => 'view', $mapObjectsComment['LocationComment']['id'])); ?>
                            <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $mapObjectsComment['LocationComment']['id'])); ?>
                            <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mapObjectsComment['LocationComment']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mapObjectsComment['LocationComment']['id']))); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>	</p>
        <div class="paging">
            <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
    </div>
</div>
