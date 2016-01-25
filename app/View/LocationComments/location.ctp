<?php
$root = $this->Html->link('Komentari', array('controller' => 'location_comments', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled kometara');

$this->assign('title', 'Komentari');
$this->assign('page-title', 'Komentari <small>pregled podataka</small>');

echo $this->Html->script('/js/libs/stars/star-rating', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/location_comments/location', array('block' => 'scriptBottom'));
echo $this->Html->css('/js/libs/stars/star-rating', array('block' => 'css'));
?>
<div class="row">
    <div class="col-md-12" id="content">
        <table class="table table-condensed">
            <thead>
            <th>Sadržaj</th>
            <th>Ocjena</th>
            <th>Rejting</th>
            <th>Korisnik</th>
            <th>Vrijeme</th>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?php echo $comment['LocationComment']['text'] ? $comment['LocationComment']['text'] : '<i class="no-comment">Nema komentara</i>'; ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Star->star($comment['LocationComment']['rating'], array('size' => 'xxxs')); ?>
                    </td>
                    <td><?php echo $comment['LocationComment']['comment_rating']; ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($comment['ApplicationUser']['display_name'], array('controller' => 'application_users', 'action' => 'view', $comment['ApplicationUser']['id'])); ?>
                    </td>
                    <td><?php echo $this->Time->format($comment['LocationComment']['datetime'], '%d.%m.%Y %H:%M %p'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <?php echo $this->element('ajaxPagination'); ?>
    </div>
</div>

<?php echo $this->Js->writeBuffer(); ?>