<?php //debug($products); exit(); ?>
<?php if ($products): ?>   
<table class="table table-condensed">
    <thead>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cijena</th>
        <th>Datum kreiranja</th>
        <th>Akcije</th>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['Product']['name']; ?>&nbsp;</td>
            <td><?php echo $product['Product']['description']; ?></td>
            <td><?php echo $product['Product']['price']; ?>&nbsp;</td>
            <td><?php echo $this->Time->format($product['Product']['created'], '%d.%m.%Y %H:%M %p'); ?></td>
            <td><?php echo $this->Html->link('Detalji', array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <h4>Nema proizvoda za ovu lokaciju</h4>
<?php endif;