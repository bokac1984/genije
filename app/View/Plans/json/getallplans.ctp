<?php if (!empty($plans)): ?>
<div class="row">
    <div class="col-md-12">
        <p>Odaberite jedan od ponuđenih planova pretplate:</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover" id="lista-planova">
            <thead>
                <tr>
                    <th class="center"></th>
                    <th class="center">Naziv</th>
                    <th class="center">Cijena</th>
                    <th class="center">Trajanje</th>
                    <th class="center">Količina objava</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plans as $plan): ?>
                    <tr>
                        <td class="center hidden-xs">
                            <div class="checkbox-table">
                                <label>
                                    <input type="radio" name="iCheck" value="<?php echo $plan['Plan']['id'] ?>" class="flat-green">
                                </label>
                            </div>
                        </td>            
                        <td class="center"><?php echo $plan['Plan']['name'] ?></td>
                        <td class="center"><?php echo $plan['Plan']['price'] ?> KM</td>
                        <td class="center"><?php echo $plan['Plan']['duration'] ?> mjesec</td>
                        <td class="">
                            <ul class="kolicina-objava">
                                <li>Vjesti: <?php echo $plan['Plan']['news_quantity'] ?></li>
                                <li>Slika na vijestima: <?php echo $plan['Plan']['news_images_quantity'] ?></li>
                                <li>Proizvoda: <?php echo $plan['Plan']['products_quantity'] ?></li>
                                <li>Slika na proizvodu: <?php echo $plan['Plan']['product_images_quantity'] ?></li>
                                <li>Slika na lokaciji: <?php echo $plan['Plan']['location_images_quantity'] ?></li>
                                <li>Kupona: <?php echo $plan['Plan']['coupon_quantity'] ?></li>                                
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<input type="hidden" name="selected-plan" value="-1">
<?php else: ?>
    <p>Nemate unesenih planova u bazu. Konataktirajte administratora!</p>
<?php endif; ?>


