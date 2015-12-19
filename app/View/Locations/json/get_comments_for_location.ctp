<?php //debug($comments); exit(); ?>
<?php if ($comments): ?>   
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
                <input class="stars" value="<?php echo $comment['LocationComment']['rating']; ?>" />
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
<div>
    <?php echo $this->Html->link('Svi komentari <i class="fa fa-arrow-circle-right"></i>', array(
        'controller' => 'location_comments',
        'action' => 'location',
        $comment['LocationComment']['fk_id_map_objects']
    
        ),
        array(
            'escape' => false,
            'class' => 'btn btn-green btn-sm'
        )
    ); ?>
</div>
<?php else: ?>
    <h4>Nema komentara za ovu lokaciju</h4>
<?php endif; ?>