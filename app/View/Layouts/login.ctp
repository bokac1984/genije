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

        echo $this->Html->css('/assets/plugins/bootstrap/css/bootstrap.min');
        echo $this->Html->css('/assets/plugins/font-awesome/css/font-awesome.min');
        echo $this->Html->css('/assets/fonts/style');
        echo $this->Html->css('/assets/css/main');
        echo $this->Html->css('/assets/css/main-responsive');
        echo $this->Html->css('/assets/plugins/iCheck/skins/all');
        echo $this->Html->css('/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette');
        echo $this->Html->css('/assets/plugins/perfect-scrollbar/src/perfect-scrollbar');
        echo $this->Html->css('/assets/css/theme_light', array('id' => 'skin_color'));
        echo $this->Html->css('/assets/css/print', array('media' => 'print'));
        echo '<!--[if IE 7]>';
        echo $this->Html->css('/assets/plugins/font-awesome/css/font-awesome-ie7.min');
        echo '<![endif]-->';

        echo $this->fetch('css');
        echo $this->Html->meta(
            'favicon.ico',
            '/favicon.ico',
            array('type' => 'icon')
        );
        ?>
        <style>.page-header h1 {font-weight: 500;}</style>
        <!-- end: MAIN CSS -->
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="login example1">
        <?php
        echo $this->fetch('content');
        ?>  
        <!-- start: MAIN JAVASCRIPTS -->
        <?php
        echo $this->Html->script('/assets/plugins/jQuery-lib/2.0.3/jquery.min');
        echo $this->Html->script('/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min');
        echo $this->Html->script('/assets/plugins/bootstrap/js/bootstrap.min');
        echo $this->Html->script('/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min');
        echo $this->Html->script('/assets/plugins/blockUI/jquery.blockUI');
        echo $this->Html->script('/assets/plugins/iCheck/jquery.icheck.min');
        echo $this->Html->script('/assets/plugins/perfect-scrollbar/src/jquery.mousewheel');
        echo $this->Html->script('/assets/plugins/perfect-scrollbar/src/perfect-scrollbar');
        echo $this->Html->script('/assets/plugins/less/less-1.5.0.min');
        echo $this->Html->script('/assets/plugins/jquery-cookie/jquery.cookie');
        echo $this->Html->script('/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette');
        echo $this->Html->script('/assets/js/main');
        echo '<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->';
        echo $this->fetch('scriptBottom');
        echo '<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->';
        ?>
        <!-- end: MAIN JAVASCRIPTS -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
                Login.init();
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>
