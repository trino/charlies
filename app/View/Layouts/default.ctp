<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php
        $restdata = $this->requestAction('/pages/getLocations');

        $generic = $this->requestAction('/pages/getGeneric');
        if (ucfirst($this->params['action']) == 'Index') {
            $gtitle = 'Home';
        } else
            $gtitle = ucfirst($this->params['action']);
    ?>
    <meta property="og:image" content="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $this->webroot . 'images/logo.png'; ?>"/>
    <meta property="og:title" content="<?php if (isset($title)) {
        echo $title . " - Charilie's Chopsticks";
    } else {
        echo str_replace('_', ' ', $gtitle) . ' - ' . $generic['title'];
    } ?>"/>
    <meta property="og:type" content="website"/>
    <meta name="description" content="<?php if (isset($description)) {
        echo $description;
    } else {
        echo $generic['description'];
    } ?>">

    <meta name="keywords" content="<?php if (isset($keyword)) {
        echo $keyword;
    } else {
        echo $generic['keyword'];
    } ?>">
    <link rel="icon" type="image/ico" href="<?php echo $this->webroot; ?>images/favicon.png"/>

    <title><?php if (isset($title)) {
            echo $title . " - Charilie's Chopsticks";
        } else {
            echo str_replace('_', ' ', $gtitle) . ' - ' . $generic['title'];
        } ?></title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $this->webroot; ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/global/plugins/font-awesome/css/font-awesome.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap/css/bootstrap.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/global/plugins/uniform/css/uniform.default.css"
          rel="stylesheet" type="text/css"/>
    <link
        href="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
        rel="stylesheet"
        type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link
        href="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"
        rel="stylesheet"
        type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/global/plugins/fullcalendar/fullcalendar.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="<?php echo $this->webroot; ?>profile/assets/admin/pages/css/tasks.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo $this->webroot; ?>profile/assets/global/css/components.css" id="style_components"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/admin/layout/css/layout.css" rel="stylesheet"
          type="text/css"/>
    <link id="style_color" href="<?php echo $this->webroot; ?>profile/assets/admin/layout/css/themes/darkblue.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->webroot; ?>profile/assets/admin/layout/css/custom.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $this->webroot; ?>css/timepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/>
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>lightSlider/css/lightSlider.css"/>

    <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/styles.css"/>

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <!--[if lt IE 9]>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/respond.min.js"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery-migrate.min.js"
            type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap/js/bootstrap.min.js"
            type="text/javascript"></script>
    <script
        src="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery.blockui.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery.cokie.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/uniform/jquery.uniform.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
            type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js"
            type="text/javascript"></script>
    <script
        src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js"
        type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/flot/jquery.flot.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/flot/jquery.flot.resize.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/flot/jquery.flot.categories.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery.pulsate.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap-daterangepicker/moment.min.js"
            type="text/javascript"></script>
    <script
        src="<?php echo $this->webroot; ?>profile/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/fullcalendar/fullcalendar.min.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/global/plugins/jquery.sparkline.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo $this->webroot; ?>profile/assets/global/scripts/metronic.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/admin/layout/scripts/layout.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/admin/layout/scripts/quick-sidebar.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/admin/layout/scripts/demo.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/admin/pages/scripts/index.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>profile/assets/admin/pages/scripts/tasks.js"
            type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>scripts/jqueryui/my_new.js" type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>scripts/jqueryui/my2_new.js" type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>scripts/upload.js" type="text/javascript"></script>
    <script src="<?php echo $this->webroot; ?>scripts/timepicker.js" type="text/javascript"></script>

    <script src="<?php echo $this->webroot; ?>lightSlider/js/jquery.lightSlider.js"></script>


    <script type="text/javascript">var switchTo5x = true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({
            publisher: "d062983e-e7fe-4c6c-a80c-c04d91d98519",
            doNotHash: false,
            doNotCopy: false,
            hashAddressBar: false
        });</script>


    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function () {
            //Metronic.init(); // init metronic core components
            //Layout.init(); // init current layout
            //QuickSidebar.init(); // init quick sidebar
            //Demo.init(); // init demo features // initlayout and core plugins
            //Index.init();
            //Index.initJQVMAP(); // init index page's custom scripts
            // Index.initCalendar(); // init index page's custom scripts
            //Index.initCharts(); // init index page's custom scripts
            //Index.initChat();
            //Index.initMiniCharts();
            //Index.initDashboardDaterange();
            //Tasks.initDashboardWidget();
        });
    </script>
    <!-- END JAVASCRIPTS -->

