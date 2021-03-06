<?php
$url = $this->request->here;
$location = $loggedInUser['group_id'] !== '1' ? $loggedInUser['map_object_id'] : '';
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
                <?php echo $this->Html->link("Moja lokacija", array('plugin' => null, 'controller' => 'locations', 'action' => 'mine')); ?>
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
                <?php echo $this->Html->link("Novi događaj", array('plugin' => null, 
                    'controller' => 'events', 
                    'action' => 'add',
                    $location)); ?>
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
                <?php echo $this->Html->link("Nova vijest", array('plugin' => null, 'controller' => 'news', 'action' => 'add', $location)); ?>
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
                <?php 
                if ($loggedInUser !== '1') {
                    echo $this->Html->link("Novi proizvod", array(
                    'plugin' => null, 'controller' => 
                    'products', 'action' => 'add', $loggedInUsersLocation));
                } else {
                    echo $this->Html->link("Novi proizvod", array(
                        'plugin' => null, 'controller' => 
                        'products', 'action' => 'add')); 
                }                
                ?>
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
</ul>