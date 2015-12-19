<?php if ($events): ?>  
<table class="table table-condensed">
    <thead>
        <th>#</th>
        <th>Naslov</th>
        <th>Datum objave</th>
        <th>Akcije</th>
    </thead>
    <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
        <td><?php echo $event['Event']['id']; ?></td>
        <td><?php echo $event['Event']['name']; ?></td>
        <td><?php echo $this->Time->format($event['Event']['creation_date'], '%d.%m.%Y %H:%M %p'); ?></td>
        <td><?php echo $this->Html->link('Detalji', array('controller' => 'events', 'action' => 'view', $event['Event']['id'])); ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <h4>Nema događaja za ovu lokaciju</h4>
<?php endif; ?>