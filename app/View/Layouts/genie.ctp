<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            Urban Genie - <?php echo $this->fetch('title'); ?>
        </title>
        <!-- start: MAIN CSS -->
        <?php
        echo $this->fetch('meta');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('/assets/fonts/style');
        echo $this->Html->css('main');
        echo $this->Html->css('main-responsive');
        echo $this->Html->css('/assets/plugins/iCheck/skins/all');
        echo $this->Html->css('bootstrap-colorpalette');
        echo $this->Html->css('perfect-scrollbar');
        echo $this->Html->css('theme_light', array('id' => 'skin_color'));
        echo $this->Html->css('print', array('media' => 'print'));
        echo '<!--[if IE 7]>';
        echo $this->Html->css('/assets/plugins/font-awesome/css/font-awesome-ie7.min');
        echo '<![endif]-->';

        echo $this->Html->script('/js/jQuery-lib/2.0.3/jquery.min');
        ?>
        <!-- Pocetak css posebno za ovu stranicu -->
        <?php
        echo $this->fetch('css');
        ?>
        <!-- Kraj css posebno za ovu stranicu -->
        <?php        
        echo $this->Html->meta(
            'favicon.ico',
            '/favicon.ico',
            array('type' => 'icon')
        );
        ?>
        <style>

        </style>
        <!-- end: MAIN CSS -->
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body>
        <!-- start: HEADER -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <!-- start: TOP NAVIGATION CONTAINER -->
            <div class="container">
                <div class="navbar-header">
                    <!-- start: RESPONSIVE MENU TOGGLER -->
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>
                    <!-- end: RESPONSIVE MENU TOGGLER -->
                    <!-- start: LOGO -->
                    <a class="navbar-brand" href="<?php echo $this->Html->url('/'); ?>" style="padding: 0;">
                        <?php echo $this->Html->image('logo_login.png', array('alt' => 'Logo', 'height' => '46px')); ?>
                    </a>
                    <!-- end: LOGO -->
                </div>
                <div class="navbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->
                    <?php echo $this->element('userMenu'); ?>
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- end: TOP NAVIGATION CONTAINER -->
        </div>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <div class="navbar-content">
                <!-- start: SIDEBAR -->
                <div class="main-navigation navbar-collapse collapse">
                    <!-- start: MAIN MENU TOGGLER BUTTON -->
                    <div class="navigation-toggler">
                        <i class="clip-chevron-left"></i>
                        <i class="clip-chevron-right"></i>
                    </div>
                    <!-- end: MAIN MENU TOGGLER BUTTON -->
                    <!-- start: MAIN NAVIGATION MENU -->
                        <?php echo $this->element('menu'); ?>
                    <!-- end: MAIN NAVIGATION MENU -->
                </div>
                <!-- end: SIDEBAR -->
            </div>
            <!-- start: PAGE -->
            <div class="main-content">
                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- start: PAGE TITLE & BREADCRUMB -->
                            <?php
                            //echo $this->Html->getCrumbs(' / ', 'Početna');
                            
                            ?>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="clip-<?php echo $this->fetch('breadcrumb-icon') ? $this->fetch('breadcrumb-icon') : 'file'; ?>"></i>
                                    <a href="#">
                                        <?php echo $this->fetch('page-breadcrumbroot'); ?>
                                    </a>
                                </li>
                                <li class="active">
                                    <?php echo $this->fetch('crumb'); ?>
                                </li>
                            </ol>
                            <div class="page-header">
                                <h1><?php echo $this->fetch('page-title'); ?></h1>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <?php
                    echo $this->Session->flash('auth');
                    echo $this->Session->flash();

                    echo $this->fetch('content');
                    ?>
                    <!-- end: PAGE CONTENT-->
                </div>
            </div>
            <!-- end: PAGE -->
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <div class="footer clearfix">
            <div class="footer-inner">
                <?php echo date('Y') ?> &copy; Urban Genie.
            </div>
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
        <!-- end: FOOTER -->
        <!-- start: RIGHT SIDEBAR -->

        <!-- end: RIGHT SIDEBAR -->
        <!-- start: MAIN JAVASCRIPTS -->
        <?php
        echo $this->Html->script('/js/libs/jquery-ui/jquery-ui-1.10.2.custom.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('bootstrap-hover-dropdown.min');
        echo $this->Html->script('jquery.blockUI');
        echo $this->Html->script('jquery.icheck.min');
        echo $this->Html->script('jquery.mousewheel');
        echo $this->Html->script('perfect-scrollbar');
        echo $this->Html->script('less-1.5.0.min');
        echo $this->Html->script('jquery.cookie');
        echo $this->Html->script('bootstrap-colorpalette');
        echo $this->Html->script('main');
        echo '<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->';
        echo $this->fetch('scriptBottom');
        echo '<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->';
        echo $this->fetch('dataTableSettings');
        //echo $this->fetch('script');
        ?>
        <!-- end: MAIN JAVASCRIPTS -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
            });
        </script>
        <?php //echo $this->element('sql_dump'); ?>
    </body>
    <!-- end: BODY -->
</html>
