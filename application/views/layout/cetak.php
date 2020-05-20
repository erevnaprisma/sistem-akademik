<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
    <!-- <title><?= $data->sekolah->nm_skl ?></title> -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/moment/min/moment.min.js"></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="">
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
    <script>
    var __base_url = '<?php echo base_url(); ?>';
    var __path_attach = '<?php echo PATH_PUBLIC_ATTACH; ?>';
    var __path_image = '<?php echo PATH_PUBLIC_IMAGE; ?>';
    var token = localStorage.getItem('token');
    // if(!token){
    //   window.location.replace(__base_url + "admin/dashboard/index");
    // }
    </script>


    <?php $this->load->view($content, $data); ?>

    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    
</body>

</html>