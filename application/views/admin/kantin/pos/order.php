<!-- <form action="" method="post" class="form-horizontal" style="padding:10px;"> -->
<style>

.total-harga td {
    width: 25%;
}

.item-header .row {
    padding: 5px;
}

.item-selected .row {
    padding: 5px;
}

.item-selected {
    height: 350px;
    overflow-y: scroll;
    overflow-x: hidden;
}

.qty {
    width: 70px;
    display: unset;
}


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

.tab-category {
    padding: 10px;
    text-align: center;
}

li.slick-slide a {
    color: #fff;
}

/* li.slick-slide.slick-current.slick-active {
    background-color: #337ab7;
} */
li.slick-slide.slick-active {
    background-color: black;
    padding: 10px;
    text-align: center;
}

.imgproduct {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}

.itemproduct {
    text-align: center;
    background-color: #005b8a;
    color: #fff;
    border-radius: 10px;
    padding: 10px;
    cursor: pointer;
}

.itemproduct:hover {
    opacity: 0.8;
}

.itemname {
    background-color: #38786a6a;
    padding: 5px 10px;
}

.itemqty,
.itemx {
    padding: 5px 10px;
}

.demo-content.tab-content {
    display: block;
    border: 1px solid #ccc;
    overflow: scroll;
    padding: 10px 0;
    margin-top: 10px;
    height: 560px;
}

.pajak {
    width: 50px;
    display: unset;
}

.logo b {
    color: #fff;
}

.navbar .logo-lg {
    margin: 20px;
    color: #fff;
    padding: 25px;
    font-size: 30px;

}

.btn-nav {
    padding: 5px;
}

.detailsuspend {
    cursor: pointer;
}
</style>


<header class="main-header">
    <!-- Logo -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <a href="" class="">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>POS EDU</b></span>
        </a>
        <!-- Sidebar toggle button-->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="btn-nav">
                    <button class="btn btn-success btn-nav-sales">History</button>
                    <!-- <button class="btn btn-success btn-nav-today">Today's Sales</button> -->
                    <!-- <button class="btn btn-danger btn-nav-hold">Opened Hold</button> -->
                </li>
            </ul>
        </div>

    </nav>
</header>

<br>
<div class="row">
    <div id="id" data-id="<?= $id ?>"></div>
    <div class="col-md-5">
        <button type="button" class="btn btn-block btn-primary" disabled> <i class="fa fa-plus fa-1x"></i> Add
            Customer</button>
        <br>
        <input name="searchCustomer" placeholder="Scan your barcode" class="form-control">
        <br>


        <div class="item-header bg-navy-active color-palette">
            <div class="row">
                <div class="col-xs-5 text-center">Products</div>
                <div class="col-xs-3 text-center">Qty</div>
                <div class="col-xs-3 text-center">Per Item</div>
                <div class="col-xs-1 text-center">X</div>
            </div>
        </div>
        <div class="item-selected">

        </div>

        <table class="table bg-navy-active color-palette total-harga">
            <thead>
                <tr>
                    <td>Total Qty</td>
                    <td class="text-right subqty">0</td>
                    <td>Total :</td>
                    <td class="text-right subnom">0</td>
                </tr>
                <tr>
                    <td>Dis. Amt. / % :</td>
                    <td> <input name="diskon" class="form-control text-right diskon" disabled> <span
                            class="hidden diskonactual"></span> </td>
                    <td><span>Tax ( </span><input name="" class="form-control pajak" disabled><span> %) :</span></td>
                    <td class="text-right totpaj">0</td>
                </tr>
                <tr>
                    <td colspan="2">Total Payable :</td>
                    <td colspan="2" class="text-right totnom">0</td>
                </tr>
            </thead>
        </table>
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-block btn-danger btn-cencel" disabled>Cancel</button>
            </div>
            <!-- <div class="col-md-4"> -->
                <!-- <button type="button" class="btn btn-block btn-warning btn-hold" disabled>Hold</button> -->
            <!-- </div> -->
            <div class="col-md-6">
                <button type="button" class="btn btn-block btn-success btn-payment" disabled>Payment</button>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <input name="searchProduct" placeholder="Search Product by Name OR Code" class="form-control">
        <br>
        <ul class="demo nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#home"></a></li>
        </ul>
        <div class="demo-content tab-content">
            <div id="home" class="tab-pane fade in active">
            </div>

        </div>
        <br>

    </div>
