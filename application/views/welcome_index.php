<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
    <title>Si Edu</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css">


    <link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/dist/css/AdminLTE.min.css">

    <style type="text/css">
    /* ::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		price-box-shadow: 0 0 8px #D0D0D0;
	} */
    .pricing {
        /* padding: 10px; */
    	margin-top: 30px;
	}
    .price-box {
        /* padding:5px;
		border: 1px solid #D0D0D0; */
        box-shadow: 0 0 8px #D0D0D0;
    }

    .pricing .header {
        padding: 10px;
        font-size: 24px;
		font-size:bold;
    }

    .pricing .text-content {
        padding: 10px;
        font-size: 18px;
    }

    .pricing .text-harga {
        padding: 10px;
        font-size: 36px;
        font-weight: bold;
    }

    .pricing .btn {
        padding: 10px;
        font-size: 24px;
        font-weight: bold;
        /* width:100% */
    }

.price-box:hover {
	zoom:1.2;
}
	
    </style>
</head>

<body>

    <div class="container-fluid  text-center">
        <div class="row pricing">
            <div class="col-md-3">
                <div class="price-box">

                    <div class="header bg-light-blue color-palette">
                        STARTER
                    </div>
                    <div class="text-content">
                        2000 Siswa
                    </div>
                    <div class="text-content">
                        10 Pengguna
                    </div>
                    <div class="text-content" style="height:70px;">
                        Menu Report, Menu Export
                    </div>
                    <div class="text-harga">
                        2.000.000,-
                    </div>
                    <div class="text-content">
                        Per Tahun
                    </div>
                    <div class="text-content">
                        <button class="btn btn-block btn-success">Beli</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="price-box">
                    <div class="header bg-light-blue color-palette">
                        BASIC
                    </div>
                    <div class="text-content">
                        5000 Siswa
                    </div>
                    <div class="text-content">
                        25 Pengguna
                    </div>
                    <div class="text-content" style="height:70px;">
                        Menu Report, Menu Export, Menu Transaksi
                    </div>
                    <div class="text-harga">
                        4.000.000,-
                    </div>
                    <div class="text-content">
                        Per Tahun
                    </div>
                    <div class="text-content">
                        <button class="btn btn-block btn-success">Beli</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="price-box">
                    <div class="header bg-light-blue color-palette">
                        PRO
                    </div>
                    <div class="text-content">
                        10000 Siswa
                    </div>
                    <div class="text-content">
                        100 Pengguna
                    </div>
                    <div class="text-content" style="height:70px;">
                        Menu Report, Menu Export, Menu Transaksi, Menu PSB
                    </div>
                    <div class="text-harga">
                        10.000.000,-
                    </div>
                    <div class="text-content">
                        Per Tahun
                    </div>
                    <div class="text-content">
                        <button class="btn btn-block btn-success">Beli</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="price-box">
                    <div class="header bg-light-blue color-palette">
                        PREMIUM
                    </div>
                    <div class="text-content">
                        100000 Siswa
                    </div>
                    <div class="text-content">
                        1000 Pengguna
                    </div>
                    <div class="text-content" style="height:70px;">
                        Semua Menu
                    </div>
                    <div class="text-harga">
                        20.000.000,-
                    </div>
                    <div class="text-content">
                        Per Tahun
                    </div>
                    <div class="text-content">
                        <button class="btn btn-block btn-success">Beli</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>