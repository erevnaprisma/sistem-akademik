<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jenis Transaksi</th>
            <th>No Jurnal</th>
            <th>Keterangan</th>
            <th>Nominal</th>
            <th>Is Active</th>
            <!-- <th>Created By</th>
            <th>Created Date</th>
            <th>Updated By</th>
            <th>Updated Date</th> -->
            <th>Action</th>
        </tr>
    </thead>

</table>

<script>
$(document).ready(function() {
    var form = '#transaksikeuanganForm';

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
            text: "Create",
            className: "btn btn-create btn-success fa fa-plus",
            init: function(a, b, c) {
                b.attr('href', __base_url + 'admin/keuangan/transaksikeuangan/create');
                b.attr('title', 'CREATE');
                // b.attr('data-zoom', 'modal-xl');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/keuangan/transaksikeuangan/jurnaljson",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {

                $.extend(d, {
                    date: '',
                    id_skl: JSON.parse(Main.getselectedSchool()).join(','),
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
                "data": "tgl"
            },
            {
                "data": "jenis"
            },
            {
                "data": "jurnal"
            },
            {
                "data": "group_ket",
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    return "<div class='heighttd'>" + iDisplayIndex.group_ket + "</div>";
                }
            },
            {
                "data": "nominal"
            },
            {
                "data": "is_active_name"
            },
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
                        "admin/keuangan/transaksikeuangan/cetak/" +
                        iDisplayIndex.jurnal +
                        "\" class=\"btn btn-info btn-xs\" title=\"Cetak\" target=\"_blank\"><i class=\"fa fa-eye\"></i> Cetak</a>";
                    result += "<button href=\"" + __base_url +
                        "admin/keuangan/transaksikeuangan/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    // result += "<button href=\"" + __base_url +
                    //     "admin/keuangan/transaksikeuangan/delete/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
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

    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
        value.id_aka = value.id_jurusan;
        value.id_kls = value.id_kelas;
        if (value.tanggal) {
            value.tanggal = moment(value.tanggal, "DD/MM/YYYY").format("YYYY/MM/DD")
        }

        var url = __base_url + "api/keuangan/transaksikeuangan/create";
        if(value.id){
            url = __base_url + "api/keuangan/transaksikeuangan/update";
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
                console.log(data)
                $('#mytable').DataTable().ajax.reload(null, false);
                var detail = data.data[0];
                $(form + ' input[name="jurnal"]').val(detail.jurnal);
                // $("#transaksikeuanganForm")[0].reset();
                $(form + ' select[name="id_skl"]').addClass('readonly');
                $(form + ' select[name="id_kode_gl"]').addClass('readonly');
                $(form + ' select[name="id_a_thn"]').addClass('readonly');
                $(form + ' input[name="nama_siswa"]').addClass('readonly');
                $(form + ' select[name="jenis_transaksi"]').addClass('readonly');
                $(form + ' select[name="id_jurusan"]').addClass('readonly');
                $(form + ' select[name="id_kelas"]').addClass('readonly');
                $(form + ' select[name="id_siswa"]').addClass('readonly');
                $(form + ' textarea[name="ket"]').val('');
                $(form + ' input[name="nominal"]').val('');

                $(form + ' input[name="id"]').val('');
                Data.getDetailTransaksi();
            },
            error: function(e) {
                Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click','.btn-updateform',function (e) {
        var data = JSON.parse($(this).attr('data'));
        console.log(data)
        Main.autoSetValue(form, data);
    })

    $(document).on('click','.btn-pilihsiswa',function (e) {
        var data = JSON.parse($(this).attr('data'));
        $(form + ' input[name="nama_siswa"]').val(data.nama_siswa);
        $(form + ' input[name="id_siswa"]').val(data.id_user);
        $(form + ' input[name="id_kls"]').val(data.id);

        $('#myModalsiswa .close').trigger('click');
    })
    
    // $(document).on('click','.btn-pilihpegawai',function (e) {
    //     var data = JSON.parse($(this).attr('data'));
    //     console.log(data)
    //     $(form + ' input[name="nama_pegawai"]').val(data.nama);
    //     $(form + ' input[name="id_peg"]').val(data.id);
    //     $('#myModalpegawai .close').trigger('click');
    // })

    $(document).on('change',form + ' select[name="id_jurusan"]',function () {
        $(form + ' select[name="id_kelas"] option').not(':first').remove();
        var params = {
            is_active: 1, 
            where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
        };
        if($(this).val()){
            params.id_jurusan = $(this).val();
        }
        Data.getKelas(form, ' select[name="id_kelas"]' , params);

        $(form + ' select[name="id_siswa"] option').not(':first').remove();
    })

    $(document).on('change',form + ' select[name="id_kelas"]',function () {
        $(form + ' select[name="id_siswa"] option').not(':first').remove();
        if($(this).val()){
            var params = {
                where: " mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ") " +
                " and id_kelas = " + $(this).val() +
                " and is_active = 1"
            }
            if($(form + ' select[name="id_jurusan"]').val()){
                params.where = params.where + ' and id_jurusan = '+$(this).val();
            }
            Data.getSiswaNative(form, ' select[name="id_siswa"]' , params);
        }
    })

});
</script>