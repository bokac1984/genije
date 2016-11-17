<?php if (!empty($subscription)): ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">Plan</th>
            <th class="center">Početak</th>
            <th class="center">Kraj</th>
            <th class="center">Akcije</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($subscription as $plan): ?>
            <tr>           
                <td class="center"><?php echo $plan['Plan']['name'] ?></td>
                <td class="center">
                    <?php echo $this->Time->format($plan['Subscription']['start_date'], '%d.%m.%Y %H:%M %p') ?>&nbsp;
                </td>
                </td>
                <td class="center">
                    <?php echo $this->Time->format($plan['Subscription']['end_date'], '%d.%m.%Y %H:%M %p') ?>&nbsp;
                </td>
                <td class="center">
                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                            <?php echo $this->Html->link('<i class="fa fa-edit"></i>', 
                                    '#',
                                    array(
                                        'id' => 'changesub',
                                        'class' => 'btn btn-xs btn-teal tooltips btn-edit',
                                        'data-placement' => 'top',
                                        'data-original-title' => 'Uredi',
                                        'escape' => false
                                    )
                                ); ?>
                            <?php echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 
                                    '#',
                                    array(
                                        'id' => 'cancelsub',
                                        'class' => 'btn btn-xs btn-bricky tooltips btn-delete',
                                        'data-placement' => 'top',
                                        'data-original-title' => 'Prekini',
                                        'data-id' => $plan['Subscription']['id'],
                                        'escape' => false
                                    )
                                ); ?>
                        </div>                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>Nemate unesenih pretplate!</p>
<?php endif; ?>