<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
    <title><?= $data->sekolah->nm_skl ?></title>
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

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-year-calendar/bootstrap-year-calendar.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.print.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/jQuery-schedule/dist/jquery.schedule.min.css">

    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/iCheck/all.css">
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">


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

    .callout .dataTable a {
      color: #3c8dbc !important;
      text-decoration: underline;
    }
    </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">

    <script>
    var __base_url = '<?php echo base_url(); ?>';
    var __base_api = '<?php echo base_url('/api'); ?>';
    var __path_attach = '<?php echo PATH_PUBLIC_ATTACH; ?>';
    var __path_image = '<?php echo PATH_PUBLIC_IMAGE; ?>';
    var token = localStorage.getItem('token');
    // if(!token){
    //   window.location.replace(__base_url + "admin/dashboard/index");
    // }
    </script>

<?php 
$page = $this->uri->segment(2);
?>

    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?= base_url('sekolah/landing/'.$data->slug)?>" class="navbar-brand"><?= $data->sekolah->nm_skl ?></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Info Sekolah <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="<?= $page == 'info' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/info/'.$data->slug)?>">List Info Terupdate</a></li>
                                    <li class="<?= $page == 'infogaleri' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/infogaleri/'.$data->slug)?>">Galeri Kegiatan</a></li>
                                    <li class="<?= $page == 'infovideo' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/infovideo/'.$data->slug)?>">Video</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Madding Siswa <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="<?= $page == 'mading' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/mading/'.$data->slug)?>">List Berita</a></li>
                                    <li class="<?= $page == 'madinggaleri' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/madinggaleri/'.$data->slug)?>">Galeri Kegiatan</a></li>
                                    <!-- <li><a href="<?= base_url('sekolah/madingpengumuman/'.$data->slug)?>">Pengumuman</a></li> -->
                                    <li class="<?= $page == 'madingvideo' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/madingvideo/'.$data->slug)?>">Video</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jadual & Kalender <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="<?= $page == 'kalender' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/kalender/'.$data->slug)?>">Kalender Akademik</a></li>
                                    <li class="<?= $page == 'jadwal' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/jadwal/'.$data->slug)?>">Jadual Kelas</a></li>
                                    <!-- <li class="<?= $page == 'jadwalguru' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/jadwalguru/'.$data->slug)?>">Jadual Guru</a></li> -->
                                    <li class="<?= $page == 'jadwalevent' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/jadwalevent/'.$data->slug)?>">Jadual Event Management</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pustaka Online <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="<?= $page == 'pustakaebook' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/pustakaebook/'.$data->slug)?>">Baca E-Book</a></li>
                                    <li class="<?= $page == 'pustakavideo' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/pustakavideo/'.$data->slug)?>">Video Education</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">PSB <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="<?= $page == 'psbcalon' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/psbcalon/'.$data->slug)?>">Pendaftaran Calon SIswa</a></li>
                                    <li class="<?= $page == 'psblist' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/psblist/'.$data->slug)?>">List Calon Siswa</a></li>
                                    <!-- <li class="<?= $page == 'psbstatus' ? 'active' : '' ?>"><a href="<?= base_url('sekolah/psbstatus/'.$data->slug)?>">Status Penerimaan</a></li> -->
                                </ul>
                            </li>
                        </ul>
                        <!-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form> -->
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <?php /* 
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                  <!-- inner menu: contains the messages -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <!-- The message -->
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                  <!-- /.menu -->
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li><!-- start notification -->
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    <li><!-- Task item -->
                      <a href="#">
                        <!-- Task title and progress text -->
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
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
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

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
          </ul>
        </div>
        */ ?>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <!-- <section class="content-header">
        <h1>
          Top Navigation
          <small>Example 2.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>
      </section> -->

                <!-- Main content -->
                <section class="content">

                    <?php $this->load->view($content, $data); ?>

                    <?php /*
        <div class="callout callout-danger">
          <h4>Warning!</h4>

          <p>The construction of this layout differs from the normal one. In other words, the HTML markup of the navbar
            and the content will slightly differ than that of the normal layout.</p>
        </div>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Blank Box</h3>
          </div>
          <div class="box-body">
            The great content goes here
          </div>
          <!-- /.box-body -->
        </div>
        */?>
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All
                rights
                reserved.
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->
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
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/xlsx/xlsx.full.min.js">
    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/xlsx/jszip.js">
    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-year-calendar/bootstrap-year-calendar.min.js">
    
    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.min.js">
    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/jQuery-schedule/dist/jquery.schedule.min.js"></script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/iCheck/icheck.min.js"></script>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/demo.js"></script> -->


    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/input-mask/jquery.inputmask.extensions.js"></script>


    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data.js"></script>
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