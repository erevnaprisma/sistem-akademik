<style>
body {
    font-size:12px;
}

.headerlabel {
    font-size: 20px;
    text-align: center;
    display: block;
}
.headertable td {
    border-top: 0 !important;
}

.struk {
    margin: 0 auto;
    width: 300px;
}

.headertable,
.detail,
.total {
    width: 300px;
    margin-bottom:10px;
}

table td {
    padding:3px 5px !important;
}
.headertable td:nth-child(1) {
    width: 100px;
}

.headertable td:nth-child(2) {
    width: 200px;
}

.text-center {
    display: block;
}
</style>

<div class="struk"></div>

<script>
$(document).ready(function() {
    var id = '<?= $id ?>';

    function cetak(header,detail) {

//         card_number: ""
// cheque_number: ""
// created_by: "1"
// created_by_name: "Dwi Setiadi Nugroho"
// created_dt: "2019-06-30 06:58:31"
// created_dt_name: "30/06/2019 06:58:31"
// customer_email: ""
// customer_id: "1"
// customer_mobile: ""
// customer_name: "Walk In Customer"
// discount_percentage: ""
// discount_total: "0.00"
// gift_card: ""
// grandtotal: "3000.00"
// id: "16"
// id_skl: "0"
// is_active: "1"
// is_active_name: "YES"
// ordered_datetime: "0000-00-00 00:00:00"
// outlet_address: ""
// outlet_contact: ""
// outlet_id: "1"
// outlet_name: "Smart Toko"
// outlet_receipt_footer: ""
// paid_amt: "5000.00"
// payment_method: "1"
// payment_method_name: "Cash"
// refund_status: "0"
// remark: ""
// return_change: "-2000.00"
// sekolah: null
// status: "0"
// subtotal: "3000.00"
// tax: "0.00"
// total_items: "1"
// updated_by: null
// updated_by_name: null
// updated_dt: null
// updated_dt_name: null
// vt_status: "0"

// cost: "2000.00"
// created_by: "1"
// created_by_name: "Dwi Setiadi Nugroho"
// created_dt: "2019-06-30 06:58:31"
// created_dt_name: "30/06/2019 06:58:31"
// id: "31"
// id_skl: "0"
// is_active: "1"
// is_active_name: "YES"
// order_id: "16"
// price: "3000.00"
// product_category: "2"
// product_code: "sas sa"
// product_detail: "{"id":"5","code":"sas sa","name":"sa sasa","category":"2","purchase_price":"2000.00","retail_price":"3000.00","id_toko":"1","foto":"5_20190629012548_46470.png","id_skl":"1","is_active":"1","created_by":"1","created_dt":"2019-06-29 01:17:39","updated_by":"1","updated_dt":"2019-06-29 01:25:48","kategori":"Makanan","sekolah":"SDIT Al Kautsar","created":"Dwi Setiadi Nugroho","updated":"Dwi Setiadi Nugroho","nama_toko":"Smart Toko"}"
// product_name: "sa sasa"
// qty: "1"
// updated_by: null
// updated_by_name: null
// updated_dt: null
// updated_dt_name: null

        var htmldiskon = "";
        if(header.discount_total){
            htmldiskon = '\n\
                <tr>\n\
                    <td>Discount</td>\n\
                    <td class="text-right">'+Main.numberWithCommas(header.discount_total)+'</td>\n\
                </tr>\n\
            ';
        }
        if(header.discount_percentage){
            htmldiskon = '\n\
                <tr>\n\
                    <td>Discount</td>\n\
                    <td class="text-right">'+Main.numberWithCommas(header.discount_percentage)+'%</td>\n\
                </tr>\n\
            ';
        }


        var subtotaldetail = 0;
        var htmldetail = "";
        $.each(detail,function (i,value) {
            htmldetail += '\n\
                <tr>\n\
                    <td class="text-center">'+(i+1)+'</td>\n\
                    <td>'+(value.product_name)+'</td>\n\
                    <td class="text-center">'+(Main.numberWithCommas(value.qty))+'</td>\n\
                    <td class="text-right">'+(Main.numberWithCommas(value.price))+'</td>\n\
                    <td class="text-right">'+(Main.numberWithCommas(value.qty * value.price))+'</td>\n\
                </tr>\n\
            ';
            subtotaldetail += value.qty * value.price;
        })


        var html = '\n\
            <label class="headerlabel">'+header.outlet_name+'</label>\n\
            <table class="table headertable">\n\
                <tr>\n\
                    <td>Address</td>\n\
                    <td>'+header.outlet_address+'</td>\n\
                </tr>\n\
                <tr>\n\
                    <td>Telephone</td>\n\
                    <td>'+header.outlet_contact+'</td>\n\
                </tr>\n\
                <tr>\n\
                    <td>Date</td>\n\
                    <td>'+header.created_dt_name+'</td>\n\
                </tr>\n\
                <tr>\n\
                    <td>Customer</td>\n\
                    <td>'+header.customer_name+'</td>\n\
                </tr>\n\
                <tr>\n\
                    <td>Mobile</td>\n\
                    <td>'+header.customer_mobile+'</td>\n\
                </tr>\n\
            </table>\n\
            <table class="table table-striped table-bordered detail">\n\
                <thead>\n\
                    <tr>\n\
                        <th style="width:30px;">#</th>\n\
                        <th style="width:100px;">Products</th>\n\
                        <th style="width:50px;">Qty</th>\n\
                        <th style="width:60px;">Peritem</th>\n\
                        <th style="width:60px;">Total</th>\n\
                    </tr>\n\
                </thead>\n\
                <tbody>\n\
                    '+htmldetail+'\n\
                </tbody>\n\
            </table>\n\
            <table class="table total">\n\
                <tbody>\n\
                    <tr>\n\
                        <td style="width:100px;border-top:1px solid #ccc;" rowspan="4">Total Items</td>\n\
                        <td style="width:50px;border-top:1px solid #ccc;border-right:1px solid #ccc;" rowspan="4" class="text-right">'+Main.numberWithCommas(header.total_items)+'</td>\n\
                        <td style="width:100px;border-top:1px solid #ccc;">Total</td>\n\
                        <td style="width:50px;border-top:1px solid #ccc;" class="text-right">'+Main.numberWithCommas(subtotaldetail)+'</td>\n\
                    </tr>\n\
                        '+htmldiskon+'\n\
                    <tr>\n\
                        <td>Sub Total</td>\n\
                        <td class="text-right">'+Main.numberWithCommas(header.subtotal)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Tax</td>\n\
                        <td class="text-right">'+Main.numberWithCommas(header.tax)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td colspan="2">Grand Total</td>\n\
                        <td colspan="2" class="text-right">'+Main.numberWithCommas(header.grandtotal)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td colspan="2">Paid Amount</td>\n\
                        <td colspan="2" class="text-right">'+Main.numberWithCommas(header.paid_amt)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td colspan="2">Return Change</td>\n\
                        <td colspan="2" class="text-right">'+Main.numberWithCommas(header.return_change)+'</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td colspan="2" style="border-bottom:1px solid #ccc;">Paid By</td>\n\
                        <td colspan="2" class="text-right" style="border-bottom:1px solid #ccc;">'+header.payment_method_name+'</td>\n\
                    </tr>\n\
                </tbody>\n\
            </table>\n\
            <label class="text-center">Terimakasih sudah berbelanja</label>\n\
        ';
        $('.struk').html(html);
        setTimeout(() => {
            document.title = "No. struk: " + id;
            window.print();
            window.close();
        }, 1000);
    }
    function getorder(id) {
        if (id) {
            $.ajax({
                url: __base_url + "api/kantin/order/read",
                data: {
                    id: id
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    var header = data.data[0];

                    $.ajax({
                        url: __base_url + "api/kantin/orderitem/read",
                        data: {
                            order_id: id
                        },
                        method: "POST",
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        beforeSend: function(data) {},
                        success: function(data) {
                            var detail = data.data;
                            cetak(header,detail);
                        }
                    })
                }
            })
        }
    }


    $.when(
        getorder(id),
    ).done(function(j) {
        
    })
})
</script>