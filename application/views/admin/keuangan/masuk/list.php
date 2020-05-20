<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Transaksi Pemasukan</h3>
    </div>
    <form id="transaksikeuanganForm" method="post" action=""
        class="form-horizontal" style="padding: 10px;">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="id_kodegl" value="<?=CODE_KREDIT; ?>">
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
                    <label class="col-md-3">Jenis transaksi</label>
                    <div class="col-md-9">
                        <select name="id_jenistransaksi" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                            <option value="">Select</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3">Jurnal</label>
                    <div class="col-md-9">
                        <input name="jurnal" class="form-control readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Nominal</label>
                    <div class="col-md-9">
                        <input name="nominal" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3"> Keterangan</label>
                    <div class="col-md-9">
                        <textarea name="ket" class="form-control"></textarea>
                        <span class="help-block"></span>
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
</div>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Transaksi Pemasukan</h3>
    </div>
    <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tahun Buku</th>
                <th>Jenis Transaksi</th>
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


    function getRandom() {
        $(form + ' input[name="jurnal"]').val(moment().format('YYMMDDHHmmss'));
    }
    getRandom();
    
    function reset() {
        getRandom();
        $(form + ' input[name="id"]').val('');
        $(form + ' input[name="nominal"]').val('');
        $(form + ' textarea[name="ket"]').val('');
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
                    id_kodegl: '<?= CODE_KREDIT ?>'
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
        // Data.getKodeGL(form, ' select[name="id_kode_gl"]'),
        Data.getTahun(form, ' select[name="id_tahun"]'),
        Data.getJenisTransaksi(form, ' select[name="id_jenistransaksi"]',{
            is_active: 1, 
            id_kode_gl: '<?= CODE_KREDIT ?>',
            // where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")",
        }),
        // Data.getJurusan(form, ' select[name="id_jurusan"]'),
        // Data.getKelas(form, ' select[name="id_kelas"]'),
    ).done(function(usertype) {
        setTimeout(() => {

            $('select[name="id_a_thn"]').val(new Date().getFullYear());

        }, 300);
    });


    $('.btn-save').click(function (e) {
        e.preventDefault();
        

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
                id_jenistransaksi: {
                    required: true,
                },
                nominal: {
                    required: true,
                },
                ket: {
                    required: true,
                },
            },
        }).form();
        if ($("#transaksikeuanganForm").valid()) {
            var value = Main.objectifyForm($(form).serializeArray());
            value.detail = [];
            value.detail.push({
                nominal : value.nominal,
                id_skl : value.id_skl,
                ket : value.ket,
                id_itemtransaksi :0
            });
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
                    reset()
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
                })
            }
        })
    })

});
</script>





<script>
$(document).ready(function() {

    
})
</script>