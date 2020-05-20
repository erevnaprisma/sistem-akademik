<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
    <title>sistemakademik</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Date Time Picker -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
    <!-- Chosen -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/chosen/chosen.css">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/select2/dist/css/select2.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/dropzone/min/dropzone.min.css">
    
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-year-calendar/bootstrap-year-calendar.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.min.css">

    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">

    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
    <style>
    @font-face {
        font-family: 'Material Icons';
        font-style: normal;
        font-weight: 400;
        src: url(assets/iconfont/MaterialIcons-Regular.eot);
        /* For IE6-8 */
        src: local('Material Icons'),
            local('MaterialIcons-Regular'),
            url(assets/iconfont/MaterialIcons-Regular.woff2) format('woff2'),
            url(assets/iconfont/MaterialIcons-Regular.woff) format('woff'),
            url(assets/iconfont/MaterialIcons-Regular.ttf) format('truetype');
    }
    .skin-red .sidebar-menu>li:hover>a, .skin-red .sidebar-menu>li.active>a, .skin-red .sidebar-menu>li.menu-open>a {
        color: #fff;
        background: #90190b;
    }
    .skin-red .sidebar-menu>li>.treeview-menu {
        margin: 0 1px;
        background: #ca301e;
    }
    .skin-red .sidebar-menu>li.header {
        color: #fff;
        background: #d41600;
    }
    .skin-red .sidebar a {
        color: #fff;
    }
    .skin-red .sidebar-menu .treeview-menu>li>a {
        color: #fff;
    }
    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        /* Preferred icon size */
        display: inline-block;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;

        /* Support for all WebKit browsers. */
        -webkit-font-smoothing: antialiased;
        /* Support for Safari and Chrome. */
        text-rendering: optimizeLegibility;

        /* Support for Firefox. */
        -moz-osx-font-smoothing: grayscale;

        /* Support for IE. */
        font-feature-settings: 'liga';
    }

    /* Chosen fix */
    /* .chosen-container-active {
    z-index:100000000000000000000000000;
    position:fixed;
    display:block;
    width:200px !important;
} */

    /* .chosen-container .chosen-drop.fixed {
  position: fixed;
  display: none;
}

.chosen-container.chosen-with-drop .chosen-drop.fixed {
  display: block;
} */

    /* .modal {
              overflow-y:auto;
            } */
    </style>
</head>

<body class="hold-transition skin-red sidebar-mini">

    <script>
    var __base_url = '<?php echo base_url(); ?>';
    var __path_attach = '<?php echo PATH_PUBLIC_ATTACH; ?>';
    var __path_image = '<?php echo PATH_PUBLIC_IMAGE; ?>';
    var token = localStorage.getItem('token');
    // if(!token){
    //   window.location.replace(__base_url + "admin/dashboard/index");
    // }
    </script>


    <!-- begin #page-loader -->
    <div id="page-loader">
        <div class="material-loader">
            <i class="fa fa-spinner fa-spin"></i>
            <!-- <svg class="circular" viewBox="25 25 50 50">
                  <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                  </svg> -->
            <div class="message">Loading...</div>
        </div>
    </div>
    <!-- end #page-loader -->

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini" style="height:40px;"><img src="<?= base_url('assets/img/logolink-icon.png')?>" alt="" style="height:100%;"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg" style="height:40px;"><img src="<?= base_url('assets/img/logolink.png')?>" alt="" style="height:100%;"></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php /* 
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/img/user2-160x160.jpg"
                        class="img-circle" alt="User Image">
                </div>
                <h4>
                    Support Team
                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                </h4>
                <p>Why not buy a new awesome theme?</p>
                </a>
                </li>
                <!-- end message -->
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/img/user3-128x128.jpg"
                                class="img-circle" alt="User Image">
                        </div>
                        <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/img/user4-128x128.jpg"
                                class="img-circle" alt="User Image">
                        </div>
                        <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/img/user3-128x128.jpg"
                                class="img-circle" alt="User Image">
                        </div>
                        <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/img/user4-128x128.jpg"
                                class="img-circle" alt="User Image">
                        </div>
                        <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                </ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here
                                        that may not fit into
                                        the
                                        page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%"
                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%"
                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/img/user2-160x160.jpg"
                            class="user-image" alt="User Image">
                        <span class="hidden-xs">Alexander Pierce</span>




                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/img/user2-160x160.jpg"
                                class="img-circle" alt="User Image">

                            <p>
                                Alexander Pierce - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                */ ?>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-user-times"></i><div id="logoutin"></div></a> -->
                    <a href="#"><i class="fa fa-user-times"></i> <span id="logoutin"></span></a>
                </li>
                </ul>
    </div>

    </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" style="background-color: #b91400;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= base_url(); ?>AdminLTE-2.4.10/dist/img/user2-160x160.jpg" class="img-circle"
                        alt="User Image">
                </div>
                <div class="pull-left info">
                    <p class="name"></p>
                    <p class="usertype"></p>
                    <a href="#" id="indikatorConnection"><i class="fa fa-circle text-danger"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form" style="display:none;">

                <!-- <div class="input-group"> -->

                <select name="id_skl[]" class="form-control" data-placeholder="Pilih Sekolah" multiple="multiple"
                    style="overflow:hidden;max-height:100px;overflow-y: scroll;">
                    <!-- <option value="">Pilih Semua</option> -->
                </select>
                <button id="pilih_sekolah" class="btn btn-default">Pilih</button>
                <!-- <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                        </button>
                    </span> -->
                <!-- </div> -->
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li><a href="<?= base_url() ?>welcome/logout"><i class="fa fa-circle-o text-aqua"></i>
                        <span>Logout</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="container-fluid">
                    <?php $this->load->view($content, $data); ?>
        </section>
    </div>
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2019 <a href="http://sistemakademik.id">sistemakademik</a>.</strong> All rights
        reserved. Powered by <a href="#">ANVERE</a>
    </footer>

    
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->



    <!--modal bootstrap-->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="alert alert-dismissible fade in" role="alert">
                        <h4 class="modal-title text-center">...</h4>
                    </div>
                </div>
                <div class="modal-body">...</div>
                <!--<div class="modal-footer">...</div>-->
            </div>
        </div>
    </div>


    <!--modal bootstrap-->
    <div class="modal fade" id="myModalsiswa" role="dialog" aria-labelledby="myModalsiswaLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="alert alert-dismissible fade in" role="alert">
                        <h4 class="modal-title text-center">...</h4>
                    </div>
                </div>
                <div class="modal-body">...</div>
                <!--<div class="modal-footer">...</div>-->
            </div>
        </div>
    </div>


