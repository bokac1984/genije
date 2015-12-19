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
            <td><?php echo $comment['LocationComment']['text']; ?>&nbsp;</td>
            <td><span><?php echo $comment['LocationComment']['rating']; ?></span></td>
            <td><?php echo $comment['LocationComment']['comment_rating']; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($comment['ApplicationUser']['display_name'], array('controller' => 'application_users', 'action' => 'view', $comment['ApplicationUser']['id'])); ?>
            </td>
            <td><?php echo $this->Time->format($comment['LocationComment']['datetime'], '%d.%m.%Y %H:%M %p'); ?></td>
            <td><?php echo $this->Html->link('Detalji', array('controller' => 'location_comments', 'action' => 'view', $comment['LocationComment']['id'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div>
    Pogledaj još komentara za ovu lokaciju
</div>
<?php else: ?>
    <h4>Nema komentara za ovu lokaciju</h4>
<?php endif; ?>