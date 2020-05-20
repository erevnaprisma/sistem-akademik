<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Sekolah</th>
            <th>Semester</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Siswa</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Is Active</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Updated By</th>
            <th>Updated Date</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var form = '#kelulusanForm';

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
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
        dom: "lBfrtip",
        buttons: [{
            text: "Create",
            className: "btn btn-create btn-success fa fa-plus",
            init: function(a, b, c) {
                b.attr('href', __base_url + 'admin/akademik/kelulusan/create');
                b.attr('title', 'CREATE');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/akademik/kelulusan/json",
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
                "data": "tahun"
            },
            {
                "data": "nm_skl"
            },
            {
                "data": "semester"
            },
            {
                "data": "jurusan"
            },
            {
                "data": "nama_kelas"
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "status"
            },
            {
                "data": "keterangan"
            },
            {
                "data": "is_active_name"
            },
            {
                "data": "created_by_name"
            },
            {
                "data": "created_dt"
            },
            {
                "data": "updated_by_name"
            },
            {
                "data": "updated_dt"
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    result += "<button href=\"" + __base_url +
                        "admin/akademik/kelulusan/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                    result += "<button href=\"" + __base_url +
                        "admin/akademik/kelulusan/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                    result += "<button href=\"" + __base_url +
                        "admin/akademik/kelulusan/delete/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
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
        if (value.tanggal) {
            value.tanggal = moment(value.tanggal, "DD/MM/YYYY").format("YYYY/MM/DD");
            console.log(value.tanggal);
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
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    function getKelasSiswa(params) {
        $('#dvExcel tbody tr').remove()
        $.ajax({
            url: __base_url + "api/akademik/kenaikan_kelas/read",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $('#dvExcel tbody')
                        .append($('<tr>')
                            .append($('<td>').append(i + 1))
                            .append($('<td>').append(
                                "<input type=\"checkbox\" name=\"ambil[]\"] data='" +
                                JSON.stringify(value) + "'>"))
                            .append($('<td>').append(value.nama_siswa))
                            .append($('<td>').append(value.email))
                            .append($('<td>').append(value.no_induk))
                            .append($('<td>').append(value.nisn))
                            .append($('<td>').append(value.jenis_kelamin))
                        )
                })
            }
        })
    }

    function checkButton() {
        setTimeout(() => {
            var id_tahun = $(form + ' select[name="id_tahun"]').val();
            var id_skl = $(form + ' select[name="id_skl"]').val();
            var id_semester = $(form + ' select[name="id_semester"]').val();
            // var id_jurusan = $(form + ' select[name="id_jurusan"]').val();
            var id_kelas = $(form + ' select[name="id_kelas"]').val();
            if (id_skl && id_skl && id_semester && 
            // id_jurusan && 
            id_kelas) {
                $(form + ' .btn-cari').prop('disabled', false);
            } else {
                $(form + ' .btn-cari').prop('disabled', true);
            }
        }, 1000);
    }

    $(document).on('change', form + '  select[name="id_tahun"], ' + form + '  select[name="id_skl"], ' + form +
        '  select[name="id_semester"], ' + form + '  select[name="id_jurusan"], ' + form +
        '  select[name="id_kelas"]',
        function() {
            checkButton();
        })

    $(document).on('click', form + ' .btn-cari', function(e) {
        e.preventDefault();
        getKelasSiswa({
            id_tahun: $(form + ' select[name="id_tahun"]').val(),
            id_skl: $(form + ' select[name="id_skl"]').val(),
            id_semester: $(form + ' select[name="id_semester"]').val(),
            id_jurusan: $(form + ' select[name="id_jurusan"]').val(),
            id_kelas: $(form + ' select[name="id_kelas"]').val(),
            is_active: 1,
        });
    })



    $(document).on('click', form + ' .btn-save-upload', function(e) {
        e.preventDefault();
        var btn = $(this)
        
        $("#dvExcel tbody tr").each(function(index) {
            var thiss = $(this);
            thiss.attr('class', '');
            if (thiss.find('input[name="ambil[]"]').is(':checked')) {
                var value = JSON.parse(thiss.find('input[name="ambil[]"]').attr("data"));
                delete value.id;
                $.ajax({
                    url: __base_url + "api/akademik/kelulusan/create",
                    data: {
                        data: JSON.stringify([value])
                    },
                    method: $(form).attr('method'),
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    success: function(data) {
                        thiss.addClass('bg bg-green');
                    },
                    error: function(e) {
                        thiss.addClass('bg bg-red');
                    },
                    complete: function(e) {

                    },
                    async: false

                });

            }
        });

        // $('#myModal button.close').trigger('click');
        $('#mytable').DataTable().ajax.reload(null, false);
    })

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
    })

});
</script>