</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-full-width">


<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo $this->webroot; ?>">
                <h4 style="color:white;padding-top:7px;"><?= $generic["title"]; ?> <span style="color:#d64635;">Beta</span></h4>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN HORIZANTAL MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
        <div class="hor-menu hidden-sm hidden-xs">
            <ul class="nav navbar-nav">
                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                <li class="classic-menu-dropdown <?php if ($this->here == $this->webroot) echo "active"; ?>">
                    <a href="<?php echo $this->webroot; ?>">
                        Order Online <span class="selected">
					</span>
                    </a>
                </li>

                <li class="mega-menu-dropdown mega-menu-full <?php if ($this->params['action'] == "menu") echo "active"; ?>">
                    <a href="<?php echo $this->webroot; ?>pages/menu" class="dropdown-toggle"
                       data-hover="megamenu-dropdown"
                       data-close-others="true">
                        Flyer  <span class="selected">
					</span>
                    </a>

                </li>

                <li class="mega-menu-dropdown mega-menu-full <?php if ($this->params['action'] == "about") echo "active"; ?>">
                    <a href="<?php echo $this->webroot; ?>pages/about" class="dropdown-toggle"
                       data-hover="megamenu-dropdown"
                       data-close-others="true">
                        About CC  <span class="selected">
					</span>
                    </a>

                </li>

                <li class="mega-menu-dropdown mega-menu-full <?php if ($this->params['action'] == "contact") echo "active"; ?>">
                    <a href="<?php echo $this->webroot; ?>pages/contact" class="dropdown-toggle"
                       data-hover="megamenu-dropdown"
                       data-close-others="true">
                        Contact & Locations  <span class="selected">
					</span>
                    </a>

                </li>


            </ul>
        </div>
        <!-- END HORIZANTAL MENU -->
        <!-- BEGIN HEADER SEARCH BOX -->
        <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->

        <!-- END HEADER SEARCH BOX -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->

        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <?php
                    if (!$this->Session->read('restaurant')) {
                        ?>

                        <!--<li><a href="#registerModal" role="button" data-toggle="modal">Register</a></li>-->
                        <li class="dropdown dropdown-user"><a href="#loginModal" role="button" data-toggle="modal"><span
                                    class="username username-hide-on-mobile">Login</span></a></li>
                    <?php
                    }
                    if ($this->Session->read('restaurant')) {
                        ?>
                        <li><a href="<?php echo $this->webroot; ?>restaurants/dashboard">Dashboard</a></li>
                        <li><a href="<?php echo $this->webroot; ?>restaurants/logout">Logout</a></li>
                    <?php } ?>

                <!--<li class="dropdown dropdown-user">
                    <a href="#loginModal" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
					<span class="username username-hide-on-mobile">
					Login </span>
                    </a>

                </li>-->

                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- Modal register-->
    <div class="modal  fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content  center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3><span class="light">Register</span> to <?= $generic["title"]; ?></h3>
                    <hr class="divider">
                </div>
                <div class="modal-body">
                    <form action="<?php echo $this->webroot; ?>restaurants/register" method="post" class="push-down-15"
                          id="registerform">

                        <div class="form-group">
                            <input type="text" id="name" class="form-control  form-control--contact" name="name"
                                   placeholder="Restaurant Title" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" class="form-control  form-control--contact" name="email"
                                   placeholder="Email" value="" required>

                            <div id="emailerror" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password1" class="form-control  form-control--contact"
                                   name="password" value="" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password2" class="form-control  form-control--contact"
                                   name="cpassword" value="" placeholder="Confirm Password" required>

                            <div id="confirmerror" style="display: none;"></div>
                        </div>

                        <a href="javascript:void(0);" class="btn  btn-primary" id="registerbtn">REGISTER</a><input
                            type="submit" id="submitregister" style="display: none;"/>
                    </form>
                    <a data-toggle="modal" role="button" href="#loginModal" data-dismiss="modal">Already Registered?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal login-->
    <div style="width: 35%;margin: 0 auto;" class="modal  fade" id="loginModal" tabindex="-1" role="dialog"
         aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content  center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3><span class="light">Login</span> to <?= $generic["title"]; ?></h3>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $this->webroot; ?>restaurants/login" id="loginform" class="push-down-15"
                          method="post">
                        <div class="form-group">
                            <input type="text" id="username" name="username" class="form-control  form-control--contact"
                                   placeholder="Email">

                            <div id="usererror" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password"
                                   class="form-control  form-control--contact" placeholder="Password">

                            <div id="passerror" style="display: none;"></div>
                        </div>
                        <button type="button" class="btn  btn-primary loginbtn">SIGN IN</button>

                        <div id="formerror" style="display: none;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- END HEADER INNER -->
