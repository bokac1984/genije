<?php
// some logic here
?>
<ul class="main-navigation-menu">
    <li>
        <a href="index.html"><i class="clip-home-3"></i>
            <span class="title"> Dashboard </span><span class="selected"></span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="clip-location"></i>
            <span class="title"> Lokacije </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Lista Lokacija", array('plugin' => null, 'controller' => 'locations', 'action' => 'index')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Nova lokacija", array('plugin' => null, 'controller' => 'locations', 'action' => 'add')); ?>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="clip-calendar"></i>
            <span class="title"> Događaji </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Novi događaj", array('plugin' => null, 'controller' => 'events', 'action' => 'add')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Lista događaja", array('plugin' => null, 'controller' => 'events', 'action' => 'index')); ?>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="clip-users"></i>
            <span class="title"> Korisnici </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link("Mapa korisnika", array('plugin' => null, 'controller' => 'application_users', 'action' => 'pregled')); ?>
            </li>
            <li>
                <?php echo $this->Html->link("Lista korisnika", array('plugin' => null, 'controller' => 'application_users', 'action' => 'index')); ?>
            </li>            
        </ul>
    </li>
<!--    <li>
        <a href="javascript:void(0)"><i class="clip-pencil"></i>
            <span class="title"> Forms </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="form_elements.html">
                    <span class="title">Form Elements</span>
                </a>
            </li>
            <li>
                <a href="form_wizard.html">
                    <span class="title">Form Wizard</span>
                </a>
            </li>
            <li>
                <a href="form_validation.html">
                    <span class="title">Form Validation</span>
                </a>
            </li>
            <li>
                <a href="form_inline.html">
                    <span class="title">Inline Editor</span>
                </a>
            </li>
            <li>
                <a href="form_x_editable.html">
                    <span class="title">Form X-editable</span>
                </a>
            </li>
            <li>
                <a href="form_image_cropping.html">
                    <span class="title">Image Cropping</span>
                </a>
            </li>
            <li>
                <a href="form_multiple_upload.html">
                    <span class="title">Multiple File Upload</span>
                </a>
            </li>
            <li>
                <a href="form_dropzone.html">
                    <span class="title">Dropzone File Upload</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="clip-user-2"></i>
            <span class="title">Login</span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="login_example1.html">
                    <span class="title">Login Form Example 1</span>
                </a>
            </li>
            <li>
                <a href="login_example2.html">
                    <span class="title">Login Form Example 2</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="active open">
        <a href="javascript:void(0)"><i class="clip-file"></i>
            <span class="title">Pages</span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="pages_user_profile.html">
                    <span class="title">User Profile</span>
                </a>
            </li>
            <li>
                <a href="pages_invoice.html">
                    <span class="title">Invoice</span>
                    <span class="badge badge-new">new</span>
                </a>
            </li>								
            <li>
                <a href="pages_gallery.html">
                    <span class="title">Gallery</span>
                </a>
            </li>
            <li>
                <a href="pages_timeline.html">
                    <span class="title">Timeline</span>
                </a>
            </li>
            <li>
                <a href="pages_calendar.html">
                    <span class="title">Calendar</span>
                </a>
            </li>
            <li>
                <a href="pages_messages.html">
                    <span class="title">Messages</span>
                </a>
            </li>
            <li class="active">
                <a href="pages_blank_page.html">
                    <span class="title">Blank Page</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="clip-attachment-2"></i>
            <span class="title">Utility</span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="utility_faq.html">
                    <span class="title">Faq</span>
                </a>
            </li>
            <li>
                <a href="utility_search_result.html">
                    <span class="title">Search Results </span>
                    <span class="badge badge-new">new</span>
                </a>
            </li>								
            <li>
                <a href="utility_lock_screen.html">
                    <span class="title">Lock Screen</span>
                </a>
            </li>
            <li>
                <a href="utility_404_example1.html">
                    <span class="title">Error 404 Example 1</span>
                </a>
            </li>
            <li>
                <a href="utility_404_example2.html">
                    <span class="title">Error 404 Example 2</span>
                </a>
            </li>
            <li>
                <a href="utility_404_example3.html">
                    <span class="title">Error 404 Example 3</span>
                </a>
            </li>
            <li>
                <a href="utility_500_example1.html">
                    <span class="title">Error 500 Example 1</span>
                </a>
            </li>
            <li>
                <a href="utility_500_example2.html">
                    <span class="title">Error 500 Example 2</span>
                </a>
            </li>
            <li>
                <a href="utility_pricing_table.html">
                    <span class="title">Pricing Table</span>
                </a>
            </li>
            <li>
                <a href="utility_coming_soon.html">
                    <span class="title">Cooming Soon</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="active">
            <i class="clip-folder"></i>
            <span class="title"> 3 Level Menu </span>
            <i class="icon-arrow"></i>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="javascript:;">
                    Item 1 <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 2
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 3
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    Item 1 <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    Item 3
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;">
            <i class="clip-folder-open"></i>
            <span class="title"> 4 Level Menu </span><i class="icon-arrow"></i>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="javascript:;">
                    Item 1 <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;">
                            Sample Link 1 <i class="icon-arrow"></i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="#"><i class="fa fa-times"></i>
                                    Sample Link 1</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pencil"></i>
                                    Sample Link 1</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-edit"></i>
                                    Sample Link 1</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 2
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 3
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    Item 2 <i class="icon-arrow"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sample Link 1
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    Item 3
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="maps.html"><i class="clip-location"></i>
            <span class="title">Maps</span>
            <span class="selected"></span>
        </a>
    </li>
    <li>
        <a href="charts.html"><i class="clip-bars"></i>
            <span class="title">Charts</span>
            <span class="selected"></span>
        </a>
    </li>-->
</ul>