</div>
<!-- </form> -->


<script>
$(document).ready(function() {


    Main.getCurrentUser().name

    var suspendForm = '#suspendForm';
    var paymentForm = '#paymentForm';

    $('.btn-nav-sales').click(function() {
        window.location.href = __base_url + 'admin/kantin/cart';
    });

    $('.btn-nav-today').click(function() {
        $('#myModalToday').modal('show');
        $('#myModalToday table').remove();
        $.ajax({
            url: __base_url + "api/kantin/order/getcountorder",
            data: {
                outlet_id: $('#id').attr('data-id'),
                is_active: 1,
                created_dt: moment(new Date()).format('YYYY-MM-DD')
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                var html = '<table class="table table-bordered">\n\
                    <tr>\n\
                        <td width="25%">Date</td>\n\
                        <td width="25%" class="text-right">'+moment(new Date()).format('DD/MM/YYYY')+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td width="25%">Cash</td>\n\
                        <td width="25%" class="text-right">'+(data.cash?data.cash:0)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Nett</td>\n\
                        <td class="text-right">'+(data.nett?data.nett:0)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>VISA</td>\n\
                        <td class="text-right">'+(data.visa_card?data.visa_card:0)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>MASTER</td>\n\
                        <td class="text-right">'+(data.master_card?data.master_card:0)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Cheque</td>\n\
                        <td class="text-right">'+(data.gift_card?data.gift_card:0)+'</td>\n\
                    </tr>\n\
                    <tr class="bg-primary">\n\
                        <td>Total</td>\n\
                        <td class="text-right">'+(data.total?data.total:0)+'</td>\n\
                    </tr>\n\
                </table>';
                $('#myModalToday .modal-body').append(html);
            }
        })

        

    });
    

    function getOutlet() {
        $.ajax({
            url: __base_url + "api/kantin/outlet/read",
            data: {
                id: $('#id').attr('data-id')
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $('#id').attr('data', JSON.stringify(data.data[0]))
            }
        })
    }

    function getSuspend() {
        $('.itemsuspend .colsuspend').remove();
        $.ajax({
            url: __base_url + "api/kantin/suspend/read",
            data: {
                // is_active: 1,
                // status: 0,
                where: ' date(mst.created_dt) = date(now()) and mst.is_active = 1 and mst.status = 0',
                order_by: ' order by mst.id desc ',
                id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                // id_skl:1
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $('.itemsuspend').append("\n\
						<div class=\"col-md-4 colsuspend\">\n\
							<div class=\"alert alert-info alert-dismissible detailsuspend\" data='" + JSON.stringify(value) + "'>\n\
								<div class=\"row\"><div class=\"col-xs-6\">Ref. Number</div><div class=\"col-xs-6\">" + value.ref_number + "</div></div>\n\
								<div class=\"row\"><div class=\"col-xs-6\">Customer Name</div><div class=\"col-xs-6\">" + value.fullname + "</div></div>\n\
								<div class=\"row\"><div class=\"col-xs-6\">Date</div><div class=\"col-xs-6\">" + value.created_dt_name + "</div></div>\n\
								<div class=\"row\"><div class=\"col-xs-6\">Qty</div><div class=\"col-xs-6\">" + value.total_items + "</div></div>\n\
								<div class=\"row\"><div class=\"col-xs-6\">Total</div><div class=\"col-xs-6\">" + value.grandtotal + "</div></div>\n\
							</div>\n\
						</div>\n\
					")
                })
            }
        })
    }

    function getproduct() {
        $.ajax({
            url: __base_url + "api/kantin/product/read",
            data: {
                is_active: 1,
                id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                id_toko: $('#id').attr('data-id'),
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $('#' + value.kategori).append("\n\
						<div class=\"col-xs-3 searchproduct\">\n\
							<div class=\"itemproduct\" data='" + JSON.stringify(value) + "'>\n\
								<img src='" + __base_url + __path_attach + "product/" + value.foto + "' class=\"img-responsive\">\n\
								<p>" + value.name + "</p>\n\
								<p>[" + value.code + "]</p>\n\
							</div>\n\
						</div>\n\
					");
                })
            }
        })
    }

    function getcategoryproduct() {
        $.ajax({
            url: __base_url + "api/kantin/category/read",
            data: {
                is_active: 1,
                id_skl: JSON.parse(Main.getselectedSchool()).join(','),
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $('.demo li').remove();
                $('.demo-content .tab-pane').remove();

                $.each(data.data, function(i, value) {
                    $('.demo').append('<li ' + (i == 0 ? 'class="active"' : '') +
                        '><a data-toggle="pill" href="#' + value.name + '">' + value
                        .name + '</a></li>')
                    $('.demo-content').append('\n\
						<div id="' + value.name + '" class="tab-pane fade ' + (i == 0 ? 'in active' : '') + '"></div>\n\
					');
                });
                getproduct();
            }
        })
    }



    [Main.getCurrentUser()].forEach((item)=>{
        $(suspendForm + ' select[name="customer_id"]').append("<option value='"+item.id+"' data='"+JSON.stringify(item)+"'>"+item.name+"</option>")
        $(paymentForm + ' select[name="customer_id"]').append("<option value='"+item.id+"' data='"+JSON.stringify(item)+"'>"+item.name+"</option>")
    })

    $.when(
        getOutlet(),
        // Data.getCustomer(suspendForm, ' select[name="customer_id"]'),
        // Data.getCustomer(paymentForm, ' select[name="customer_id"]'),
        getcategoryproduct(),
        getSuspend(),
    ).done(function() {

    })

    function setNominal() {
        var subqty = 0;
        var subnom = 0;
        var totpaj = 0;
        var totnom = 0;
        var diskon = $('.diskon').val();
        var pajak = $('.pajak').val();
        $('.itemdetail').each(function() {
            var item = $(this);
            var qty = parseInt(item.find('.qty').val());
            var satuan = parseInt(item.find('.itemsatuan').text());
            // subqty +=1;
            subqty += qty;
            subnom += qty * satuan;
        })
        if (diskon.includes('%')) {
            $('.diskonactual').text((subnom * (diskon.split('%')[0] / 100)))
            subnom -= (subnom * (diskon.split('%')[0] / 100));
        } else if (diskon) {
            $('.diskonactual').text(diskon);
            subnom -= diskon;
        } else {
            //
        }


        $('.subqty').text(subqty);
        $('.subnom').text(subnom);
        var totalpajak = subnom * (pajak / 100);
        $('.totpaj').text(totalpajak);
        // $('.totpaj').text(subnom);
        $('.totnom').text(totalpajak + subnom);
        $(paymentForm + ' input[name="grandtotal"]').val(totalpajak + subnom);
        $(paymentForm + ' input[name="total_items"]').val(subqty);
        // $('.totnom').text(subnom);


        if (subnom == 0) {
            $('.btn-cencel').prop('disabled', true);
            $('.btn-hold').prop('disabled', true);
            $('.btn-payment').prop('disabled', true);
        } else {
            $('.btn-cencel').prop('disabled', false);
            $('.btn-hold').prop('disabled', false);
            $('.btn-payment').prop('disabled', false);
        }

    }

    function setItemSelected(value) {

        $('.item-selected').append("\n\
				<div id='" + value.id + "' class=\"row itemdetail\" data-id='" + value.id + "' data='" + JSON.stringify(value) + "'>\n\
					<div class=\"col-xs-5\">\n\
						<p class=\"itemname\">" + value.name + " [" + value.code + "]</p>\n\
					</div>\n\
					<div class=\"col-xs-3\">\n\
						<span class=\"fa fa-minus-circle fa-2x qtymin\"></span>\n\
						<input value='" + (value.qty ? value.qty : 1) + "' class=\"form-control qty text-right\">\n\
						<span class=\"fa fa-plus-circle fa-2x qtyplus\"></span>\n\
					</div>\n\
					<div class=\"col-xs-3 text-right\">\n\
						<p class=\"itemsatuan\">" + value.retail_price + "</p>\n\
					</div>\n\
					<div class=\"col-xs-1\">\n\
						<span class=\"fa fa-trash fa-2x itemx\"></span>\n\
					</div>\n\
				</div>\n\
			")
    }

    $(document).on('keyup', 'input[name="searchProduct"]', function() {
        var text = $(this).val();
        $('.searchproduct').each(function() {
            var search = "";
            $(this).find('p').each(function() {
                search += $(this).text();
            })
            if (search.search(new RegExp(text, 'i')) < 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        })

        // console.log($(this).val())
    })


    $(document).on('click', '.itemproduct', function(e) {
        e.preventDefault();
        var value = JSON.parse($(this).attr('data'));

        if ($('#' + value.id).length > 0) {
            $('#' + value.id + ' .qty').val(parseInt($('#' + value.id + ' .qty').val()) + 1);
        } else {
            setItemSelected(value);
        }
        // setTimeout(() => {
        setNominal();
        // }, 300);
    })

    $(document).on('click', '.qtymin', function() {
        if ($(this).next().val() > 1) {
            $(this).next().val(parseInt($(this).next().val()) - 1);
            setNominal();
        }
    })
    $(document).on('click', '.qtyplus', function() {
        $(this).prev().val(parseInt($(this).prev().val()) + 1);
        setNominal();
    })

    $(document).on('click', '.itemx', function() {
        $(this).parents('.itemdetail').remove();
        setNominal();
    })

    $(document).on('keyup', '.qty,.diskon,.pajak', function() {
        setNominal();
    })


    $(document).on('click', '.btn-cencel', function() {
        $('.itemdetail').remove();
        setNominal();
    })
    $(document).on('click', '.btn-hold', function() {
        $('#myModalHold').modal('show');

    })

    $(document).on('click', '.btn-nav-hold', function() {
        $('#myModalNavHold').modal('show');
    })

    $(document).on('click', '.btn-suspend-save', function(e) {
        e.preventDefault();
        var valuesuspend = [];
        var valuesuspenditem = [];
        var customer = JSON.parse($(suspendForm + ' select[name="customer_id"] option:selected').attr(
            'data'));
        var ref_number = $(suspendForm + ' input[name="ref_number"]').val();

        valuesuspend.push({
            customer_id: customer.id,
            fullname: customer.fullname,
            email: customer.email,
            mobile: customer.mobile,
            ref_number: ref_number,
            outlet_id: $('#id').attr('data-id'),
            subtotal: $('.total-harga .subnom').text(),
            discount_total: $('.total-harga .diskonactual').text(),
            tax: $('.total-harga .totpaj').text(),
            grandtotal: $('.total-harga .totnom').text(),
            total_items: $('.total-harga .subqty').text(),
            status: 0,
            is_active: 1,
        })

        $.ajax({
            url: __base_url + 'api/kantin/suspend/create',
            data: {
                data: JSON.stringify(valuesuspend)
            },
            method: 'POST',
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                // $('#myModal button.close').trigger('click');
                // $('#mytable').DataTable().ajax.reload(null, false);

                $('.itemdetail').each(function(i, item) {
                    var thiss = $(this);
                    var detail = JSON.parse($(this).attr('data'));
                    $.ajax({
                        url: __base_url + 'api/kantin/suspenditem/create',
                        data: {
                            data: JSON.stringify([{
                                suspend_id: data.data,
                                product_code: detail.code,
                                product_name: detail.name,
                                product_category: detail
                                    .category,
                                product_cost: detail
                                    .purchase_price,
                                qty: thiss.find('.qty').val(),
                                product_price: detail
                                    .retail_price,
                                product_detail: JSON.stringify(
                                    detail),
                            }])
                        },
                        method: 'POST',
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        success: function(data) {
                            // console.log(data)
                            $('#myModalHold').modal('hide');
                            $('.itemdetail').remove();
                            setNominal();
                            getSuspend();
                        },
                        error: function(e) {
                            // Main.autoSetError(form, e.responseJSON.error)
                        },
                        complete: function(e) {

                        }
                    });


                })



            },
            error: function(e) {
                // Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });

    })







    $(document).on('click', '.detailsuspend', function() {
        // if($('.itemdetail').length>0){
        // 	swal(
        // 		'Deleted!',
        // 		'Pilihan item produk harus di delete',
        // 		'danger'
        // 	);
        // } else {
        var value = JSON.parse($(this).attr('data'));
        console.log(value)

        $.ajax({
            url: __base_url + "api/kantin/suspenditem/read",
            data: {
                suspend_id: value.id,
                created_by: Main.getCurrentUser().id,
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    // console.log(value)
                    if (value.product_detail) {
                        var detail = JSON.parse(value.product_detail);
                        detail.qty = value.qty;
                        setItemSelected(detail);
                    }
                })
                setNominal();
            }
        })



        $('#myModalNavHold').modal('hide');
        // }
    })



    $(document).on('click', '.btn-payment', function(e) {
        e.preventDefault()
        $('#myModalPayment').modal('show');
    })
    // $(document).on('keyup', paymentForm + ' input[name="paid_amt"]', function(e) {
    //     var grandtotal = $(paymentForm + ' input[name="grandtotal"]').val();
    //     var paid_amt = $(this).val();
    //     $(paymentForm + ' input[name="return_change"]').val(grandtotal - paid_amt);
    //     if (grandtotal - paid_amt > 0) {
    //         $('.btn-payment-save').prop('disabled', true)
    //     } else {
    //         $('.btn-payment-save').prop('disabled', false)
    //     }
    // })

    $(document).on('click', '.btn-payment-save', function(e) {
        e.preventDefault()

        var order = [];
        var customer = JSON.parse($(suspendForm + ' select[name="customer_id"] option:selected').attr(
            'data'));

        var diskon = $('.total-harga .diskonactual').text();

        var payment = Main.objectifyForm($(paymentForm).serializeArray());

        var outlet = JSON.parse($('#id').attr('data'));

        console.log(payment);

        var detai = {
            customer_id: customer.id,
            customer_name: customer.fullname,
            customer_email: customer.email,
            customer_mobile: customer.mobile,
            // ordered_datetime:"", 
            outlet_id: outlet.id,
            outlet_name: outlet.nama_toko,
            // outlet_address:outlet.id, 
            // outlet_contact:outlet.id, 
            // outlet_receipt_footer:outlet.id, 
            gift_card: "",
            subtotal: $('.total-harga .subnom').text(),
            tax: $('.total-harga .totpaj').text(),
            grandtotal: payment.grandtotal,
            total_items: payment.total_items,
            payment_method: payment.payment_method,
            payment_method_name: $(paymentForm + ' select[name="payment_method"] option:selected')
                .text(),
            cheque_number: "",
            paid_amt: payment.paid_amt,
            return_change: payment.return_change,
            vt_status: "",
            status: "",
            refund_status: "",
            remark: "",
            card_number: "",
            is_active: 1,
        }
        if (diskon && diskon.includes('%')) {
            detai.discount_percentage = diskon.split('%')[0];
        }
        if (diskon && !diskon.includes('%')) {
            detai.discount_total = diskon;
        }
        order.push(detai);

        $.ajax({
            url: __base_url + 'api/kantin/order/create',
            data: {
                data: JSON.stringify(order),
            },
            method: 'POST',
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                var data_id = data.data;
                $('.itemdetail').each(function(i, item) {
                    var thiss = $(this);
                    var detail = JSON.parse($(this).attr('data'));
                    $.ajax({
                        url: __base_url + 'api/kantin/orderitem/create',
                        data: {
                            data: JSON.stringify([{
                                order_id: data.data,
                                product_code: detail.code,
                                product_name: detail.name,
                                product_category: detail
                                    .category,
                                cost: detail.purchase_price,
                                price: detail.retail_price,
                                qty: thiss.find('.qty').val(),
                                is_active: 1,
                                product_detail: JSON.stringify(
                                    detail),


                            }])
                        },
                        method: 'POST',
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        success: function(data) {
                            // console.log(data)
                            $(paymentForm + ' input[name="paid_amt"]').val("");
                            $(paymentForm + ' input[name="return_change"]').val("");
                            $('.diskon').val("");
                            $('#myModalPayment').modal('hide');
                            $('.itemdetail').remove();
                            // $('.btn-payment-save').prop('disabled', true)
                            // $('.btn-payment-print').prop(disabled, false);
                            setNominal();
                            // window.open(__base_url + 'admin/kantin/pos/cetak/' + data_id, '_blank');
                        },
                        error: function(e) {
                            // Main.autoSetError(form, e.responseJSON.error)
                        },
                        complete: function(e) {

                        }
                    });


                })



                // console.log(data)
                // $('#myModalPayment').modal('hide');
                // $('.itemdetail').remove();
                // setNominal();
            },
            error: function(e) {
                // Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });

    })


})
</script>

<div class="modal fade" id="myModalToday" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="alert alert-dismissible fade in" role="alert">
                    <h4 class="modal-title text-center">Today</h4>
                </div>
            </div>
            <div class="modal-body">
                
            </div>
            <!--<div class="modal-footer">...</div>-->
        </div>
    </div>
</div>

<!--modal bootstrap-->
<div class="modal fade" id="myModalNavHold" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="alert alert-dismissible fade in" role="alert">
                    <h4 class="modal-title text-center">Opened Bill</h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="">
                    <input name="search" class="form-control">
                </div>
                <br>
                <div class="row">
                    <div class="itemsuspend">

                    </div>
                </div>
            </div>
            <!--<div class="modal-footer">...</div>-->
        </div>
    </div>
</div>
<!--modal bootstrap-->
<div class="modal fade" id="myModalHold" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="alert alert-dismissible fade in" role="alert">
                    <h4 class="modal-title text-center">Save to Opened Bills</h4>
                </div>
            </div>
            <div class="modal-body">
                <form id="suspendForm" class="">
                    <div class="form-group">
                        <label for="">Customers</label>
                        <select name="customer_id" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="">Hold Bill Ref. Number</label>
                        <input name="ref_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary btn-suspend-save">Save</button>
                    </div>
                </form>
            </div>
            <!--<div class="modal-footer">...</div>-->
        </div>
    </div>
</div>
<!--modal bootstrap-->
<div class="modal fade" id="myModalPayment" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="alert alert-dismissible fade in" role="alert">
                    <h4 class="modal-title text-center">Payment</h4>
                </div>
            </div>
            <div class="modal-body">
                <form id="paymentForm" class="">
                    <div class="form-group">
                        <label for="">Customers</label>
                        <select name="customer_id" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="">Total Payable Amount</label>
                        <input name="grandtotal" class="form-control text-right" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Total Purchased Items</label>
                        <input name="total_items" class="form-control text-right" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Paid By</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="1">Cash</option>
                            <option value="2">Edu Pay</option>
                            <!-- <option value="2">VISA</option>
							<option value="3">Master Card</option>
							<option value="4">Debit</option>
							<option value="5">Gift Card</option> -->
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Card Number</label>
                        <input name="card_number" class="form-control text-right">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="">Paid Amount</label>
                        <input name="paid_amt" class="form-control text-right">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="">Return Change</label>
                        <input name="return_change" class="form-control text-right" readonly>
                    </div> -->
                    <div class="form-group">
                        <button class="btn btn-block btn-primary btn-payment-save">Save</button>
                    </div>
                    <!-- <div class="form-group">
                        <button class="btn btn-block btn-primary btn-payment-print" disabled>Print</button>
                    </div> -->
                </form>
            </div>
            <!--<div class="modal-footer">...</div>-->
        </div>
    </div>
</div>