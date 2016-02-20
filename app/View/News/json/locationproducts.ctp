<?php 
//debug($products); exit();   
$i = 1;
?>

<div class="row">
    <?php foreach ($products as $product) : ?>
        <?php
        if ($i % 7 == 0) {echo '</div><div class="row">';}
        $file = WWW_ROOT . "/photos/products/" . $product['Product']['img_name'];
        if (file_exists($file)):
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="grid-item wrap-image" data-id="<?php echo $product['Product']['id']; ?>" data-name="<?php echo $product['Product']['name']; ?>">
                    <a href="#">
                        <div class="grid-image">
                            <img src="/photos/products/<?php echo $product['Product']['img_name']; ?>" class="img-responsive"/>
                        </div>
                        <div class="grid-content">
                            <?php echo $product['Product']['name']; ?>
                        </div>
                    </a>
                    <div class="chkbox"></div>
                </div>
            </div>    
        <?php endif; $i++;?>
    <?php 
    endforeach; ?>
</div>