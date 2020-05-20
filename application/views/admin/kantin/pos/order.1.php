<form action="http://localhost/pos/pos/insertSale" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row" style="margin-top: 0px;">
                        <div class="col-md-4" style="padding-right: 0px;">

                            <script type="text/javascript">
                            $(document).on('ready', function() {

                                //$('body').on('click','button',function(){});

                                $("#searchProd").keyup(function() {
                                    // Retrieve the input field text
                                    var filter = $(this).val();

                                    $("#allProd #proname").each(function() {
                                        if ($(this).text().search(new RegExp(filter, "i")) <
                                            0) {
                                            $(this).parent().hide();
                                        } else {
                                            $(this).parent().show();
                                        }
                                    });

                                });

                                $("#pop_add_cust_submit").click(function() {
                                    var fn = document.getElementById("pop_cust_fn").value;
                                    var em = document.getElementById("pop_cust_em").value;
                                    var mb = document.getElementById("pop_cust_mb").value;

                                    if (fn.length == 0) {
                                        alert("Please enter your Full Name!");
                                        document.getElementById("pop_cust_fn").focus();
                                    } else {
                                        var addNewCustomer = $.ajax({
                                            url: 'http://localhost/pos/pos/addNewCustomer?fn=' +
                                                fn + '&em=' + em + '&mb=' + mb,
                                            type: 'GET',
                                            cache: false,
                                            data: {
                                                format: 'json'
                                            },
                                            error: function() {
                                                //alert("Sorry! we do not have stock!");
                                            },
                                            dataType: 'json',
                                            success: function(data) {
                                                document.getElementById("pop_cust_fn")
                                                    .value = "";
                                                document.getElementById("pop_cust_em")
                                                    .value = "";
                                                document.getElementById("pop_cust_mb")
                                                    .value = "";

                                                $('#addCustomerPopUp').modal('hide');
                                                $('#successaddedNewCustomer').modal('show');
                                            }
                                        });
                                    } // End of Else;
                                });


                                $("#pcodeBarcode").keyup(function(e) {
                                    if (e.keyCode == 13) {
                                        var pcode = document.getElementById("pcodeBarcode").value;

                                        var row_count = document.getElementById("row_count").value;
                                        row_count = parseInt(row_count);
                                        var add_row_count = row_count;

                                        var discount_amt = document.getElementById("dis_amt").value;
                                        if (discount_amt.length == 0) {
                                            discount_amt = 0;
                                        }
                                        discount_amt = parseFloat(discount_amt);

                                        var tax = document.getElementById("tax").value;
                                        tax = parseFloat(tax);

                                        //document.getElementById("row_count").value 	= add_row_count;

                                        var temp_outlet = document.getElementById("outlet").value;

                                        var resultPrice = $.ajax({
                                            url: 'http://localhost/pos/pos/getProductDetail?pcode=' +
                                                pcode + '&outlet_id=' + temp_outlet,
                                            type: 'GET',
                                            cache: false,
                                            data: {
                                                format: 'json'
                                            },
                                            error: function() {
                                                alert(
                                                    "Please check your code and try again!");
                                            },
                                            dataType: 'json',
                                            success: function(data) {
                                                var name = data.prod_name;
                                                var price = data.price;
                                                var qty = data.qty;

                                                if (add_row_count == 1) {

                                                    if (qty >= 1) {
                                                        var msgs =
                                                            '<div class="row" id="item_row_' +
                                                            add_row_count +
                                                            '" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-4" style="background-color: #38786a; color: #FFF;">' +
                                                            name + ' <br />[' + pcode +
                                                            ']</div><div class="col-md-4" style="text-align: center; font-size: 15px; color: #000;"><div class="row"><div class="col-md-3" style="padding-top:7px"><span onclick="minusDiv(' +
                                                            add_row_count +
                                                            ')" style="cursor:pointer;"><img src="http://localhost/pos/assets/img/minus_icon.png" /></span></div><div class="col-md-6" style="padding-left: 0px; padding-right: 0px;"><input type="text" id="display_qty_' +
                                                            add_row_count +
                                                            '" class="form-control" value="1" onchange="manualQty(this.value, ' +
                                                            add_row_count +
                                                            ')" style="text-align:center;" /></div><div class="col-md-3" style="padding-left:0px; padding-top:7px;"><span onclick="plusDiv(' +
                                                            add_row_count +
                                                            ')" style="cursor:pointer;"><img src="http://localhost/pos/assets/img/plus_icon.png" /></span></div></div></div><div class="col-md-3">' +
                                                            price +
                                                            '</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv(' +
                                                            add_row_count +
                                                            ')" style="cursor:pointer;">x</span></div></div><input type="hidden" name="pcode_' +
                                                            add_row_count + '" id="pcode_' +
                                                            add_row_count + '" value="' +
                                                            pcode +
                                                            '" /><input type="hidden" name="price_' +
                                                            add_row_count + '" id="price_' +
                                                            add_row_count + '" value="' +
                                                            price +
                                                            '" /><input type="hidden" name="qty_' +
                                                            add_row_count + '" id="qty_' +
                                                            add_row_count +
                                                            '" value="1" />';
                                                        logDiv.append(msgs + "");

                                                        add_row_count++;
                                                        document.getElementById("row_count")
                                                            .value = add_row_count;
                                                    } else {
                                                        $('#outofstockwrp').modal('show');
                                                        //alert("Out of Stock! Please Make Purchase Order!");
                                                    }
                                                } else {

                                                    var check_existing_pcode = 0;

                                                    for (var q = 1; q <
                                                        add_row_count; q++) {
                                                        var exist_pcode = document
                                                            .getElementById("pcode_" + q)
                                                            .value;

                                                        if (pcode == exist_pcode) {
                                                            check_existing_pcode++;
                                                        }
                                                    }

                                                    if (check_existing_pcode == 0) {

                                                        if (qty >= 1) {
                                                            var msgs =
                                                                '<div class="row" id="item_row_' +
                                                                add_row_count +
                                                                '" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-4" style="background-color: #38786a; color: #FFF;">' +
                                                                name + ' <br />[' + pcode +
                                                                ']</div><div class="col-md-4" style="text-align: center; font-size: 15px; color: #000;"><div class="row"><div class="col-md-3" style="padding-top:7px"><span onclick="minusDiv(' +
                                                                add_row_count +
                                                                ')" style="cursor:pointer;"><img src="http://localhost/pos/assets/img/minus_icon.png" /></span></div><div class="col-md-6" style="padding-left: 0px; padding-right: 0px;"><input type="text" id="display_qty_' +
                                                                add_row_count +
                                                                '" class="form-control" value="1" onchange="manualQty(this.value, ' +
                                                                add_row_count +
                                                                ')" style="text-align:center;" /></div><div class="col-md-3" style="padding-left:0px; padding-top:7px;"><span onclick="plusDiv(' +
                                                                add_row_count +
                                                                ')" style="cursor:pointer;"><img src="http://localhost/pos/assets/img/plus_icon.png" /></span></div></div></div><div class="col-md-3">' +
                                                                price +
                                                                '</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv(' +
                                                                add_row_count +
                                                                ')" style="cursor:pointer;">x</span></div></div><input type="hidden" name="pcode_' +
                                                                add_row_count +
                                                                '" id="pcode_' +
                                                                add_row_count +
                                                                '" value="' + pcode +
                                                                '" /><input type="hidden" name="price_' +
                                                                add_row_count +
                                                                '" id="price_' +
                                                                add_row_count +
                                                                '" value="' + price +
                                                                '" /><input type="hidden" name="qty_' +
                                                                add_row_count +
                                                                '" id="qty_' +
                                                                add_row_count +
                                                                '" value="1" />';
                                                            logDiv.append(msgs + "");

                                                            add_row_count++;
                                                            document.getElementById(
                                                                    "row_count").value =
                                                                add_row_count;
                                                        } else {
                                                            $('#outofstockwrp').modal(
                                                                'show');
                                                            //alert("Out of Stock! Please make Purchase Order!");
                                                        }
                                                    } else {

                                                        for (var q = 1; q <
                                                            add_row_count; q++) {
                                                            var exist_pcode = document
                                                                .getElementById("pcode_" +
                                                                    q).value;
                                                            var exist_qty = document
                                                                .getElementById("qty_" + q)
                                                                .value;

                                                            exist_qty = parseInt(exist_qty);

                                                            if (pcode == exist_pcode) {
                                                                var new_qty = exist_qty + 1;

                                                                if (qty >= new_qty) {
                                                                    //document.getElementById("display_qty_"+q).innerHTML 	= new_qty;	
                                                                    document.getElementById(
                                                                            "display_qty_" +
                                                                            q).value =
                                                                        new_qty;
                                                                    document.getElementById(
                                                                            "qty_" + q)
                                                                        .value = new_qty;
                                                                } else {
                                                                    $('#outofstockwrp')
                                                                        .modal('show');
                                                                    //alert("Out of Stock! Please make Purchase Order!");
                                                                }


                                                            }
                                                        }



                                                    }

                                                }

                                                /*
                                                								var msgs 		= '<div class="row" id="item_row_'+add_row_count+'" style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;"><div class="col-md-6" style="background-color: #4d9fe4; color: #FFF;">'+name+' <br />['+pcode+']</div><div class="col-md-2">1</div><div class="col-md-3">'+price+'</div><div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv('+add_row_count+')" style="cursor:pointer;">x</span></div><input type="hidden" name="pcode_'+add_row_count+'" id="pcode_'+add_row_count+'" value="'+pcode+'" /></div><input type="hidden" name="price_'+add_row_count+'" id="price_'+add_row_count+'" value="'+price+'" />';
                                                								logDiv.append( msgs + "" );
                                                */

                                                //document.getElementById("row_count").value 	= add_row_count;

                                                var total_item_qty = 0;
                                                var total_item_price = 0;
                                                for (var p = 1; p < add_row_count; p++) {
                                                    var each_price = document
                                                        .getElementById("price_" + p).value;
                                                    var each_qty = document.getElementById(
                                                        "qty_" + p).value;

                                                    each_price = parseFloat(each_price);
                                                    each_qty = parseInt(each_qty);

                                                    total_item_price += (each_price *
                                                        each_qty);

                                                    if (each_price > 0) {
                                                        total_item_qty += each_qty;
                                                    }
                                                }

                                                total_item_price = total_item_price -
                                                    discount_amt;

                                                var total_tax_amt = total_item_price * (
                                                    tax / 100);

                                                var grandTotal = total_item_price +
                                                    total_tax_amt;
                                                grandTotal = grandTotal.toFixed();


                                                document.getElementById("display_tax_amt")
                                                    .innerHTML = total_tax_amt.toFixed();
                                                document.getElementById("tax_amt").value =
                                                    total_tax_amt.toFixed();

                                                document.getElementById("total_price")
                                                    .innerHTML = total_item_price.toFixed();
                                                document.getElementById("total_payable")
                                                    .innerHTML = grandTotal;

                                                // To display at Model;
                                                document.getElementById("final_payable_amt")
                                                    .innerHTML = grandTotal;
                                                document.getElementById(
                                                        "final_purchased_item").innerHTML =
                                                    total_item_qty;

                                                // To Insert DB;
                                                document.getElementById(
                                                        "final_total_payable").value =
                                                    grandTotal;
                                                document.getElementById("final_total_qty")
                                                    .value = total_item_qty;

                                                document.getElementById("total_item_qty")
                                                    .innerHTML = total_item_qty;

                                                document.getElementById("subTotal").value =
                                                    total_item_price.toFixed();

                                                document.getElementById("pcodeBarcode")
                                                    .value = "";

                                            } // end of success;
                                        });
                                    }
                                });

                            });
                            </script>

                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-md-12">
                                    <a class="btn btn-primary" href="#addCustomerPopUp" data-toggle="modal"
                                        style="border: 0px; width: 100%; padding: 0px 12px;">
                                        <i class="icono-plus"></i> Add Customer </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="pcodeBarcode"
                                        style="border: 1px solid #373942;" placeholder="Scan your barcode">
                                </div>
                            </div>
                            <div class="row"
                                style="background-color: #373942; color: #FFF; font-weight: bold; padding-top: 10px; padding-bottom: 10px; margin: 0px; margin-top: 7px;">
                                <div class="col-md-4">Products</div>
                                <div class="col-md-4">Qty</div>
                                <div class="col-md-3">Per Item</div>
                                <div class="col-md-1" style="font-weight: bold;">X</div>
                            </div>

                            <div style="overflow: scroll; height: 330px; width: 100%;">

                                <div id="log"><input type="hidden" name="pcode_1" id="pcode_1" value=""><input
                                        type="hidden" name="price_1" id="price_1" value="0"><input type="hidden"
                                        name="qty_1" id="qty_1" value="0">
                                    <div class="row" id="item_row_2"
                                        style="margin: 0px; border-bottom: 1px solid #dddddd; padding-top: 5px; padding-bottom: 5px;">
                                        <div class="col-md-4" style="background-color: #38786a; color: #FFF;">Indomie
                                            Ayam Bawang <br>[idm001]</div>
                                        <div class="col-md-4" style="text-align: center; font-size: 15px; color: #000;">
                                            <div class="row">
                                                <div class="col-md-3" style="padding-top:7px"><span
                                                        onclick="minusDiv(2)" style="cursor:pointer;"><img
                                                            src="http://localhost/pos/assets/img/minus_icon.png"></span>
                                                </div>
                                                <div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
                                                    <input type="text" id="display_qty_2" class="form-control" value="1"
                                                        onchange="manualQty(this.value, 2)" style="text-align:center;">
                                                </div>
                                                <div class="col-md-3" style="padding-left:0px; padding-top:7px;"><span
                                                        onclick="plusDiv(2)" style="cursor:pointer;"><img
                                                            src="http://localhost/pos/assets/img/plus_icon.png"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">2500.00</div>
                                        <div class="col-md-1" style="font-weight: bold;"><span onclick="deleteDiv(2)"
                                                style="cursor:pointer;">x</span></div>
                                    </div><input type="hidden" name="pcode_2" id="pcode_2" value="idm001"><input
                                        type="hidden" name="price_2" id="price_2" value="2500.00"><input type="hidden"
                                        name="qty_2" id="qty_2" value="1">
                                </div>
                            </div>

                            <!-- <div style="width: 100%; height: 110px; background-color: #373942;"> -->
                            <div class="row"
                                style="padding-top: 0px; padding-bottom: 0px; margin: 0px; margin-top: 0px;">
                                <div class="col-md-12" style="background-color: #373942;">

                                    <div class="row"
                                        style="margin: 0px; font-weight: bold; color: #FFF; padding-top: 5px; font-size: 13px;">
                                        <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                            <table border="0" style="border-collapse: collapse;" width="100%"
                                                height="auto">
                                                <tbody>
                                                    <tr>
                                                        <td width="25%" height="25px" style="font-size: 12px;">Total
                                                            Items :</td>
                                                        <td width="25%" height="25px" align="right">
                                                            <div id="total_item_qty">1</div>
                                                        </td>
                                                        <td width="25%" height="25px" align="right">
                                                            Total :
                                                        </td>
                                                        <td width="25%" height="25px" align="right">
                                                            <div id="total_price">2500</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--
										<div class="col-md-4">Total Items : </div>
										<div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
											<div id="total_item_qty">0</div>
										</div>
										<div class="col-md-3" style="text-align: right;">Total : </div>
										<div class="col-md-3" style="text-align: right;">
											<div id="total_price">0</div>
										</div>
										-->
                                    </div>

                                    <div class="row"
                                        style="margin: 0px; font-weight: bold; color: #FFF; font-size: 13px;">
                                        <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                            <table border="0" style="border-collapse: collapse;" width="100%"
                                                height="auto">
                                                <tbody>
                                                    <tr>
                                                        <td width="30%" height="25px">
                                                            Dis. Amt. / % :
                                                        </td>
                                                        <td width="20%" height="25px">
                                                            <input type="text" name="dis_amt" id="dis_amt" value="0"
                                                                style="width: 100%; color: #000; font-size: 13px; font-weight: normal; border: 0px; padding-left: 5px; font-family: Arial, Helvetica, sans-serif; padding-top: 5px; padding-bottom: 5px;"
                                                                onkeyup="calculateDiscount(this.value)">
                                                        </td>
                                                        <td width="30%" height="25px" align="right">
                                                            Tax (5%) :
                                                        </td>
                                                        <td width="20%" height="25px" align="right">
                                                            <div id="display_tax_amt">125</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--
										<div class="col-md-4">Disc. Amt. / % : </div>
										<div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
											<input type="text" name="dis_amt" id="dis_amt" value="0" style="width: 100%; color: #000; font-size: 13px; font-weight: normal; border: 0px; padding-left: 5px; font-family: Arial, Helvetica, sans-serif; padding-top: 5px; padding-bottom: 5px;" onkeyup="calculateDiscount(this.value)" />
										</div>
										<div class="col-md-3" style="text-align: right;">Tax (5.00%) : </div>
										<div class="col-md-3" style="text-align: right;">
											<div id="display_tax_amt">0</div>
										</div>
										-->
                                    </div>

                                    <div class="row"
                                        style="margin: 0px; font-weight: bold; color: #FFF; padding-top: 7px; padding-bottom: 7px; font-size: 13px; border-top: 1px solid #dddddd;">
                                        <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                            <table border="0" style="border-collapse: collapse;" width="100%"
                                                height="auto">
                                                <tbody>
                                                    <tr>
                                                        <td width="50%" height="30px">Total Payable :</td>
                                                        <td width="50%" height="30px" align="right">
                                                            <div id="total_payable">2625</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--
										<div class="col-md-6">Total Payable : </div>
										<div class="col-md-6" style="text-align: right;">
											<div id="total_payable">0</div>
										</div>
										-->
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-4" style="margin-top: 8px;">
                                            <div style="background-color: #c72a25; color: #FFF; text-align: center; font-weight: bold; border-radius: 4px; cursor: pointer; padding-top: 10px; padding-bottom: 10px; width: 100%;"
                                                onclick="cancelSelected()">
                                                Cancel </div>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 8px;">
                                            <a href="#holdmodel" data-toggle="modal" style="text-decoration: none;">
                                                <div
                                                    style="background-color: #834f50; color: #FFF; text-align: center; font-weight: bold; border-radius: 4px; padding-top: 10px; padding-bottom: 10px; width: 100%;">
                                                    Hold </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 8px;">
                                            <a class="btn btn-primary" href="#timepicker4Modal" data-toggle="modal"
                                                style="background-color: #38786a; float: right; font-weight: bold; color: #FFF; border: 0px; padding-top: 10px; padding-bottom: 10px; width: 100%;">
                                                Payment </a>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div><!-- Items to pay List // END -->
                        <div class="col-md-8">

                            <link rel="stylesheet" type="text/css"
                                href="http://localhost/pos/assets/carousel/slick/slick.css">
                            <link rel="stylesheet" type="text/css"
                                href="http://localhost/pos/assets/carousel/slick/slick-theme.css">
                            <style type="text/css">
                            .slider {
                                width: 50%;
                            }

                            .slick-slide {
                                margin: 0px 3px;
                            }

                            .slick-slide img {
                                width: 100%;
                            }

                            .slick-prev:before,
                            .slick-next:before {
                                color: black;
                            }
                            </style>



                            <div class="panel panel-default" style="border: 1px solid #ddd;">
                                <div class="panel-body tabs">

                                    <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                        <div class="col-md-12"
                                            style="padding-left: 15px; padding-right: 15px; padding-top: 10px;">
                                            <input type="text" class="form-control"
                                                style="border: 1px solid #3a3a3a; color: #010101;"
                                                placeholder="Search Product by Name OR Code" id="searchProd">
                                        </div>
                                        <!--
	<div class="col-md-3" style="padding-top: 10px;">
		<a class="btn btn-primary" href="#addProductPopUp" data-toggle="modal" style="border: 0px; width: 100%; padding: 3px 12px; background-color: #b205c2;">
			<i class="icono-plus"></i> Add Product
		</a>
	</div>