<!--modal bootstrap-->
<div class="modal fade" id="myModalguru" role="dialog" aria-labelledby="myModalguruLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="alert alert-dismissible fade in" role="alert">
                        <h4 class="modal-title text-center">...</h4>
                    </div>
                </div>
                <div class="modal-body">...</div>
                <!--<div class="modal-footer">...</div>-->
            </div>
        </div>
    </div>
    <!--modal bootstrap-->
    <div class="modal fade" id="myModalpegawai" role="dialog" aria-labelledby="myModalpegawaiLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="alert alert-dismissible fade in" role="alert">
                        <h4 class="modal-title text-center">...</h4>
                    </div>
                </div>
                <div class="modal-body">...</div>
                <!--<div class="modal-footer">...</div>-->
            </div>
        </div>
    </div>


    <!--modal bootstrap-->
    <div class="modal fade" id="myModaluser" role="dialog" aria-labelledby="myModaluserLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="alert alert-dismissible fade in" role="alert">
                        <h4 class="modal-title text-center">...</h4>
                    </div>
                </div>
                <div class="modal-body">...</div>
                <!--<div class="modal-footer">...</div>-->
            </div>
        </div>
    </div>





    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js">
    </script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/jvectormap/jquery-jvectormap-world-mill-en.js">
    </script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery-knob/dist/jquery.knob.min.js">
    </script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/moment/min/moment.min.js"></script>
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-daterangepicker/daterangepicker.js">
    </script>
    <!-- datepicker -->
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <!-- datetimepicker -->
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js">
    </script>
    <!-- chosen -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/chosen/chosen.jquery.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js">
    <!-- CKEDITOR -->
    <
    script src = "<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/ckeditor/ckeditor.js" >
    </script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
    </script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>


    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net-bs/js/dataTables.responsive.min.js">
    </script>
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net-bs/js/dataTables.buttons.min.js">
    </script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net-bs/js/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/datatables.net-bs/js/vfs_fonts.js"></script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/select2/dist/js/select2.full.min.js">
    </script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/xlsx/xlsx.full.min.js">
    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/xlsx/jszip.js">
    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/dropzone/min/dropzone.min.js">
    </script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-year-calendar/bootstrap-year-calendar.min.js">
</script>
<script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-year-calendar/bootstrap-year-calendar.id.js">
</script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/locale-all.js">
    </script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/demo.js"></script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
    <script>
    // $('.sidebar-form select[name="id_skl[]"]').chosen({
    //     width: "100%",
    //     search_contains: true,
    //     placeholder_text_single: "Pilih Sekolah!",
    //     //                no_results_text: "Oops, nothing found!"
    // });
    </script>
</body>

</html>