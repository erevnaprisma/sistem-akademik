<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
    <title>sistemakademik | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/font-awesome/css/font-awesome.min.css"
        rel="stylesheet">
    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/Ionicons/css/ionicons.min.css"
        rel="stylesheet">
    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/css/AdminLTE.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/iCheck/square/blue.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
<style>
    .login-logo img{
        width: 100%;
        height: 120px;
        object-fit: contain;
    }
    body {
        background: #ab2e0d !important;
        /*background-position: 50%;*/
        background-size: cover !important;
        background-repeat: no-repeat !important;
        height: unset;
    }
    .login-box-body{
        /* background: transparent; */
        border-radius:10px;
        padding: 13px;
        box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.25) inset;
    }

    .panel-info {
        background: transparent;
        padding: 10px;
    }
</style>
    <script>
    var __base_url = '<?php echo base_url(); ?>';
    </script>
    <script>
    (function() {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  var width = 320;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  var streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = document.getElementById('photo');
    startbutton = document.getElementById('startbutton');

    navigator.mediaDevices.getUserMedia({video: true, audio: false})
    .then(function(stream) {
      video.srcObject = stream;
      video.play();
    })
    .catch(function(err) {
      console.log("An error occurred: " + err);
    });

    video.addEventListener('canplay', function(ev){
      if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);
      
        // Firefox currently has a bug where the height can't be read from
        // the video, so we will make assumptions if this happens.
      
        if (isNaN(height)) {
          height = width / (4/3);
        }
      
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);
    
    clearphoto();
  }

  // Fill the photo with an indication that none has been
  // captured.

  function clearphoto() {
    var context = canvas.getContext('2d');
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, canvas.width, canvas.height);

    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }
  
  // Capture a photo by fetching the current contents of the video
  // and drawing it into a canvas, then converting that to a PNG
  // format data URL. By drawing it on an offscreen canvas and then
  // drawing that to the screen, we can change its size and/or apply
  // other changes before drawing it.

  function takepicture() {
    var context = canvas.getContext('2d');
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);
      var data = canvas.toDataURL('image/png');
      photo.setAttribute('src', data);
    } else {
      clearphoto();
    }
  }

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);
})();
    </script>
    <div class="login-box">
        <div class="login-logo">
            <img src="<?= base_url('assets/img/logolink.png')?>" alt="">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div>
            
                <p class="login-box-msg">Absensi: Input akun, Klik "Take photo" lalu "submit"</p>

                <form action="../../index2.html" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span class="help-block"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <!-- <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div> -->
                            <div class="contentarea">
                            <div class="camera">
                                <video id="video">Video stream not available.</video>
                                <button id="startbutton">Take photo</button> 
                            </div>
                            <canvas style="display: none;" id="canvas"></canvas>
                            <div class="output">
                                <img id="photo" alt="The screen capture will appear in this box."> 
                            </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-danger btn-block btn-flat btn-login">Submit</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>

            <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
            <!-- /.social-auth-links -->

            <!-- <a href="#">I forgot my password</a><br> -->
            <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->


    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>AdminLTE-2.4.10/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/main.js"></script> -->

    <script>
    $(function() {


        $.post(__base_url + 'api/data/bannerread',{
            where: ' abn.is_active = 1 and abn.flag = "wlogin" and date(abn.tanggal_mulai) <= date(now()) and date(abn.tanggal_selesai) >= date(now()) ',
        },function (params) {
            
        })


        localStorage.removeItem("token");
        localStorage.removeItem("currentUser");
        localStorage.removeItem("navigationBar");
        localStorage.removeItem("treeview");
        localStorage.removeItem("validatePage");
        localStorage.removeItem("selectedSchool");
        localStorage.removeItem("getDataDashboard");
        localStorage.removeItem("setMultiSchool");

        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });

        function objectifyForm(formArray) {
            console.log('formArray====>', formArray)
            var returnArray = {};
            for (var i = 0; i < formArray.length; i++) {
                returnArray[formArray[i]['name']] = formArray[i]['value'];
            }
            return returnArray;
        }

        $('.btn-login').click(function() {


            $('.btn-login').prop('disabled', true).text('Loading...');

            $('.login-box-body .help-block').text("");
            $('.login-box-body .form-group').removeClass("has-error").addClass("has-success");

            var attEmail = $('.login-box-body input[name="email"]').parent();
            var attPassword = $('.login-box-body input[name="password"]').parent();

            $.ajax({
                url: __base_url + 'api/auth/login',
                data: {
                    data: JSON.stringify([objectifyForm($('form').serializeArray())])
                },
                method: 'POST',
                // async: false,
                beforeSend: function(data) {},
                success: async function(data, textStatus, xhr) {
                    var dt = new Date();
                    dt.setHours( dt.getHours() + 1 );
                    await localStorage.setItem("startapp", dt);
                    await localStorage.setItem("token", data.token);
                    await localStorage.setItem("currentUser", JSON.stringify(data.data));
                    await localStorage.setItem("selectedSchool", '['+data.data[0].multi_sekolah+']');

                    $.post(__base_url + 'admin/login/session', {
                        token: data.token,
                    }, function() {
                        window.location.replace(__base_url +
                            "admin/home/index");
                    });

                },
                error: function(xhr, textStatus) {
                    if (xhr.status == 404) {
                        // console.log(xhr.responseJSON.message)
                        swal({
                            title: xhr.responseJSON.message,
                            // text: "Form is something wrong.",
                            type: 'warning',
                        })
                    }
                    if (xhr.status == 400) {
                        var error = xhr.responseJSON.error;
                        if (error['email']) {
                            attEmail.addClass('has-error');
                            attEmail.find('.help-block').text(error['email'])
                        }
                        if (error['password']) {
                            attPassword.addClass('has-error');
                            attPassword.find('.help-block').text(error['password'])
                        }
                    }
                    $('.btn-login').prop('disabled', false).text('Sign In');
                    
                },
                complete: function(data, textStatus, xhr) {
                    // console.log(xhr)
                    
                }
            });

        });
    });
    </script>
</body>

</html>