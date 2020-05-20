<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Transaksi SPP</h3>
    </div>
    <form id="transaksikeuanganForm" method="post" action="<?=base_url('api/keuangan/transaksikeuangan/'.$action); ?>"
        class="form-horizontal" style="padding: 10px;">
        <input type="hidden" name="id" value="<?=$id; ?>">
        <input type="hidden" name="id_kodegl" value="<?=CODE_KREDIT; ?>">
        <input type="hidden" name="id_jenistransaksi" value="<?=JNS_TRANS_SPP; ?>">
        <input type="hidden" name="qty" value="1">
        <!-- input states -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3">Sekolah</label>
                    <div class="col-md-9">
                        <select name="id_skl" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                            <option value="">Select</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Tahun Buku</label>
                    <div class="col-md-9">
                        <select name="id_tahun" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                            <option value="">Select</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Jurnal</label>
                    <div class="col-md-9">
                        <input name="jurnal" class="form-control readonly">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                
                <div class="form-group">
                    <label class="col-md-3">Siswa</label>
                    <div class="col-md-9">
                        <div class="input-group input-group-sm">
                            <input name="nama_siswa" class="form-control readonly">
                            <input type="hidden" name="id_siswa">
                            <span class="input-group-btn">
                                <button type="button"
                                    class="btn btn-info btn-flat btn-carisiswa <?= !empty($id) ? 'readonly' : '' ?>">Cari!</button>
                            </span>
                            <span class="input-group-btn">
                                <button type="button"
                                    class="btn btn-success btn-flat btn-itemtrans <?= !empty($id) ? 'readonly' : '' ?>">Item Trans</button>
                            </span>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Nominal</label>
                    <div class="col-md-9">
                        <input name="nominal" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Keterangan</label>
                    <div class="col-md-9">
                        <textarea name="ket" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <button class="btn btn-primary btn-save">Submit</button>
                        <button class="btn btn-default btn-reset">Reset</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <br>
    <table id="mytabletransaksi" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Transaksi</th>
                <th>Nominal</th>
                <!-- <th>Keterangan</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div class="table-transaksi" style="padding:20px;display:none;"><label class="error" >Transaksi belum ada.</label></div>
</div>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Transaksi SPP</h3>
    </div>
    <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tahun Buku</th>
                <th>Jenis Transaksi</th>
                <th>Siswa</th>
                <th>No Jurnal</th>
                <th>Keterangan</th>
                <th>Nominal</th>
                <!-- <th>Is Active</th> -->
                <!-- <th>Created By</th>
                <th>Created Date</th>
                <th>Updated By</th>
                <th>Updated Date</th> -->
                <th>Action</th>
            </tr>
        </thead>

    </table>
</div>

