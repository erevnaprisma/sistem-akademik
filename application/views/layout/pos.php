<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
    <title>POS</title>
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.print.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/jQuery-schedule/dist/jquery.schedule.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/slick/slick.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/slick/slick-theme.css">

    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">

    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/slick/slick.js"></script>
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
    var __path_attach = '<?php echo PATH_PUBLIC_ATTACH; ?>';
    var __path_image = '<?php echo PATH_PUBLIC_IMAGE; ?>';
    var token = localStorage.getItem('token');
    // if(!token){
    //   window.location.replace(__base_url + "admin/dashboard/index");
    // }
    </script>



    <section class="content">

        <?php $this->load->view($content, $data); ?>
    </section>
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
    <script
        src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/bootstrap-year-calendar/bootstrap-year-calendar.min.js">

    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/full-calendar/fullcalendar.min.js">
    </script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/jQuery-schedule/dist/jquery.schedule.min.js">
    < script src = "<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/adminlte.min.js" >
    </script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/js/demo.js"></script> -->

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