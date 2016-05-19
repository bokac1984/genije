<?php if (!empty($subscription)): ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">Plan</th>
            <th class="center">Početak</th>
            <th class="center">Kraj</th>
            <th class="center">Količina objava</th>
            <th class="center">Cijena</th>
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
                <td class="center"><?php echo $plan['Plan']['quantity'] ?></td>
                <td class="center"><?php echo $plan['Plan']['price'] ?> KM</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>Nemate unesenih pretplate!</p>
<?php endif; ?>