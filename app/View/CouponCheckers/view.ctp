<?php
$root = $this->Html->link('Ponistavanje kodova', array('controller' => 'coupon_checkers', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled korisnika');

$this->assign('title', 'Ponistavaci');
$this->assign('page-title', 'Ponistavaci <small>pregled podataka</small>');

echo $this->Html->css('news-view', array('block' => 'css'));

$code = str_split($couponChecker['CouponCheckerLogin']['activation_code'], 4);

//debug($couponChecker);
?>
<div class="row vijest">
    <div class="col-md-6">
        <h4>Datum kreiranja</h4>
        <div class="portfolio-info">
            <div class="row">
                <div class="col-md-12">
                    <ul class="pull-left">
                        <li>
                            <i class="fa fa-calendar"></i> 
                            <?php echo $this->Time->format($couponChecker['CouponChecker']['creation_date'], '%d.%m.%Y %H:%M %p'); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h4>Korisničko ime</h4>
        <p class="taller">
            <?php echo h($couponChecker['CouponChecker']['username']); ?>
        </p>
        <h4>Puno ime</h4>
        <p class="taller">
            <?php echo $this->MyHtml->displayEmpty($couponChecker['CouponChecker']['full_name']); ?>
        </p>  
        <span data-appear-animation-delay="800" data-appear-animation="rotateInUpLeft" 
              class="arrow hlb appear-animation rotateInUpLeft appear-animation-visible" 
              style="animation-delay: 800ms;">
        </span>
        <ul class="portfolio-details list-unstyled">
            <li>
                <p>
                <h4>Satus:</h4> <?php echo $this->MyHtml->displayCouponCheckerStatus($couponChecker['CouponCheckerLogin']['activation_code']); ?>
                </p>
            </li>
            <?php if ($couponChecker['CouponCheckerLogin']['activation_code']): ?>
                <li>
                    <h4>Aktivacioni kod:</h4> 
                    <?php
                    foreach ($code as $digits) {
                        echo "<span class=\"cifre\">$digits &nbsp;</span>";
                    }
                    ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="col-md-6">
        <h4>Pripada lokaciji</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail" style="max-width: 400px; margin-bottom:0px;">
                <?php
                echo $this->Html->link($this->Html->image('/photos/'. $couponChecker['Location']['img_url']),
                        array(
                            'controller' => 'locations',
                            'action' => 'view',
                            $couponChecker['Location']['id']
                        ),
                        array(
                            'title' => $couponChecker['Location']['name'],
                            'escape' => false
                        ));
                ?>
                </div>
            </div>
        </div>
    </div>    
</div>