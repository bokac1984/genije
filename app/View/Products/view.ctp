<?php
//debug($product);
$root = $this->Html->link('Proizvodi', array('controller' => 'products', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled proizvoda');
$this->assign('breadcrumb-icon', $icon);

$this->assign('title', 'Proizvodi');
$this->assign('page-title', 'Proizvodi <small>pregled podataka</small>');

echo $this->Html->script('/lightbox/js/lightbox', array('block' => 'scriptBottom'));

echo $this->Html->css('/lightbox/css/lightbox', array('block' => 'css'));
$mainImage = $product['Product']['img_name'];
?>
<div class="row">
    <div class="col-md-3">
        <dl>
            <dt><?php echo __('Naziv'); ?></dt>
            <dd>
                <?php echo h($product['Product']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Opis'); ?></dt>
            <dd>
                <?php echo h($product['Product']['description']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Labela'); ?></dt>
            <dd>
                <?php echo h($product['Product']['label']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Cijena'); ?></dt>
            <dd>
                <?php echo h($product['Product']['price']) . ' KM'; ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Lokacije sa ovim proizvodom'); ?></dt>
            <dd>
                <ul>
                    <?php foreach($product['Location'] as $location): ?>
                    <li><?php echo $this->Html->link($location['name'],
                            array(
                                'controller' => 'locations',
                                'action' => 'view',
                                $location['id']
                            )); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </dd>            
            <dt><?php echo __('Kreiran'); ?></dt>
            <dd>
                <?php echo $this->Time->format(h($product['Product']['created']), '%d.%m.%Y %H:%M %p');
                ; ?>
                &nbsp;
            </dd>
        </dl>
    </div>
    <div class="col-md-9">
        <?php if (!empty($product['ProductImage'])): ?>
        <div class="row galerija-slika">
            <?php foreach ($product['ProductImage'] as $currentImage) : ?>
            <?php 
            $file = WWW_ROOT . "/photos/products/" . $currentImage['img_name'];
            if (file_exists($file)): ?>
                <div class="col-md-2 col-sm-2 gallery-img">
                    <div class="wrap-image <?php if ($mainImage == $currentImage['img_name']) echo 'selected'; ?>">
                        <a data-lightbox="galerija" class="group1" href="/photos/products/<?php echo $currentImage['img_name']; ?>" pk="<?php echo $currentImage['fk_id_products']; ?>" title="<?php echo $currentImage['text']; ?>" data-id="<?php echo $currentImage['id']; ?>" data-jpg="<?php echo $currentImage['img_name']; ?>">
                            <img src="/photos/products/<?php echo $currentImage['img_name']; ?>"
                                 alt=""
                                 class="img-responsive <?php if ($mainImage == $currentImage['img_name']) echo 'selected'; ?>"
                                 >
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                Nema slika u galeriji ovog proizvoda
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <h3><?php echo __('Osobine proizvoda'); ?></h3>
<?php if (!empty($product['ProductFeature'])): ?>
            <table class="table" cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Naziv'); ?></th>
                    <th><?php echo __('Vrijednost'); ?></th>
                </tr>
    <?php foreach ($product['ProductFeature'] as $productFeature): ?>
                    <tr>
                        <td><?php echo $productFeature['title']; ?></td>
                        <td><?php echo $productFeature['value']; ?></td>
                    </tr>
            <?php endforeach; ?>
            </table>
<?php endif; ?>
    </div>
</div>

