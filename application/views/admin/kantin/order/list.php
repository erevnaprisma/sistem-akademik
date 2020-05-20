<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            
            <th>Outlet name</th>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Total Items</th>
            <!-- <th>Subtotal</th> -->
            <!-- <th>Discount Total</th> -->
            <!-- <th>Discount Percentage</th> -->
            <th>Tax</th>
            <th>Grandtotal</th>
            <th>Method</th>
            <th>Paid Off</th>
            <th>Taken</th>
            <th>Action</th>
            <!-- <th>Paid Amt</th> -->
            <!-- <th>Return Change</th> -->
            <!-- <th>Created By</th> -->
            <!-- <th>Created Date</th> -->
            <!-- <th>Updated By</th> -->
            <!-- <th>Updated Date</th> -->
            <!-- <th>Action</th> -->
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var form = '#orderForm';

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    $('#mytable').DataTable({
        dom: "lBfrtip",
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
        buttons: [{
            // text: "Create",
            // className: "btn btn-create btn-success fa fa-plus",
            // init: function(a, b, c) {
            //     b.attr('href', __base_url + 'admin/kantin/order/create');
            //     b.attr('title', 'CREATE');
            // },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/kantin/order/json",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {

                $.extend(d, {
                    outlet_id: Main.getCurrentUser().outlet_id_all,
                    id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                    date: '',
                });
                d.supersearch = $('.my-filter').val();
                // Retrieve dynamic parameters
                var dt_params = $('#mytable').data('dt_params');
                // Add dynamic parameters to the data object sent to the server
                if (dt_params) {
                    $.extend(d, dt_params);
                }
            }
        },
        "columns": [{
                //"class": "details-control",
                "orderable": false,
                "searchable": false,
                "data": 'id',
                "defaultContent": ""
            },
            
    //         customer_name, customer_email, customer_mobile, 
    // ordered_datetime, outlet_id, outlet_name, outlet_address, outlet_contact, outlet_receipt_footer, 
    // gift_card, subtotal, discount_total, discount_percentage, tax, grandtotal, total_items, 
    // payment_method, payment_method_name, cheque_number, paid_amt, return_change, 
    // vt_status, status, refund_status, remark, card_number,
            // {
            //     "data": "customer_name"
            // },
            {
                "data": "outlet_name"
            },
            {
                "data": "created_dt_name"
            },
            {
                "data": "created_by_name"
            },
            {
                "data": "total_items"
            },
            // {
            //     "data": "subtotal"
            // },
            // {
            //     "data": "discount_total"
            // },
            // {
            //     "data": "discount_percentage"
            // },
            {
                "data": "tax"
            },
            {
                "data": "grandtotal"
            },
            // {
            //     "data": "paid_amt"
            // },
            // {
            //     "data": "return_change"
            // },
            
            // {
            //     "data": "is_active_name"
            // },
            // {
            //     "data": "created_by_name"
            // },
            // {
            //     "data": "created_dt"
            // },
            // {
            //     "data": "updated_by_name"
            // },
            // {
            //     "data": "updated_dt"
            // },
            {
                "data": "payment_method_name"
            },
            {
                "data": "lunas",
                "render": function(row, data, iDisplayIndex) {
                    if(!parseInt(iDisplayIndex.paid_amt)){
                        return "<select name=\"paid_amt\" class=\"form-control\" data='"+JSON.stringify(iDisplayIndex)+"'>\n\
                            <option value=\"0\">NO</option>\n\
                            <option value='"+iDisplayIndex.grandtotal+"'>YES</option>\n\
                        </select>";
                    } else {
                        return 'YES';
                    }
                }
            },
            {
                "data": "is_taken_name",
                "render": function(row, data, iDisplayIndex) {
                    if(!parseInt(iDisplayIndex.is_taken)){
                        return "<select name=\"is_taken\" class=\"form-control\" data='"+JSON.stringify(iDisplayIndex)+"'>\n\
                            <option value=\"0\">NO</option>\n\
                            <option value=\"1\">YES</option>\n\
                        </select>";
                    } else {
                        return 'YES';
                    }
                }
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    result += "<a href=\"" + __base_url + "admin/kantin/pos/cetak/" + iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-xs\" title=\"Print\" target=\"_blank\"><i class=\"fa fa-eye\"></i> Print</a>";
                    // result += "<button href=\"" + __base_url + "admin/kantin/order/read/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                    // result += "<button href=\"" + __base_url + "admin/kantin/order/update/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    // result += "<button href=\"" + __base_url + "admin/kantin/order/delete/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                    return result;
                }
            },
            
        ],
        "order": [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);


        },
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });

        },
    });

    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
        if(value.tanggal){
            value.tanggal = moment(value.tanggal, "DD/MM/YYYY").format("YYYY/MM/DD")
        }
        $.ajax({
            url: $(form).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(form).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
            },
            complete: function(e) {
            }
        });
    })

    $(document).on('change','select[name="is_taken"],select[name="paid_amt"]',function () {
        var thiss = $(this);
        var value = JSON.parse(thiss.attr('data'));
        value.is_taken = thiss.parents('tr').find('select[name="is_taken"]').val();
        value.paid_amt = thiss.parents('tr').find('select[name="paid_amt"]').val();
        swal({
                title: 'Are you sure?',
                //                            text: "You won't be able to revert this!",
                type: 'warning',
                // timer: 5000,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
                showLoaderOnConfirm: true,
                preConfirm: function (email) {
                    console.log(email)
                    return new Promise(function (resolve, reject) {
                        $.ajax({
                            url: __base_url + 'api/kantin/order/update',
                            data: {
                                data: JSON.stringify([value])
                            },
                            method: 'POST',
                            headers: {
                                'Authorization': localStorage.getItem("token")
                            },
                            success: function(data) {
                                resolve();
                            },
                            error: function(e) {
                            },
                            complete: function(e) {
                            }
                        });
                    })
                    
                },
            }).then(function (data) {}, function (dismiss) {
                if(dismiss && dismiss=='cancel'){
                    thiss.parents('tr').find('select[name="is_taken"]').val('0');
                    thiss.parents('tr').find('select[name="paid_amt"]').val('0');
                }
            });


        
        
    })


});
</script>