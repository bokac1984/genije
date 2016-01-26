<?php
$root = $this->Html->link('Vijesti', array('controller' => 'news', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled vijesti');

$this->assign('title', 'Vijesti');
$this->assign('page-title', 'Vijesti <small>pregled</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/js/libs/flexslider/jquery.flexslider', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/news/view', array('block' => 'scriptBottom'));

echo $this->Html->scriptBlock("ViewDefaults.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('news-view', array('block' => 'css'));
echo $this->Html->css('/js/libs/flexslider/flexslider', array('block' => 'css'));

//debug($news);
?>
<!-- Odavde ide proba -->
    <div class="portfolio-title">
        <div class="row">
            <div class="col-md-12 center">
                <h2 class="shorter"><?php echo $this->MyHtml->displayEmpty($news['News']['title']); ?></h2>
            </div>
        </div>
    </div>
    <hr class="tall">
    <div class="row vijest">
<!--        <div class="col-sm-6">
            <div class="flexslider" data-plugin-options="{&quot;controlNav&quot;:false,&quot;sync&quot;: &quot;#carousel&quot;}">
                <ul class="slides">
                    <li>
                        <a class="group1" href="/assets/images/image01.jpg" title="Caption here">
                            <img src="/assets/images/image01.jpg">

                        </a>
                    </li>
                    <li>
                        <a class="group1" href="/assets/images/image02.jpg" title="Caption here">
                            <img src="/assets/images/image02.jpg">

                        </a>
                    </li>
                    <li>
                        <a class="group1" href="/assets/images/image03.jpg" title="Caption here">
                            <img src="/assets/images/image03.jpg">

                        </a>
                    </li>
                    <li>
                        <a class="group1" href="/assets/images/image04.jpg" title="Caption here">
                            <img src="/assets/images/image04.jpg">

                        </a>
                    </li>
                    <li>
                        <a class="group1" href="/images/image05.jpg" title="Caption here">
                            <img src="/assets/images/image05.jpg">

                        </a>
                    </li>
                </ul>
            </div>
<div id="carousel" class="flexslider animate-group" data-plugin-options="{&quot;itemWidth&quot;: 120, &quot;itemMargin&quot;: 5}">
        <ul class="slides">
                <li>
                        <img src="/assets/images/image01.jpg" class="animate" data-animation-options="{&quot;animation&quot;:&quot;fadeIn&quot;, &quot;duration&quot;:&quot;600&quot;}" style="opacity: 1; animation-fill-mode: both; animation-duration: 1.2s; animation-delay: 0s; animation-name: fadeIn;">
                </li>
                <li>
                        <img src="/assets/images/image02.jpg" class="animate" data-animation-options="{&quot;animation&quot;:&quot;fadeIn&quot;, &quot;duration&quot;:&quot;600&quot;}" style="opacity: 1; animation-fill-mode: both; animation-duration: 1.2s; animation-delay: 0s; animation-name: fadeIn;">
                </li>
                <li>
                        <img src="/assets/images/image03.jpg" class="animate" data-animation-options="{&quot;animation&quot;:&quot;fadeIn&quot;, &quot;duration&quot;:&quot;600&quot;}" style="opacity: 1; animation-fill-mode: both; animation-duration: 1.2s; animation-delay: 0s; animation-name: fadeIn;">
                </li>
                <li>
                        <img src="/assets/images/image04.jpg" class="animate" data-animation-options="{&quot;animation&quot;:&quot;fadeIn&quot;, &quot;duration&quot;:&quot;600&quot;}" style="opacity: 1; animation-fill-mode: both; animation-duration: 1.2s; animation-delay: 0s; animation-name: fadeIn;">
                </li>
                <li>
                        <img src="/assets/images/image05.jpg" class="animate" data-animation-options="{&quot;animation&quot;:&quot;fadeIn&quot;, &quot;duration&quot;:&quot;600&quot;}" style="opacity: 1; animation-fill-mode: both; animation-duration: 1.2s; animation-delay: 0s; animation-name: fadeIn;">
                </li>
        </ul>
</div>
</div>        -->
        <div class="col-md-6">
            <?php if (!empty($news['Gallery'])): ?>
            <div class="flexslider" data-plugin-options="{&quot;directionNav&quot;:true}">
                <ul class="slides">
                    <?php foreach($news['Gallery'] as $image): ?>
                    <li>
                        <img src="/photos/news/<?php echo $image['img_name'] ?>">
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php else: ?>
            <div style="margin-left: 14em; margin-top: 11em;"><a href="/news/images/<?php echo $news['News']['id']; ?>" class="btn btn-teal ladda-button" style="margin-top: 20px;">Dodajte fotografije</a></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="portfolio-info">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pull-right">
                            <li>
                                <i class="fa fa-calendar"></i> <?php echo $this->Time->format($news['News']['modified_date'], '%d.%m.%Y %H:%M %p'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h4>Kratki uvod (lid)</h4>
            <p class="taller">
                <?php echo $this->MyHtml->displayEmpty($news['News']['lid'], 'Nema lid'); ?>
            </p>
            <h4>Tekst</h4>
            <p class="taller">
                <?php echo $this->MyHtml->displayEmpty($news['News']['text'], 'Nema teksta'); ?>
            </p>            
            <span data-appear-animation-delay="800" data-appear-animation="rotateInUpLeft" class="arrow hlb appear-animation rotateInUpLeft appear-animation-visible" style="animation-delay: 800ms;"></span>
            <ul class="portfolio-details list-unstyled">
                <li>
                    <p>
                        <h4>Satus:</h4> <?php echo $this->MyHtml->displayStatus($news['News']['online_status']); ?>
                    </p>
                </li>
                <li>
                    <h4>Lokacija:</h4> <?php echo $this->MyHtml->emptyLink(
                            $news['Location']['id'], 
                            $news['Location']['name'],
                            array(
                                'controller' => 'locations',
                                'action' => 'view'
                            ), 
                            'Nije vezana za lokaciju'); ?>
                </li>
                <li>
                    <h4>Događaj:</h4> <?php echo $this->MyHtml->emptyLink(
                            $news['Event']['id'], 
                            $news['Event']['name'],
                            array(
                                'controller' => 'events',
                                'action' => 'view'
                            ), 
                            'Nije vezana za događaj'); ?>
                </li>              
                <li>
                    <p>
                    <h4>Prikaži proizvode:</h4> <?php echo $this->MyHtml->showProducts($news['News']['show_products']); ?>
                    </p>
                </li>
            </ul>
        </div>
    </div>