<script>
$(document).ready(function() {
    var form = '#transaksikeuanganForm';


    function reIndex() {
        var no = 0;
        var nominal = 0;
        $("#mytabletransaksi tbody tr").each(function () {
            no += 1;
            $(this).find('td:nth(0)').text(no);
            nominal += parseInt($(this).attr('data-nominal'))
        })
        $(form + ' input[name="nominal"]').val(nominal)
    }


    function getRandom() {
        $(form + ' input[name="jurnal"]').val(moment().format('YYMMDDHHmmss'));
    }
    getRandom();


    function reset() {
        getRandom();
        $(form + ' input[name="id"]').val('');
        $(form + ' input[name="nama_siswa"]').val('');
        $(form + ' input[name="id_siswa"]').val('');
        $(form + ' input[name="nominal"]').val('');
        $(form + ' textarea[name="ket"]').val('');
        $('#mytabletransaksi tbody tr').remove()
    }

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
        buttons: [],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/keuangan/keuangan/json",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {

                $.extend(d, {
                    date: '',
                    id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                    id_kodegl: '<?= CODE_KREDIT ?>',
                    id_jenistransaksi: '<?= JNS_TRANS_SPP?>'
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
            {
                "data": "created_dt_name"
            },
            {
                "data": "tahun"
            },
            {
                "data": "jenis"
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "jurnal"
            },
            {
                "data": "ket",
            },
            {
                "data": "nominal"
            },
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
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    result += "<a href=\"" + __base_url +
                        "admin/keuangan/keuangan/cetak/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-xs\" title=\"Cetak\" target=\"_blank\"><i class=\"fa fa-eye\"></i> Cetak</a>";
                    result += "<button data-id='"+iDisplayIndex.id+"' class=\"btn btn-warning btn-updatex btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    result += "<button href=\"" + __base_url +
                        "admin/keuangan/keuangan/delete/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                    return result;
                }
            },
        ],
        "order": [
            [0, 'desc']
        ],
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

    var form = '#transaksikeuanganForm';
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getTahun(form, ' select[name="id_tahun"]'),
    ).done(function(usertype) {
        setTimeout(() => {

            // $('select[name="id_"]').val(new Date().getFullYear());

        }, 300);
    });


    $('select[name="id_tahun"]').change(function () {
        $('#mytableitem tbody tr').remove()
        var value = Main.objectifyForm($(form).serializeArray());
        if(value.id_tahun !='' && value.id_skl !=''){
            $.ajax({
                url: __base_url + "api/keuangan/itemtransaksi/read",
                data: {
                    data: JSON.stringify([{
                        id_skl: value.id_skl,
                        id_tahun: value.id_tahun
                    }])
                },
                method: $(form).attr('method'),
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function(data) {
                    $.each(data.data, function(i, value) {
                        $("#mytableitem")
                            .append($('<tr>').attr('data-id',value.id)
                                .append($('<td>').append(i + 1))
                                .append($('<td>').append('\n\
                                    <button \n\
                                    data-id_skl="'+value.id_skl+'" \n\
                                    data-id_itemtransaksi="'+value.id+'" \n\
                                    data-ket="'+value.pembayaran+'" \n\
                                    data-nominal="'+value.nominal+'" \n\
                                    class="btn btn-xs btn-pilih btn-warning" style="display:none;"><i class="fa fa-check-circle"></i></button>\n\
                                '))
                                .append($('<td>').append('<span class="label label-success label-lunas"  style="display:none;">Lunas</span>'))
                                .append($('<td>').append(value.pembayaran))
                                .append($('<td>').append("Rp. " + Main.numberWithCommas(
                                    value
                                    .nominal)))
                            )
                    })
                },
                
            });
        }
    })


    $(document).on('click', '.btn-pilihsiswa', function(e) {

        // dihilangkan saja dulu
        $('#mytableitem tbody tr .btn-pilih').hide();
        $('#mytableitem tbody tr .label-lunas').hide();




        var data = JSON.parse($(this).attr('data'));
        $(form + ' input[name="nama_siswa"]').val(data.nama_siswa);
        $(form + ' input[name="id_siswa"]').val(data.id_user);
        $('#myModalsiswa .close').trigger('click');
        var value = Main.objectifyForm($(form).serializeArray());


        $.ajax({
            url: __base_url + "api/data/keuanganread",
            data: {
                data: JSON.stringify([{
                    id_skl: value.id_skl,
                    id_tahun: value.id_tahun,
                    id_jenistransaksi: '<?= JNS_TRANS_SPP ?>',
                    id_siswa: value.id_siswa
                }])
            },
            method: $(form).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                console.log(data);
                var cek_id = [];
                $.each(data.data, function(i, value) {
                    cek_id.push(value.id_itemtransaksi)
                })
                console.log(cek_id)
                $('#mytableitem tbody tr').each(function () {
                    console.log($(this).attr('data-id'));
                    
                    if(cek_id.indexOf($(this).attr('data-id')) < 0){
                        $(this).find('.btn-pilih').show();
                    } else {
                        $(this).find('.label-lunas').show();
                    }
                })
                $('#myItemTransaksi').modal('show');
            }
        })



    })


    $('.btn-itemtrans').click(function () {
        $('#myItemTransaksi').modal('show')
    })

    $('.btn-cari').click(function (e) {
        e.preventDefault()
    })


    $(document).on('click','.btn-pilih',function () {
        var id_skl = $(this).attr('data-id_skl');
        var id_itemtransaksi = $(this).attr('data-id_itemtransaksi');
        var ket = $(this).attr('data-ket');
        var nominal = $(this).attr('data-nominal');

        var cek_id = true;
        $("#mytabletransaksi tbody tr").each(function () {
            if(id_itemtransaksi == $(this).attr('data-id')){
                cek_id = false;
            }
        })

        if(cek_id){
            $("#mytabletransaksi")
                        .append($('<tr>')
                                .attr('data-id',id_itemtransaksi)
                                .attr('data-nominal',nominal)
                                .attr('data-ket',ket)
                                .attr('data-id_skl',id_skl)
                            .append($('<td>').append(1))
                            .append($('<td>').append(ket))
                            .append($('<td>').append("Rp. " + Main.numberWithCommas(nominal)))
                            // .append($('<td>').append('<textarea class="form-control"></textarea>'))
                            .append($('<td>').append('<button class="btn btn-xs btn-remove btn-danger"><i class="fa fa-minus-circle"></i></button>'))
                        )

                reIndex();
        }
        
    })

    $(document).on('click','.btn-remove',function () {
        $(this).parents('tr').remove();
        reIndex();
    })



    $('.btn-save').click(function (e) {
        e.preventDefault();
        $('.table-transaksi').hide();
        

        $("#transaksikeuanganForm").validate({
            rules: {
                id_skl: {
                    required: true,
                },
                jurnal: {
                    required: true,
                },
                id_tahun: {
                    required: true,
                },
                nama_siswa: {
                    required: true,
                },
            },
        }).form();

        if($('#mytabletransaksi tbody tr').length==0){
            $('.table-transaksi').show();
        }

        if ($("#transaksikeuanganForm").valid()) {
            var value = Main.objectifyForm($(form).serializeArray());
            value.detail = [];
            value.nominal = 0;
            value.qty = 0;
            $('#mytabletransaksi tbody tr').each(function () {
                value.detail.push({
                    nominal : $(this).attr('data-nominal'),
                    id_skl : $(this).attr('data-id_skl'),
                    id_itemtransaksi : $(this).attr('data-id'),
                    ket : $(this).attr('data-ket'),
                })
                value.nominal += parseInt($(this).attr('data-nominal'));
                value.qty +=1;
            })

            console.log(value)
            var url = __base_url + "api/keuangan/keuangan/create";
            if(value.id){
                url = __base_url + "api/keuangan/keuangan/update";
            }
            $.ajax({
                url: url,
                data: {
                    data: JSON.stringify([value])
                },
                method: $(form).attr('method'),
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function(data) {
                    reset();
                    $('#mytable').DataTable().ajax.reload();
                },
                error: function(e) {
                    Main.autoSetError(form, e.responseJSON.error)
                },
                complete: function(e) {

                }
            });
        }

    })

    $(document).on('click','.btn-updatex',function () {
        reset();
        $.ajax({
            url: __base_url + "api/data/keuanganread",
            data: {
                data: JSON.stringify([{ id:$(this).attr('data-id') }])
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function(i, value) {
                    Main.autoSetValue(form, value);

                    $("#mytabletransaksi")
                        .append($('<tr>')
                                .attr('data-id',value.id_itemtransaksi)
                                .attr('data-nominal',value.nominal_detail)
                                .attr('data-ket',value.ket_detail)
                                .attr('data-id_skl',value.id_skl)
                            .append($('<td>').append(1))
                            .append($('<td>').append(value.ket_detail))
                            .append($('<td>').append("Rp. " + Main.numberWithCommas(value.nominal_detail)))
                            // .append($('<td>').append('<textarea class="form-control"></textarea>'))
                            .append($('<td>').append('<button class="btn btn-xs btn-remove btn-danger"><i class="fa fa-minus-circle"></i></button>'))
                        )

                    reIndex();
                })

                $(form +' select[name="id_tahun"]').trigger('change');
                $('.btn-pilihsiswa').trigger('click');
                
            }
        })
    })

});
</script>





<!--modal bootstrap-->
<div class="modal fade" id="myItemTransaksi" role="dialog" aria-labelledby="myModaluserLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="alert alert-dismissible fade in" role="alert">
                        <h4 class="modal-title text-center">Item Transaksi</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <table id="mytableitem" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>