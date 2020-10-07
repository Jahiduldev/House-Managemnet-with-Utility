
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Automated Attendance</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo $base_url ?>public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $base_url ?>public/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo $base_url ?>public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo $base_url ?>public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo $base_url ?>public/css/owl.carousel.css" type="text/css">


        <!--dynamic table-->
        <link href="<?php echo $base_url ?>public/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
        <link href="<?php echo $base_url ?>public/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo $base_url ?>public/assets/data-tables/DT_bootstrap.css" />

        <!--right slidebar-->
        <link href="<?php echo $base_url ?>public/css/slidebars.css" rel="stylesheet">
        <!--datetime picker-->
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url ?>public/assets/bootstrap-datetimepicker/css/datetimepicker.css" />

        <!--toastr-->
        <link href="<?php echo $base_url ?>public/assets/toastr-master/toastr.css" rel="stylesheet" type="text/css" />


        <!-- Custom styles for this template -->
        <link href="<?php echo $base_url ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo $base_url ?>public/css/style-responsive.css" rel="stylesheet" />


        <style type="text/css">
            .hide_coloum{
                display: none;
            }

        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

    <section id="container" >
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="<?php echo site_url('dashboard');  ?>" class="logo"><img width=60px;height=auto; src="<?php echo $base_url ?>public/img/pizzalogo.png"/><span style="color:#009246">Automated</span><span style="color:#CE2B37">Attendance</span></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul id="nav-accordion" class="sidebar-menu">
                    <li>
                      <!--  <a href="<?php //echo site_url('home/logout'); ?>" class="active">Logout</a>-->
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->