</div>

<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN HORIZONTAL RESPONSIVE MENU -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu" data-slide-speed="200" data-auto-scroll="true">
                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                <!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
                <li class="sidebar-search-wrapper">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                    <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                    <form class="sidebar-search sidebar-search-bordered" action="extra_search.html" method="POST">
                        <a href="javascript:;" class="remove">
                            <i class="icon-close"></i>
                        </a>

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<button class="btn submit"><i class="icon-magnifier"></i></button>
							</span>
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <li class="active">
                    <a href="index.html">
                        Dashboard <span class="selected">
					</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Mega <span class="arrow">
					</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                Layouts <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li class="active">
                                    <a href="layout_horizontal_sidebar_menu.html">
                                        Horizontal & Sidebar Menu </a>
                                </li>
                                <li>
                                    <a href="index_horizontal_menu.html">
                                        Dashboard & Mega Menu </a>
                                </li>
                                <li>
                                    <a href="layout_horizontal_menu1.html">
                                        Horizontal Mega Menu 1 </a>
                                </li>
                                <li>
                                    <a href="layout_horizontal_menu2.html">
                                        Horizontal Mega Menu 2 </a>
                                </li>
                                <li>
                                    <a href="layout_fontawesome_icons.html">
                                        <span class="badge badge-roundless badge-danger">new</span>Layout with
                                        Fontawesome Icons</a>
                                </li>
                                <li>
                                    <a href="layout_glyphicons.html">
                                        Layout with Glyphicon</a>
                                </li>
                                <li>
                                    <a href="layout_full_height_portlet.html">
                                        <span class="badge badge-roundless badge-success">new</span>Full Height Portlet</a>
                                </li>
                                <li>
                                    <a href="layout_full_height_content.html">
                                        <span class="badge badge-roundless badge-warning">new</span>Full Height Content</a>
                                </li>
                                <li>
                                    <a href="layout_search_on_header1.html">
                                        Search Box On Header 1 </a>
                                </li>
                                <li>
                                    <a href="layout_search_on_header2.html">
                                        Search Box On Header 2 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_search_option1.html">
                                        Sidebar Search Option 1 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_search_option2.html">
                                        Sidebar Search Option 2 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_reversed.html">
									<span class="badge badge-roundless badge-warning">
									new </span>
                                        Right Sidebar Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_fixed.html">
                                        Sidebar Fixed Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_closed.html">
                                        Sidebar Closed Page </a>
                                </li>
                                <li>
                                    <a href="layout_ajax.html">
                                        Content Loading via Ajax </a>
                                </li>
                                <li>
                                    <a href="layout_disabled_menu.html">
                                        Disabled Menu Links </a>
                                </li>
                                <li>
                                    <a href="layout_blank_page.html">
                                        Blank Page </a>
                                </li>
                                <li>
                                    <a href="layout_boxed_page.html">
                                        Boxed Page </a>
                                </li>
                                <li>
                                    <a href="layout_language_bar.html">
                                        Language Switch Bar </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                More Layouts <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="layout_sidebar_search_option1.html">
                                        Sidebar Search Option 1 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_search_option2.html">
                                        Sidebar Search Option 2 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_reversed.html">
									<span class="badge badge-roundless badge-success">
									new </span>
                                        Right Sidebar Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_fixed.html">
                                        Sidebar Fixed Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_closed.html">
                                        Sidebar Closed Page </a>
                                </li>
                                <li>
                                    <a href="layout_ajax.html">
                                        Content Loading via Ajax </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                Even More <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="layout_disabled_menu.html">
                                        Disabled Menu Links </a>
                                </li>
                                <li>
                                    <a href="layout_blank_page.html">
                                        Blank Page </a>
                                </li>
                                <li>
                                    <a href="layout_boxed_page.html">
                                        Boxed Page </a>
                                </li>
                                <li>
                                    <a href="layout_language_bar.html">
                                        Language Switch Bar </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        Full Mega <span class="arrow">
					</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                Layouts <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="index_horizontal_menu.html">
                                        Dashboard & Mega Menu </a>
                                </li>
                                <li>
                                    <a href="layout_horizontal_sidebar_menu.html">
                                        Horizontal & Sidebar Menu </a>
                                </li>
                                <li>
                                    <a href="layout_horizontal_menu1.html">
                                        Horizontal Mega Menu 1 </a>
                                </li>
                                <li>
                                    <a href="layout_horizontal_menu2.html">
                                        Horizontal Mega Menu 2 </a>
                                </li>
                                <li>
                                    <a href="layout_search_on_header1.html">
                                        Search Box On Header 1 </a>
                                </li>
                                <li>
                                    <a href="layout_search_on_header2.html">
                                        Search Box On Header 2 </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                More Layouts <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="layout_sidebar_search_option1.html">
                                        Sidebar Search Option 1 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_search_option2.html">
                                        Sidebar Search Option 2 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_reversed.html">
									<span class="badge badge-roundless badge-success">
									new </span>
                                        Right Sidebar Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_fixed.html">
                                        Sidebar Fixed Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_closed.html">
                                        Sidebar Closed Page </a>
                                </li>
                                <li>
                                    <a href="layout_ajax.html">
                                        Content Loading via Ajax </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                Even More <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="layout_disabled_menu.html">
                                        Disabled Menu Links </a>
                                </li>
                                <li>
                                    <a href="layout_blank_page.html">
                                        Blank Page </a>
                                </li>
                                <li>
                                    <a href="layout_boxed_page.html">
                                        Boxed Page </a>
                                </li>
                                <li>
                                    <a href="layout_language_bar.html">
                                        Language Switch Bar </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                Accordions <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <div id="accordion2" class="panel-group mega-menu-responsive-content">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion2"
                                                       href="#collapseOne2" class="collapsed">
                                                        Mega Menu Info #1 </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne2" class="panel-collapse in">
                                                <div class="panel-body">
                                                    Metronic Mega Menu Works for fixed and responsive layout and has the
                                                    facility to include (almost) any Bootstrap elements.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion2"
                                                       href="#collapseTwo2" class="collapsed">
                                                        Mega Menu Info #2 </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Metronic Mega Menu Works for fixed and responsive layout and has the
                                                    facility to include (almost) any Bootstrap elements.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion2"
                                                       href="#collapseThree2">
                                                        Mega Menu Info #3 </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Metronic Mega Menu Works for fixed and responsive layout and has the
                                                    facility to include (almost) any Bootstrap elements.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>
                        Classic <span class="arrow">
					</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-bookmark-o"></i> Section 1 </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i> Section 2 </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-puzzle-piece"></i> Section 3 </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-gift"></i> Section 4 </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-table"></i> Section 5 </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-envelope-o"></i> More options <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        Second level link </a>
                                </li>
                                <li class="sub-menu">
                                    <a href="javascript:;">
                                        More options <span class="arrow">
									</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="index.html">
                                                Third level link </a>
                                        </li>
                                        <li>
                                            <a href="index.html">
                                                Third level link </a>
                                        </li>
                                        <li>
                                            <a href="index.html">
                                                Third level link </a>
                                        </li>
                                        <li>
                                            <a href="index.html">
                                                Third level link </a>
                                        </li>
                                        <li>
                                            <a href="index.html">
                                                Third level link </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="index.html">
                                        Second level link </a>
                                </li>
                                <li>
                                    <a href="index.html">
                                        Second level link </a>
                                </li>
                                <li>
                                    <a href="index.html">
                                        Second level link </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END HORIZONTAL RESPONSIVE MENU -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN STYLE CUSTOMIZER -->

            <!-- END STYLE CUSTOMIZER -->
            <!-- BEGIN PAGE HEADER-->


            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS -->

            <!-- END DASHBOARD STATS -->
            <div class="clearfix">
            </div>


            <?php
                $test = false;
                $test = $this->Session->flash();

                if ($test)
                {
            ?>
            <div class="alert  alert-success  uppercase  fade  in flash">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="color: #FFF;opacity:1;">x
                </button>
                <?php
                    }
                    echo '<center>' . $test . '</center>'; ?>
                <?php
                    if ($test)
                    {
                ?>
            </div>
        <?php }
        ?>
            <?php echo $this->fetch('content'); ?>





            <!-- END QUICK SIDEBAR -->
        </div>


        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer" style="height: 40px;background:#333;border-top:6px solid #007FC5;">
            <div class="page-footer-inner">
                2015 &copy; <?= $generic["title"]; ?> / Developed by <a href="http://trinoweb.com">Trino Web</a>
            </div>
            <div style="float: right;">
                <a class="footer__link--small" href="https://goo.gl/maps/dgDT3">Find Us On Google Maps</a>
            </div>
            <div class="scroll-to-top">

                <i class="icon-arrow-up"></i>
            </div>
        </div>


        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->

</body>
<!-- END BODY -->
</html>