-->
                                    </div>



                                    <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                        <div class="col-md-12"
                                            style="border-bottom: 1px solid #ddd; padding-top: 11px;">
                                            <div class="regular slider slick-initialized slick-slider slick-dotted"
                                                style="width: 100%" role="toolbar"><button type="button"
                                                    data-role="none" class="slick-prev slick-arrow"
                                                    aria-label="Previous" role="button"
                                                    style="display: block;">Previous</button>

                                                <!--
												<div data-toggle="tab" href="#pilltabAll" style="cursor: pointer;">
													<img src="http://placehold.it/120x60/373942/FFFFFF?text=All" />
												</div>
												-->
                                                <div aria-live="polite" class="slick-list draggable">
                                                    <div class="slick-track" role="listbox"
                                                        style="opacity: 1; width: 3102px; transform: translate3d(-1410px, 0px, 0px);">
                                                        <div data-toggle="tab" href="#pilltab1"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="-7"
                                                            aria-hidden="true" tabindex="-1">
                                                            Deterjen </div>
                                                        <div data-toggle="tab" href="#pilltab3"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="-6"
                                                            aria-hidden="true" tabindex="-1">
                                                            Minuman </div>
                                                        <div data-toggle="tab" href="#pilltab4"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="-5"
                                                            aria-hidden="true" tabindex="-1">
                                                            Rokok </div>
                                                        <div data-toggle="tab" href="#pilltab5"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="-4"
                                                            aria-hidden="true" tabindex="-1">
                                                            Makanan </div>
                                                        <div data-toggle="tab" href="#pilltab6"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="-3"
                                                            aria-hidden="true" tabindex="-1">
                                                            Mie Instan </div>
                                                        <div data-toggle="tab" href="#pilltab7"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="-2"
                                                            aria-hidden="true" tabindex="-1">
                                                            Sayuran </div>
                                                        <div data-toggle="tab" href="#pilltab8"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="-1"
                                                            aria-hidden="true" tabindex="-1">
                                                            Bahan Masak </div>
                                                        <div data-toggle="tab" href="#pilltabAll"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide" data-slick-index="0" aria-hidden="true"
                                                            tabindex="-1" role="option"
                                                            aria-describedby="slick-slide00">
                                                            All
                                                        </div>
                                                        <div data-toggle="tab" href="#pilltab1"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide" data-slick-index="1" aria-hidden="true"
                                                            tabindex="-1" role="option"
                                                            aria-describedby="slick-slide01">
                                                            Deterjen </div>
                                                        <div data-toggle="tab" href="#pilltab3"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide" data-slick-index="2" aria-hidden="true"
                                                            tabindex="-1" role="option"
                                                            aria-describedby="slick-slide02">
                                                            Minuman </div>
                                                        <div data-toggle="tab" href="#pilltab4"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-current slick-active"
                                                            data-slick-index="3" aria-hidden="false" tabindex="-1"
                                                            role="option" aria-describedby="slick-slide03">
                                                            Rokok </div>
                                                        <div data-toggle="tab" href="#pilltab5"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-active" data-slick-index="4"
                                                            aria-hidden="false" tabindex="-1" role="option"
                                                            aria-describedby="slick-slide04">
                                                            Makanan </div>
                                                        <div data-toggle="tab" href="#pilltab6"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-active" data-slick-index="5"
                                                            aria-hidden="false" tabindex="-1" role="option"
                                                            aria-describedby="slick-slide05">
                                                            Mie Instan </div>
                                                        <div data-toggle="tab" href="#pilltab7"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-active" data-slick-index="6"
                                                            aria-hidden="false" tabindex="-1" role="option"
                                                            aria-describedby="slick-slide06">
                                                            Sayuran </div>
                                                        <div data-toggle="tab" href="#pilltab8"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-active" data-slick-index="7"
                                                            aria-hidden="false" tabindex="-1" role="option"
                                                            aria-describedby="slick-slide07">
                                                            Bahan Masak </div>
                                                        <div data-toggle="tab" href="#pilltabAll"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned slick-active"
                                                            data-slick-index="8" aria-hidden="false" tabindex="-1">
                                                            All
                                                        </div>
                                                        <div data-toggle="tab" href="#pilltab1"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned slick-active"
                                                            data-slick-index="9" aria-hidden="false" tabindex="-1">
                                                            Deterjen </div>
                                                        <div data-toggle="tab" href="#pilltab3"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="10"
                                                            aria-hidden="true" tabindex="-1">
                                                            Minuman </div>
                                                        <div data-toggle="tab" href="#pilltab4"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="11"
                                                            aria-hidden="true" tabindex="-1">
                                                            Rokok </div>
                                                        <div data-toggle="tab" href="#pilltab5"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="12"
                                                            aria-hidden="true" tabindex="-1">
                                                            Makanan </div>
                                                        <div data-toggle="tab" href="#pilltab6"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="13"
                                                            aria-hidden="true" tabindex="-1">
                                                            Mie Instan </div>
                                                        <div data-toggle="tab" href="#pilltab7"
                                                            style="cursor: pointer; background-color: rgb(55, 57, 66); color: rgb(255, 255, 255); width: 135px; height: 50px; text-align: center; vertical-align: middle; line-height: 50px;"
                                                            class="slick-slide slick-cloned" data-slick-index="14"
                                                            aria-hidden="true" tabindex="-1">
                                                            Sayuran </div>
                                                    </div>
                                                </div>

                                                <!--
														<div data-toggle="tab" href="#pilltab1" style="cursor: pointer;">
															<img src="http://placehold.it/120x60/373942/FFFFFF?text=Deterjen" />
														</div>
														-->



                                                <!--
														<div data-toggle="tab" href="#pilltab3" style="cursor: pointer;">
															<img src="http://placehold.it/120x60/373942/FFFFFF?text=Minuman" />
														</div>
														-->



                                                <!--
														<div data-toggle="tab" href="#pilltab4" style="cursor: pointer;">
															<img src="http://placehold.it/120x60/373942/FFFFFF?text=Rokok" />
														</div>
														-->



                                                <!--
														<div data-toggle="tab" href="#pilltab5" style="cursor: pointer;">
															<img src="http://placehold.it/120x60/373942/FFFFFF?text=Makanan" />
														</div>
														-->



                                                <!--
														<div data-toggle="tab" href="#pilltab6" style="cursor: pointer;">
															<img src="http://placehold.it/120x60/373942/FFFFFF?text=Mie Instan" />
														</div>
														-->



                                                <!--
														<div data-toggle="tab" href="#pilltab7" style="cursor: pointer;">
															<img src="http://placehold.it/120x60/373942/FFFFFF?text=Sayuran" />
														</div>
														-->



                                                <!--
														<div data-toggle="tab" href="#pilltab8" style="cursor: pointer;">
															<img src="http://placehold.it/120x60/373942/FFFFFF?text=Bahan Masak" />
														</div>
														-->




                                                <button type="button" data-role="none" class="slick-next slick-arrow"
                                                    aria-label="Next" role="button"
                                                    style="display: block;">Next</button>
                                                <ul class="slick-dots" role="tablist" style="display: block;">
                                                    <li class="" aria-hidden="true" role="presentation"
                                                        aria-selected="true" aria-controls="navigation00"
                                                        id="slick-slide00"><button type="button" data-role="none"
                                                            role="button" tabindex="0">1</button></li>
                                                    <li aria-hidden="false" role="presentation" aria-selected="false"
                                                        aria-controls="navigation01" id="slick-slide01"
                                                        class="slick-active"><button type="button" data-role="none"
                                                            role="button" tabindex="0">2</button></li>
                                                    <li aria-hidden="true" role="presentation" aria-selected="false"
                                                        aria-controls="navigation02" id="slick-slide02" class=""><button
                                                            type="button" data-role="none" role="button"
                                                            tabindex="0">3</button></li>
                                                </ul>
                                            </div>
                                            <script src="https://code.jquery.com/jquery-2.2.0.min.js"
                                                type="text/javascript"></script>
                                            <script src="http://localhost/pos/assets/carousel/slick/slick.js"
                                                type="text/javascript" charset="utf-8"></script>
                                            <script type="text/javascript">
                                            $(document).on('ready', function() {
                                                $(".regular").slick({
                                                    dots: true,
                                                    infinite: true,
                                                    slidesToShow: 7,
                                                    slidesToScroll: 3
                                                });
                                                $(".center").slick({
                                                    dots: true,
                                                    infinite: true,
                                                    centerMode: true,
                                                    slidesToShow: 3,
                                                    slidesToScroll: 3
                                                });
                                                $(".variable").slick({
                                                    dots: true,
                                                    infinite: true,
                                                    variableWidth: true
                                                });
                                            });
                                            </script>
                                            <!--
											<ul class="nav nav-pills" style="margin-top: 0px;">
																								<li  class="active" ><a href="#pilltab1" data-toggle="tab">
														Deterjen</a>
													</li>	
																								<li ><a href="#pilltab3" data-toggle="tab">
														Minuman</a>
													</li>	
																								<li ><a href="#pilltab4" data-toggle="tab">
														Rokok</a>
													</li>	
																								<li ><a href="#pilltab5" data-toggle="tab">
														Makanan</a>
													</li>	
																								<li ><a href="#pilltab6" data-toggle="tab">
														Mie Instan</a>
													</li>	
																								<li ><a href="#pilltab7" data-toggle="tab">
														Sayuran</a>
													</li>	
																								<li ><a href="#pilltab8" data-toggle="tab">
														Bahan Masak</a>
													</li>	
																						</ul>
											-->
                                        </div>
                                    </div>

                                    <div class="tab-content" style="overflow: scroll; height: 436px;" id="allProd">


                                        <div class="tab-pane fade in active" id="pilltabAll">
                                            <button type="button" id="txtMessage_0" value="idm001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm001/idm001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Ayam Bawang <br>[idm001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_1" value="idm002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm002/idm002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Goreng <br>[idm002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_2" value="idm003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm003/idm003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Soto Banjar <br>[idm003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_3" value="idm004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm004/idm004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Empal Gentong <br>[idm004]</span>
                                            </button>
                                            <button type="button" id="txtMessage_4" value="idm005"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm005/idm005.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Ayam Spesial <br>[idm005]</span>
                                            </button>
                                            <button type="button" id="txtMessage_5" value="idm006"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm006/idm006.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Ayam Panggang <br>[idm006]</span>
                                            </button>
                                            <button type="button" id="txtMessage_6" value="idm007"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm007/idm007.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Goreng Spesial <br>[idm007]</span>
                                            </button>
                                            <button type="button" id="txtMessage_7" value="mkn001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn001/mkn001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Pop Mie Mini Soto Regular <br>[mkn001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_8" value="mkn002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn002/mkn002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Buburia Ayam Kampung Cup 70 gr <br>[mkn002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_9" value="mkn003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn003/mkn003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cheetos Net Rasa BBQ 10 gr <br>[mkn003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_10" value="mkn004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn004/mkn004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cheetos Net Rasa Rumput Laut 30 gr + 15%
                                                    <br>[mkn004]</span>
                                            </button>
                                            <button type="button" id="txtMessage_11" value="mkn005"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn005/mkn005.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chiki Ball Rasa Ayam Renceng 10 gr
                                                    <br>[mkn005]</span>
                                            </button>
                                            <button type="button" id="txtMessage_12" value="mkn006"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn006/mkn006.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chitato Foodie Rasa Sapi Panggang Madu 55 gr
                                                    <br>[mkn006]</span>
                                            </button>
                                            <button type="button" id="txtMessage_13" value="mkn007"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn007/mkn007.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chitato Kepiting Goreng Telur Asin 55 gr
                                                    <br>[mkn007]</span>
                                            </button>
                                            <button type="button" id="txtMessage_14" value="mk008"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mk008/mk008.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chitato Ketan Mangga 55 gr <br>[mk008]</span>
                                            </button>
                                            <button type="button" id="txtMessage_15" value="mnm001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm001/mnm001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomilk Susu Bubuk Cokelat 800 gr
                                                    <br>[mnm001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_16" value="mnm002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm002/mnm002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cafela Expresso 200 ml <br>[mnm002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_17" value="mnm003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm003/mnm003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Calpico Mini Rasa Anggur Blueberry 70 ml
                                                    <br>[mnm003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_18" value="mnm004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm004/mnm004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Calpico Frezz Original 350 ml <br>[mnm004]</span>
                                            </button>
                                            <button type="button" id="txtMessage_19" value="mnm005"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm005/mnm005.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cap Enaak Krimer Kental Manis Cokelat Sachet 37 gr
                                                    <br>[mnm005]</span>
                                            </button>
                                            <button type="button" id="txtMessage_20" value="mnm006"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm006/mnm006.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Club Air Mineral Galon <br>[mnm006]</span>
                                            </button>
                                            <button type="button" id="txtMessage_21" value="mnm007"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm007/mnm007.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Freiss Squash Rasa Jeruk 520 ml <br>[mnm007]</span>
                                            </button>
                                            <button type="button" id="txtMessage_22" value="mnm008"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm008/mnm008.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Fruitamin Rasa Stroberi 180 ml <br>[mnm008]</span>
                                            </button>
                                            <button type="button" id="txtMessage_23" value="mnm009"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm009/mnm009.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Milkuat Freshy Rasa Jeruk Mandarin 130 ml
                                                    <br>[mnm009]</span>
                                            </button>
                                            <button type="button" id="txtMessage_24" value="mnm010"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm010/mnm010.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Pepsi Blue Botol 1750 ml <br>[mnm010]</span>
                                            </button>
                                            <button type="button" id="txtMessage_25" value="dtg001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg001/dtg001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Bukrim Gel Jeruk Nipis 750 gr <br>[dtg001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_26" value="dtg002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg002/dtg002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Bukrim Superklin Detergen Bubuk 750 gr
                                                    <br>[dtg002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_27" value="dtg003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg003/dtg003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Total Lemon Softener Rejuvinasi Detergen Bubuk 700 gr
                                                    <br>[dtg003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_28" value="dtg004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg004/dtg004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Total Violet Softener Rejuvinasi Detergen Bubuk 700
                                                    gr <br>[dtg004]</span>
                                            </button>
                                            <button type="button" id="txtMessage_29" value="bhm001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/bhm001/bhm001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Orchid Butter Salted Margarin 340 gr
                                                    <br>[bhm001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_30" value="bhm002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/bhm002/bhm002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Amanda Margarin Dapur 200 gr <br>[bhm002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_31" value="bhm003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #38786a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/bhm003/bhm003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Bimoli Minyak Goreng 1 Liter Pouch
                                                    <br>[bhm003]</span>
                                            </button>
                                        </div>

                                        <div class="tab-pane fade in " id="pilltab1">
                                            <button type="button" id="txtMessage_32" value="dtg001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg001/dtg001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Bukrim Gel Jeruk Nipis 750 gr <br>[dtg001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_33" value="dtg002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg002/dtg002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Bukrim Superklin Detergen Bubuk 750 gr
                                                    <br>[dtg002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_34" value="dtg003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg003/dtg003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Total Lemon Softener Rejuvinasi Detergen Bubuk 700 gr
                                                    <br>[dtg003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_35" value="dtg004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/dtg004/dtg004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Total Violet Softener Rejuvinasi Detergen Bubuk 700
                                                    gr <br>[dtg004]</span>
                                            </button>
                                        </div>
                                        <div class="tab-pane fade in " id="pilltab3">
                                            <button type="button" id="txtMessage_36" value="mnm001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm001/mnm001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomilk Susu Bubuk Cokelat 800 gr
                                                    <br>[mnm001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_37" value="mnm002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm002/mnm002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cafela Expresso 200 ml <br>[mnm002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_38" value="mnm003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm003/mnm003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Calpico Mini Rasa Anggur Blueberry 70 ml
                                                    <br>[mnm003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_39" value="mnm004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm004/mnm004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Calpico Frezz Original 350 ml <br>[mnm004]</span>
                                            </button>
                                            <button type="button" id="txtMessage_40" value="mnm005"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm005/mnm005.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cap Enaak Krimer Kental Manis Cokelat Sachet 37 gr
                                                    <br>[mnm005]</span>
                                            </button>
                                            <button type="button" id="txtMessage_41" value="mnm006"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm006/mnm006.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Club Air Mineral Galon <br>[mnm006]</span>
                                            </button>
                                            <button type="button" id="txtMessage_42" value="mnm007"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm007/mnm007.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Freiss Squash Rasa Jeruk 520 ml <br>[mnm007]</span>
                                            </button>
                                            <button type="button" id="txtMessage_43" value="mnm008"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm008/mnm008.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Fruitamin Rasa Stroberi 180 ml <br>[mnm008]</span>
                                            </button>
                                            <button type="button" id="txtMessage_44" value="mnm009"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm009/mnm009.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Milkuat Freshy Rasa Jeruk Mandarin 130 ml
                                                    <br>[mnm009]</span>
                                            </button>
                                            <button type="button" id="txtMessage_45" value="mnm010"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mnm010/mnm010.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Pepsi Blue Botol 1750 ml <br>[mnm010]</span>
                                            </button>
                                        </div>
                                        <div class="tab-pane fade in " id="pilltab4">
                                        </div>
                                        <div class="tab-pane fade in " id="pilltab5">
                                            <button type="button" id="txtMessage_46" value="mkn001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn001/mkn001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Pop Mie Mini Soto Regular <br>[mkn001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_47" value="mkn002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn002/mkn002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Buburia Ayam Kampung Cup 70 gr <br>[mkn002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_48" value="mkn003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn003/mkn003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cheetos Net Rasa BBQ 10 gr <br>[mkn003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_49" value="mkn004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn004/mkn004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Cheetos Net Rasa Rumput Laut 30 gr + 15%
                                                    <br>[mkn004]</span>
                                            </button>
                                            <button type="button" id="txtMessage_50" value="mkn005"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn005/mkn005.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chiki Ball Rasa Ayam Renceng 10 gr
                                                    <br>[mkn005]</span>
                                            </button>
                                            <button type="button" id="txtMessage_51" value="mkn006"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn006/mkn006.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chitato Foodie Rasa Sapi Panggang Madu 55 gr
                                                    <br>[mkn006]</span>
                                            </button>
                                            <button type="button" id="txtMessage_52" value="mkn007"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mkn007/mkn007.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chitato Kepiting Goreng Telur Asin 55 gr
                                                    <br>[mkn007]</span>
                                            </button>
                                            <button type="button" id="txtMessage_53" value="mk008"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/mk008/mk008.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Chitato Ketan Mangga 55 gr <br>[mk008]</span>
                                            </button>
                                        </div>
                                        <div class="tab-pane fade in " id="pilltab6">
                                            <button type="button" id="txtMessage_54" value="idm001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm001/idm001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Ayam Bawang <br>[idm001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_55" value="idm002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm002/idm002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Goreng <br>[idm002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_56" value="idm003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm003/idm003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Soto Banjar <br>[idm003]</span>
                                            </button>
                                            <button type="button" id="txtMessage_57" value="idm004"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm004/idm004.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Empal Gentong <br>[idm004]</span>
                                            </button>
                                            <button type="button" id="txtMessage_58" value="idm005"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm005/idm005.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Ayam Spesial <br>[idm005]</span>
                                            </button>
                                            <button type="button" id="txtMessage_59" value="idm006"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm006/idm006.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Ayam Panggang <br>[idm006]</span>
                                            </button>
                                            <button type="button" id="txtMessage_60" value="idm007"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/idm007/idm007.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Indomie Goreng Spesial <br>[idm007]</span>
                                            </button>
                                        </div>
                                        <div class="tab-pane fade in " id="pilltab7">
                                        </div>
                                        <div class="tab-pane fade in " id="pilltab8">
                                            <button type="button" id="txtMessage_61" value="bhm001"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/bhm001/bhm001.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Orchid Butter Salted Margarin 340 gr
                                                    <br>[bhm001]</span>
                                            </button>
                                            <button type="button" id="txtMessage_62" value="bhm002"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/bhm002/bhm002.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Amanda Margarin Dapur 200 gr <br>[bhm002]</span>
                                            </button>
                                            <button type="button" id="txtMessage_63" value="bhm003"
                                                style="margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 20px 10px 20px 10px; background-color: #005b8a; border: 0px; color: #FFF; font-family: Arial, Helvetica, sans-serif; font-size: 13px; width: 120px;">

                                                <img src="http://localhost/pos/assets/upload/products/xsmall/bhm003/bhm003.jpg"
                                                    height="50px" style="padding-bottom: 5px;"><br>
                                                <span id="proname">Bimoli Minyak Goreng 1 Liter Pouch
                                                    <br>[bhm003]</span>
                                            </button>
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <!--/.panel-->

                        </div><!-- Product List // END -->
                    </div>


                </div><!-- Panel Body // END -->
            </div><!-- Panel Default // END -->
        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->




    <script type="text/javascript">
    $(document).ready(function() {
        $('#holdmodel').on('shown.bs.modal', function() {
            $("#hold_ref").attr("required", true);
            $("#hold_ref").focus();

            var addNewCustomer = $.ajax({
                url: 'http://localhost/pos/pos/loadCustomer',
                type: 'GET',
                cache: false,
                data: {
                    format: 'json'
                },
                error: function() {
                    //alert("Sorry! we do not have stock!");
                },
                dataType: 'json',
                success: function(data) {
                    //var data_display = data.display;
                    //document.getElementById("loadHoldCustomer").innerHTML = data_display;

                    var jsonData = jQuery.parseJSON(JSON.stringify(data));

                    var select, i, option;

                    document.getElementById("openBillLoadCust").options.length = 0;

                    select = document.getElementById('openBillLoadCust');

                    for (var i = 0; i < jsonData.categories.length; i++) {
                        var counter = jsonData.categories[i];

                        var cust_id = counter.cust_id;
                        var cust_name = counter.cust_name;

                        option = document.createElement('option');
                        option.value = cust_id;
                        option.text = cust_name;
                        select.add(option);
                    }

                }
            });
        })

        $('#holdmodel').on('hidden.bs.modal', function() {
            document.getElementById("hold_ref").required = false;
        })



        $('#timepicker4Modal').on('shown.bs.modal', function() {

            var cartitem = document.getElementById("final_total_qty").value;

            if (cartitem == 0) {
                $('#timepicker4Modal').modal('hide');
                $('#errornoitem').modal('show');
            } else {

                $("#paid").attr("required", true);
                $("#paid").focus();
                //document.getElementById("hold_bill_submit").style.display = "none";

                var addNewCustomer = $.ajax({
                    url: 'http://localhost/pos/pos/loadCustomer',
                    type: 'GET',
                    cache: false,
                    data: {
                        format: 'json'
                    },
                    error: function() {
                        //alert("Sorry! we do not have stock!");
                    },
                    dataType: 'json',
                    success: function(data) {
                        //var data_display = data.display;
                        //var category 	= data.categories;

                        var jsonData = jQuery.parseJSON(JSON.stringify(data));

                        var select, i, option;

                        document.getElementById("paymentLoadCust").options.length = 0;

                        select = document.getElementById('paymentLoadCust');

                        for (var i = 0; i < jsonData.categories.length; i++) {
                            var counter = jsonData.categories[i];
                            //console.log(counter.cust_id);

                            var cust_id = counter.cust_id;
                            var cust_name = counter.cust_name;

                            option = document.createElement('option');
                            option.value = cust_id;
                            option.text = cust_name;
                            select.add(option);
                        }



                        //document.getElementById("loadPaymentCustomer").innerHTML = data_display;
                    }
                });

            }

        })
        $('#timepicker4Modal').on('hidden.bs.modal', function() {
            document.getElementById("paid").required = false;
            //document.getElementById("hold_bill_submit").style.display = "block";
        })

        $('html').bind('keypress', function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });


        $('#addCustomerPopUp').on('shown.bs.modal', function() {
            //$("#pop_cust_fn").attr("required", true);
            $("#pop_cust_fn").focus();
        })

        $('#addCustomerPopUp').on('hidden.bs.modal', function() {
            //document.getElementById("pop_cust_fn").required = false;
        })


        $('#addProductPopUp').on('shown.bs.modal', function() {
            $("#pop_pcode").attr("required", true);
            $("#pop_pcode").focus();

            $("#pop_pname").attr("required", true);
            $("#pop_pcate").attr("required", true);
            $("#pop_price").attr("required", true);
        })

        $('#addProductPopUp').on('hidden.bs.modal', function() {
            document.getElementById("pop_pcode").required = false;
            document.getElementById("pop_pname").required = false;
            document.getElementById("pop_pcate").required = false;
            document.getElementById("pop_price").required = false;
        })


        $('#totalSales').on('shown.bs.modal', function() {

            var temp_outlet = document.getElementById("outlet").value;

            var loadTodaySales = $.ajax({
                url: 'http://localhost/pos/pos/loadTodaySales?outlet_id=' + temp_outlet,
                type: 'GET',
                cache: false,
                data: {
                    format: 'json'
                },
                error: function() {
                    //alert("Sorry! we do not have stock!");
                },
                dataType: 'json',
                success: function(data) {
                    var todayDate = data.todaydate;
                    var totalCash = data.totalCash;
                    var totalNett = data.totalNett;
                    var totalVisa = data.totalVisa;
                    var totalMaster = data.totalMaster;
                    var totalCheque = data.totalCheque;
                    var totalAmt = data.totalAmt;


                    document.getElementById("todayDateWrp").innerHTML = todayDate;
                    document.getElementById("todayCash").innerHTML = totalCash.toFixed();
                    document.getElementById("todayNett").innerHTML = totalNett.toFixed();
                    document.getElementById("todayVisa").innerHTML = totalVisa.toFixed();
                    document.getElementById("todayMaster").innerHTML = totalMaster
                .toFixed();
                    document.getElementById("todayCheque").innerHTML = totalCheque
                .toFixed();
                    document.getElementById("todayTotal").innerHTML = totalAmt.toFixed();

                }
            });

        });


    });

    function searchOpenedBill(ele) {

        if (ele.length == 0) {

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('searchOpenedResult').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "http://localhost/pos/pos/getopenedBill?q=", true);
            xmlhttp.send();

            //document.getElementById('searchOpenedResult').innerHTML=xmlhttp.responseText;;
            //return;
        }
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById('searchOpenedResult').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "http://localhost/pos/pos/getopenedBill?q=" + ele, true);
        xmlhttp.send();
    }
    </script>


    <div id="addProductPopUp" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #373942;">
                    <h3 class="modal-title" style="color: #FFF;">Add New Product</h3>
                </div>
                <div class="modal-body" style="overflow: visible; background-color: #FFF;">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Product Code</b></div>
                        <div class="col-md-6">
                            <input type="text" name="pop_pcode" id="pop_pcode" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Product Name</b></div>
                        <div class="col-md-6">
                            <input type="text" name="pop_pname" id="pop_pname" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Product Category</b></div>
                        <div class="col-md-6">
                            <select name="pop_pcate" id="pop_pcate" class="form-control">
                                <option value="">Select Product Category</option>
                                <option value="8">Bahan Masak</option>
                                <option value="1">Deterjen</option>
                                <option value="5">Makanan</option>
                                <option value="6">Mie Instan</option>
                                <option value="3">Minuman</option>
                                <option value="4">Rokok</option>
                                <option value="7">Sayuran</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Selling Price</b></div>
                        <div class="col-md-6">
                            <input type="text" name="pop_price" id="pop_price" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer" style="margin-top: 10px;">
                        <input type="submit" name="add_prod_submit" id="add_prod_submit" value="Add New Product"
                            class="btn btn-primary"
                            style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right;">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="outofstockwrp" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--
				<div class="modal-header" style="background-color: #373942;">
					<h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
				</div>
				-->
                <div class="modal-body" style="overflow: visible; background-color: #FFF; border-radius: 12px;">

                    <div class="row">
                        <div class="col-md-12"
                            style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #c72a25;">
                            Out of Stock! <br>
                            Please update inventory OR make Purchase Order to Supplier! </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="openreachmini" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--
				<div class="modal-header" style="background-color: #373942;">
					<h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
				</div>
				-->
                <div class="modal-body" style="overflow: visible; background-color: #FFF; border-radius: 12px;">

                    <div class="row">
                        <div class="col-md-12"
                            style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #c72a25;">
                            Can not reduce quantity to less than 1.
                            <br>
                            If you do not want, please remove by clicking cross sign!
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="errornoitem" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--
				<div class="modal-header" style="background-color: #373942;">
					<h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
				</div>
				-->
                <div class="modal-body" style="overflow: visible; background-color: #FFF; border-radius: 12px;">

                    <div class="row">
                        <div class="col-md-12"
                            style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #38786a;">
                            Please add product first to make a payment! </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="successaddedNewCustomer" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #373942;">
                    <h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
                </div>
                <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                    <div class="row">
                        <div class="col-md-12"
                            style="text-align: center; font-size: 25px; padding-top: 20px; padding-bottom: 20px; color: #38786a;">
                            Successfully Added New Customer. </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="addCustomerPopUp" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #373942;">
                    <h3 class="modal-title" style="color: #FFF;">Add New Customer</h3>
                </div>
                <div class="modal-body" style="overflow: visible; background-color: #FFF;">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Customer Name</b></div>
                        <div class="col-md-6">
                            <input type="text" name="pop_cust_fn" id="pop_cust_fn" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Customer Email</b></div>
                        <div class="col-md-6">
                            <input type="text" name="pop_cust_em" id="pop_cust_em" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Customer Mobile</b></div>
                        <div class="col-md-6">
                            <input type="text" name="pop_cust_mb" id="pop_cust_mb" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer" style="margin-top: 10px;">
                        <div name="pop_add_cust_submit" id="pop_add_cust_submit" value="Add Customer"
                            class="btn btn-primary"
                            style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right;">
                            Add Customer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="totalSales" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #373942;">
                    <h3 class="modal-title" style="color: #FFF;">Today's Sales : <span
                            id="todayDateWrp">0000-00-00</span></h3>
                </div>
                <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                    <div class="row"
                        style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #ededed; font-size: 15px;">
                        <div class="col-md-4" style="padding-top: 10px;">Cash</div>
                        <div class="col-md-8" style="padding-top: 10px;">
                            : <span id="todayCash">0.00</span>
                        </div>
                    </div>

                    <div class="row"
                        style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #fff; font-size: 15px;">
                        <div class="col-md-4" style="padding-top: 10px;">Nett</div>
                        <div class="col-md-8" style="padding-top: 10px;">
                            : <span id="todayNett">0.00</span>
                        </div>
                    </div>

                    <div class="row"
                        style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #ededed; font-size: 15px;">
                        <div class="col-md-4" style="padding-top: 10px;">VISA</div>
                        <div class="col-md-8" style="padding-top: 10px;">
                            : <span id="todayVisa">0.00</span>
                        </div>
                    </div>

                    <div class="row"
                        style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #fff; font-size: 15px;">
                        <div class="col-md-4" style="padding-top: 10px;">MASTER</div>
                        <div class="col-md-8" style="padding-top: 10px;">
                            : <span id="todayMaster">0.00</span>
                        </div>
                    </div>

                    <div class="row"
                        style="margin-left: 10px; margin-right: 10px; border-bottom: 1px solid #dddddd; padding-bottom: 10px; color: #5f6468; background-color: #ededed; font-size: 15px;">
                        <div class="col-md-4" style="padding-top: 10px;">Cheque</div>
                        <div class="col-md-8" style="padding-top: 10px;">
                            : <span id="todayCheque">0.00</span>
                        </div>
                    </div>

                    <div class="row"
                        style="margin-left: 10px; margin-right: 10px; padding-top: 7px; padding-bottom: 7px; background-color: #005b8a; letter-spacing: 0.5px; font-size: 16px;">
                        <div class="col-md-4"
                            style="padding-left: 15px; padding-right: 15px; font-weight: bold; color: #FFF;">
                            Total </div>
                        <div class="col-md-8"
                            style="padding-left: 15px; padding-right: 15px; font-weight: bold; color: #FFF;">
                            : <span id="todayTotal">0</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div id="openedBill" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #373942;">
                    <h3 class="modal-title" style="color: #FFF;">Opened Bill</h3>
                </div>
                <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                    <div class="row"
                        style="padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                        <div class="col-md-4" style="padding-top: 10px;"><b>Search Opened Bills : </b></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" style="border: 1px solid #373942;"
                                placeholder="Ref. Number" value="" onkeyup="searchOpenedBill(this.value)">
                        </div>
                    </div>

                    <div class="row"
                        style="padding-left: 10px; padding-right: 10px; overflow: scroll; height: 400px; margin-top: 10px;"
                        id="searchOpenedResult">
                        <center>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="holdmodel" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #373942;">
                    <h3 class="modal-title" style="color: #FFF;">Save to Opened Bills</h3>
                </div>
                <div class="modal-body" style="overflow: visible; background-color: #FFF;">

                    <div class="row">
                        <div class="col-md-6"><b>Customers</b></div>
                        <div class="col-md-6">

                            <div style="position: relative; width: 269.979px;"><select name="customer"
                                    id="openBillLoadCust" class="form-control"
                                    style="border: 1px solid rgb(58, 58, 58); color: rgb(1, 1, 1); text-decoration: none; width: 269.979px; height: 43.9583px;">

                                </select><select size="2"
                                    style="display: none; position: absolute; top: 43.9583px; left: 0px; width: 269.979px; border: 1px solid rgb(51, 51, 51); font-weight: normal; padding: 0px; background-color: rgb(255, 255, 255); text-transform: none; z-index: 3;"></select><input
                                    type="text"
                                    style="display: none; height: 41.9791px; position: absolute; top: 0px; left: 0px; margin: 0px; padding: 2px 0px 0px 3px; outline-style: none; border-style: solid solid none; border-color: transparent; background-color: transparent; border-left-width: 0.989583px; border-top-width: 0.989583px; font-size: 14px; font-stretch: 100%; font-variant: normal; font-weight: 400; color: rgb(1, 1, 1); text-align: start; text-indent: 0px; text-shadow: none; text-transform: none; width: 245px; z-index: 2;">
                                <div
                                    style="position: absolute; top: 0px; left: 0px; width: 269.979px; height: 43.9583px; background-color: rgb(255, 255, 255); opacity: 0.01; z-index: 1;">
                                </div>
                            </div>

                            <!-- <div id="loadHoldCustomer"></div> -->
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6"><b>Hold Bill Ref. Number</b></div>
                        <div class="col-md-6">
                            <input type="text" name="hold_ref" id="hold_ref" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 10px;">
                        <input type="submit" name="hold_bill_submit" id="hold_bill_submit" value="Submit"
                            class="btn btn-primary"
                            style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right;">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="timepicker4Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #373942;">
                    <h3 class="modal-title" style="color: #FFF;">Payment</h3>
                </div>
                <div class="modal-body" style="overflow: visible; background-color: #FFF;">
                    <div class="row">
                        <div class="col-md-6">
                            <b>Customers</b>
                        </div>
                        <div class="col-md-6">

                            <script type="text/javascript"
                                src="http://localhost/pos/assets/js/search/jquery.searchabledropdown.js"></script>
                            <script type="text/javascript">
                            $(document).ready(function() {
                                jQuery.browser = {};
                                (function() {
                                    jQuery.browser.msie = false;
                                    jQuery.browser.version = 0;
                                    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                                        jQuery.browser.msie = true;
                                        jQuery.browser.version = RegExp.$1;
                                    }
                                })();

                                $("#paymentLoadCust").searchable();
                                $("#openBillLoadCust").searchable();
                            });
                            </script>
                            <div style="position: relative; width: 269.979px;"><select name="customer"
                                    id="paymentLoadCust" class="form-control"
                                    style="border: 1px solid rgb(58, 58, 58); color: rgb(1, 1, 1); text-decoration: none; width: 269.979px; height: 43.9583px;">

                                </select><select size="2"
                                    style="display: none; position: absolute; top: 43.9583px; left: 0px; width: 269.979px; border: 1px solid rgb(51, 51, 51); font-weight: normal; padding: 0px; background-color: rgb(255, 255, 255); text-transform: none; z-index: 3;"></select><input
                                    type="text"
                                    style="display: none; height: 41.9791px; position: absolute; top: 0px; left: 0px; margin: 0px; padding: 2px 0px 0px 3px; outline-style: none; border-style: solid solid none; border-color: transparent; background-color: transparent; border-left-width: 0.989583px; border-top-width: 0.989583px; font-size: 14px; font-stretch: 100%; font-variant: normal; font-weight: 400; color: rgb(1, 1, 1); text-align: start; text-indent: 0px; text-shadow: none; text-transform: none; width: 245px; z-index: 2;">
                                <div
                                    style="position: absolute; top: 0px; left: 0px; width: 269.979px; height: 43.9583px; background-color: rgb(255, 255, 255); opacity: 0.01; z-index: 1;">
                                </div>
                            </div>
                            <!-- <div id="loadPaymentCustomer"></div> -->

                        </div>
                    </div>

                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                        <div class="col-md-6"><b>Total Payable Amount</b></div>
                        <div class="col-md-6">
                            <span id="final_payable_amt"
                                style="background-color: #FFFF99; padding: 5px 10px;">2625</span>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                        <div class="col-md-6"><b>Total Purchased Items</b></div>
                        <div class="col-md-6">
                            <span id="final_purchased_item"
                                style="background-color: #FFFF99; padding: 5px 10px;">1</span>
                        </div>
                    </div>

                    <script type="text/javascript">
                    function checkChequePayment(ele) {
                        if (ele == "5") { // Cheque;
                            document.getElementById("paid").readOnly = false;
                            document.getElementById("paid").value = 0;
                            document.getElementById("return_change").innerHTML = 0;
                            document.getElementById("card_numb").value = "";
                            document.getElementById("cheque").value = "";


                            document.getElementById("addi_card_numb").value = "";
                            document.getElementById("addi_card_numb_wrp").style.display = "none";
                            document.getElementById("addi_card_numb").required = false;

                            document.getElementById("submit_btn").style.display = "none";

                            document.getElementById("card_wrp").style.display = "none";
                            document.getElementById("card_numb").required = false;

                            document.getElementById("cheque_wrp").style.display = "block";
                            document.getElementById("cheque").required = true;
                            document.getElementById("cheque").focus();

                        } else if ((ele == "3") || (ele == "4")) { // VISA and Master;

                            document.getElementById("paid").readOnly = false;
                            document.getElementById("paid").value = 0;
                            document.getElementById("return_change").innerHTML = 0;
                            document.getElementById("card_numb").value = "";
                            document.getElementById("cheque").value = "";
                            document.getElementById("addi_card_numb").value = "";

                            document.getElementById("addi_card_numb_wrp").style.display = "block";
                            document.getElementById("addi_card_numb").required = true;
                            document.getElementById("addi_card_numb").focus();

                            document.getElementById("submit_btn").style.display = "none";

                            document.getElementById("card_wrp").style.display = "none";
                            document.getElementById("card_numb").required = false;

                            document.getElementById("cheque_wrp").style.display = "none";
                            document.getElementById("cheque").required = false;


                        } else if (ele == "7") { // Gift Card;
                            document.getElementById("paid").value = 0;
                            document.getElementById("return_change").innerHTML = 0;
                            document.getElementById("card_numb").value = "";
                            document.getElementById("cheque").value = "";
                            document.getElementById("addi_card_numb").value = "";

                            document.getElementById("submit_btn").style.display = "none";

                            document.getElementById("cheque_wrp").style.display = "none";
                            document.getElementById("cheque").required = false;

                            document.getElementById("addi_card_numb_wrp").style.display = "none";
                            document.getElementById("addi_card_numb").required = false;

                            document.getElementById("card_wrp").style.display = "block";
                            document.getElementById("card_numb").required = true;
                            document.getElementById("card_numb").focus();

                        } else if (ele == "6") { // Debit;
                            document.getElementById("paid").readOnly = false;
                            document.getElementById("paid").value = 0;
                            document.getElementById("return_change").innerHTML = 0;
                            document.getElementById("card_numb").value = "";
                            document.getElementById("cheque").value = "";
                            document.getElementById("addi_card_numb").value = "";

                            document.getElementById("submit_btn").style.display = "block";

                            document.getElementById("cheque_wrp").style.display = "none";
                            document.getElementById("cheque").required = false;

                            document.getElementById("addi_card_numb_wrp").style.display = "none";
                            document.getElementById("addi_card_numb").required = false;

                            document.getElementById("card_wrp").style.display = "none";
                            document.getElementById("card_numb").required = false;

                        } else {

                            document.getElementById("paid").readOnly = false;
                            document.getElementById("paid").value = 0;
                            document.getElementById("return_change").innerHTML = 0;
                            document.getElementById("card_numb").value = "";
                            document.getElementById("cheque").value = "";
                            document.getElementById("addi_card_numb").value = "";

                            document.getElementById("submit_btn").style.display = "none";

                            document.getElementById("cheque_wrp").style.display = "none";
                            document.getElementById("cheque").required = false;

                            document.getElementById("addi_card_numb_wrp").style.display = "none";
                            document.getElementById("addi_card_numb").required = false;

                            document.getElementById("card_wrp").style.display = "none";
                            document.getElementById("card_numb").required = false;
                        }
                    }
                    </script>
                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                        <div class="col-md-6"><b>Paid By :</b></div>
                        <div class="col-md-6">
                            <select name="paid_by" id="paid_by" class="form-control"
                                style="border: 1px solid #3a3a3a; color: #010101;"
                                onchange="checkChequePayment(this.value)">
                                <option value="1">Cash</option>
                                <option value="3">VISA</option>
                                <option value="4">Master Card</option>
                                <option value="6">Debit</option>
                                <option value="7">Gift Card</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" id="cheque_wrp" style="padding-top: 10px; padding-bottom: 10px; display: none;">
                        <div class="col-md-6"><b>Cheque Number :</b></div>
                        <div class="col-md-6">
                            <input type="text" name="cheque" class="form-control" id="cheque"
                                placeholder="Cheque Number" style="border: 1px solid #3a3a3a; color: #010101;">
                        </div>
                    </div>

                    <script src="http://localhost/pos/assets/js/input-mask/jquery.inputmask.js" type="text/javascript">
                    </script>
                    <script src="http://localhost/pos/assets/js/input-mask/jquery.inputmask.date.extensions.js"
                        type="text/javascript"></script>
                    <script type="text/javascript">
                    $(document).ready(function() {
                        $('#card_numb').inputmask("9999 9999 9999 9999");

                        $("#card_numb").on("keyup", function(event) {

                            var card_numb = document.getElementById("card_numb").value;

                            //alert(card_numb.length);

                            if (card_numb.length == 0) {
                                document.getElementById("submit_btn").style.display = "none";
                            } else if (card_numb.indexOf('_') == -1) {

                                var addNewCustomer = $.ajax({
                                    url: 'http://localhost/pos/pos/loadGiftCardValue?card_numb=' +
                                        card_numb,
                                    type: 'GET',
                                    cache: false,
                                    data: {
                                        format: 'json'
                                    },
                                    error: function() {
                                        //alert("Sorry! we do not have stock!");
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        var card_value = data.value;
                                        var card_status = data.errorMsg;

                                        if (card_status == "failure") {

                                            document.getElementById("paid").value = 0;
                                            document.getElementById("return_change")
                                                .innerHTML = 0;

                                            document.getElementById("submit_btn").style
                                                .display = "none";
                                            alert("Card Do not Exist!");
                                            document.getElementById("card_numb").value = "";

                                        } else if (card_status == "used") {

                                            document.getElementById("paid").value = 0;
                                            document.getElementById("return_change")
                                                .innerHTML = 0;

                                            document.getElementById("submit_btn").style
                                                .display = "none";
                                            alert("Card used!");
                                            document.getElementById("card_numb").value = "";

                                        } else if (card_status == "expired") {

                                            document.getElementById("paid").value = 0;
                                            document.getElementById("return_change")
                                                .innerHTML = 0;

                                            document.getElementById("submit_btn").style
                                                .display = "none";
                                            alert("Card Expired!");
                                            document.getElementById("card_numb").value = "";

                                        } else if (card_status == "success") {

                                            document.getElementById("paid").readOnly = true;
                                            document.getElementById("paid").value =
                                                card_value;
                                            document.getElementById("submit_btn").style
                                                .display = "block";

                                            document.getElementById("paid").onclick = false;

                                            calculatePaidAmtGift(card_value);
                                        }

                                    }
                                });

                                //document.getElementById("submit_btn").style.display = "block";
                            } else {
                                document.getElementById("submit_btn").style.display = "none";
                            }


                        });


                    });
                    </script>

                    <div class="row" id="card_wrp" style="padding-top: 10px; padding-bottom: 10px; display: none;">
                        <div class="col-md-6"><b>Gift Card Number :</b></div>
                        <div class="col-md-6">
                            <input type="text" name="card_numb" class="form-control" id="card_numb"
                                placeholder="Gift Card Number" style="border: 1px solid #3a3a3a; color: #010101;">
                        </div>
                    </div>

                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                        <div class="col-md-6"><b>Paid Amount :</b></div>
                        <div class="col-md-6">
                            <input type="text" name="paid" id="paid" class="form-control" placeholder="0"
                                style="border: 1px solid #3a3a3a; color: #010101;"
                                onkeyup="calculatePaidAmt(this.value)" autocomplete="off">
                        </div>
                    </div>

                    <div class="row" id="addi_card_numb_wrp"
                        style="padding-top: 10px; padding-bottom: 10px; display: none;">
                        <div class="col-md-6"><b>Card Number :</b></div>
                        <div class="col-md-6">
                            <input type="text" name="addi_card_numb" id="addi_card_numb" class="form-control"
                                style="border: 1px solid #3a3a3a; color: #010101;">
                        </div>
                    </div>

                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                        <div class="col-md-6"><b>Return Change :</b></div>
                        <div class="col-md-6">
                            <span id="return_change" style="background-color: #FFFF99; padding: 10px 10px;"></span>
                            <input type="hidden" id="returned_change" name="returned_change" value="0">
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="margin-top: 0px;">
                    <input type="submit" value="Submit" class="btn btn-primary" id="submit_btn"
                        style="background-color: #3fb618; color: #FFF; border: 0px; padding: 5px 25px; float: right; display: none;">
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="row_count" id="row_count" value="3">
    <!-- 	<input type="hidden" name="row_count" id="row_count" value="1" /> -->

    <input type="hidden" name="final_total_payable" id="final_total_payable" value="2625">
    <input type="hidden" name="final_total_qty" id="final_total_qty" value="1">

    <input type="hidden" name="tax" id="tax" value="5.00">
    <input type="hidden" name="tax_amt" id="tax_amt" value="125">

    <input type="hidden" name="subTotal" id="subTotal" value="2500">

    <input type="hidden" name="suspend_id" value="0">

    <input type="hidden" name="outlet" id="outlet" value="3">

</form>