<?php
$url = $this->request->here;
?>
<ul class="main-navigation-menu">
    <li>
        <a href="/dashboards"><i class="clip-home-3"></i>
            <span class="title"> Dashboard </span><span class="selected"></span>
        </a>
    </li>
    <li class="<?php echo (preg_match("/\/locations|\/location_comments/", $url))? 'active' : ''?>">
        <a href="javascript:;">
            <i class="clip-location"></i>
            <span class="title"> Lokacije </span>
            <i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Pregled Lokacija", array('plugin' => null, 'controller' => 'locations', 'action' => 'index')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Nova lokacija", array('plugin' => null, 'controller' => 'locations', 'action' => 'add')); ?>
            </li>            
            <li class="<?php echo (preg_match("/\/location_comments/", $url))? 'active' : ''?>">
                <a href="javascript:;">
                    Komentari <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <?php echo $this->Html->link("Pregled komentara", array('plugin' => null, 'controller' => 'location_comments', 'action' => 'index')); ?>
                    </li>
                </ul>
            </li>
            <li class="<?php echo (preg_match("/\/location_comments/", $url))? 'active' : ''?>">
                <a href="javascript:;">
                    QR poništavači <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <?php echo $this->Html->link("Dodaj novog", array('plugin' => null, 'controller' => 'coupon_checkers', 'action' => 'add')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link("Pregled svih", array('plugin' => null, 'controller' => 'coupon_checkers', 'action' => 'index')); ?>
                    </li>                    
                </ul>
            </li>              
        </ul>
    </li>    
    <li class="<?php echo (preg_match("/\/events/", $url))? 'active' : ''?>">
        <a href="javascript:void(0)"><i class="clip-calendar"></i>
            <span class="title"> Događaji </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Novi događaj", array('plugin' => null, 'controller' => 'events', 'action' => 'add')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Pregled događaja", array('plugin' => null, 'controller' => 'events', 'action' => 'index')); ?>
            </li>
        </ul>
    </li>
    <li class="<?php echo (preg_match("/\/news/", $url))? 'active' : ''?>">
        <a href="javascript:void(0)"><i class="clip-note"></i>
            <span class="title"> Vijesti </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li class="<?php echo (preg_match("/\/news\/add/", $url))? 'active' : ''?>">
                <?php echo $this->Html->link("Nova vijest", array('plugin' => null, 'controller' => 'news', 'action' => 'add')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Pregled vijesti", array('plugin' => null, 'controller' => 'news', 'action' => 'index')); ?>
            </li>            
        </ul>
    </li>
    <li class="<?php echo (preg_match("/\/products/", $url))? 'active' : ''?>">
        <a href="javascript:void(0)"><i class="fa clip-cart"></i>
            <span class="title"> Proizvodi </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Novi proizvod", array('plugin' => null, 'controller' => 'products', 'action' => 'add')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Lista proizvoda", array('plugin' => null, 'controller' => 'products', 'action' => 'index')); ?>
            </li>            
        </ul>
    </li>
    <li class="<?php echo (preg_match("/\/tickets/", $url))? 'active' : ''?>">
        <a href="javascript:void(0)"><i class="fa fa-ticket"></i>
            <span class="title"> Kuponi </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Kreiraj", array('plugin' => null, 'controller' => 'coupons', 'action' => 'add')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Pregledaj", array('plugin' => null, 'controller' => 'coupons', 'action' => 'index')); ?>
            </li>            
        </ul>
    </li>
    <li class="<?php echo (preg_match("/\/notifications/", $url))? 'active' : ''?>">
        <a href="javascript:void(0)"><i class="fa clip-notification"></i>
            <span class="title"> Obaviještenja </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Novo obavještenje", array('plugin' => null, 'controller' => 'notifications', 'action' => 'add')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Pregled svih", array('plugin' => null, 'controller' => 'notifications', 'action' => 'index')); ?>
            </li>            
        </ul>
    </li>     
    <li class="">
        <a href="javascript:;">
            <i class="clip-cog-2"></i>
            <span class="title"> Šifarnici </span>
            <i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li class="<?php echo (preg_match("/\/location_comments/", $url))? 'active' : ''?>">
                <a href="javascript:;">
                    Gradovi <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <?php echo $this->Html->link("Pregled gradova", array('plugin' => null, 'controller' => 'cities', 'action' => 'index')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link("Novi grad", array('plugin' => null, 'controller' => 'cities', 'action' => 'add')); ?>
                    </li>
                </ul>
            </li>
            <li class="<?php echo (preg_match("/\/banners/", $url))? 'active' : ''?>">
                <a href="javascript:;">
                    Baneri <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <?php echo $this->Html->link("Dodaj novi", array('plugin' => null, 'controller' => 'banners', 'action' => 'add')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link("Pregled svih", array('plugin' => null, 'controller' => 'banners', 'action' => 'index')); ?>
                    </li>                    
                </ul>
            </li>             
        </ul>
    </li>
    <li class="<?php echo (preg_match("/\/application/", $url))? 'active' : ''?>">
        <a href="javascript:void(0)"><i class="clip-users"></i>
            <span class="title"> Korisnici </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Mapa korisnika", array('plugin' => null, 'controller' => 'application_users', 'action' => 'pregled')); ?>
            </li>
            <li class="<?php echo (preg_match("/\/application_users\/view/", $url))? 'active' : ''?>">
                <?php echo $this->Html->link("Pregled korisnika", array('plugin' => null, 'controller' => 'application_users', 'action' => 'index')); ?>
            </li>           
        </ul>
    </li>    
</ul>