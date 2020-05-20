<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <!-- <th>Sekolah</th> -->
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
    var form1 = '#kenaikanKelasForm';

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
        buttons: [
            {
                text: "Create",
                className: "btn btn-create btn-success fa fa-plus",
                init: function(a, b, c) {
                    b.attr('href', __base_url + 'admin/akademik/kenaikan_kelas/create');
                    b.attr('title', 'CREATE');
                },
            },
            {
                text: "Kenaikan",
                className: "btn btn-create btn-warning fa fa-plus",
                init: function(a, b, c) {
                    b.attr('href', __base_url + 'admin/akademik/kenaikan_kelas/naik');
                    b.attr('title', 'Kenaikan');
                },
            },
            {
                text: "Siswa Baru",
                className: "btn btn-create btn-primary fa fa-plus",
                init: function(a, b, c) {
                    b.attr('href', __base_url + 'admin/akademik/kenaikan_kelas/siswa_baru');
                    b.attr('title', 'Siswa Baru');
                },
            },
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/akademik/kenaikan_kelas/json",
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
            // {
            //     "data": "nm_skl"
            // },
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
                        "admin/akademik/kenaikan_kelas/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                    result += "<button href=\"" + __base_url +
                        "admin/akademik/kenaikan_kelas/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                    result += "<button href=\"" + __base_url +
                        "admin/akademik/kenaikan_kelas/delete/" +
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




    function getKelasSiswa1(params) {
        $('#dvExcel1 tbody tr').remove()
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
                    $('#dvExcel1 tbody')
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


    function checkButton1() {
        setTimeout(() => {
            var id_tahun = $(form1 + ' .sebelum select[name="id_tahun"]').val();
            var id_skl = $(form1 + ' .sebelum select[name="id_skl"]').val();
            var id_semester = $(form1 + ' .sebelum select[name="id_semester"]').val();
            // var id_jurusan = $(form1 + ' .sebelum select[name="id_jurusan"]').val();
            var id_kelas = $(form1 + ' .sebelum select[name="id_kelas"]').val();
            if (id_skl && id_skl && id_semester  && id_kelas) {
                $(form1 + ' .sebelum .btn-cari').prop('disabled', false);
            } else {
                $(form1 + ' .sebelum .btn-cari').prop('disabled', true);
            }
        }, 1000);
    }
    $(document).on('change', form1 + ' .sebelum select[name="id_tahun"], ' + form1 +
        ' .sebelum select[name="id_skl"], ' + form1 +
        ' .sebelum select[name="id_semester"], ' + form1 + ' .sebelum select[name="id_jurusan"], ' + form1 +
        ' .sebelum select[name="id_kelas"]',
        function() {
            checkButton1();
        })

    $(document).on('click', form1 + ' .sebelum .btn-cari', function(e) {
        e.preventDefault();
        getKelasSiswa1({
            id_tahun: $(form1 + ' .sebelum select[name="id_tahun"]').val(),
            id_skl: $(form1 + ' .sebelum select[name="id_skl"]').val(),
            id_semester: $(form1 + ' .sebelum select[name="id_semester"]').val(),
            id_jurusan: $(form1 + ' .sebelum select[name="id_jurusan"]').val(),
            id_kelas: $(form1 + ' .sebelum select[name="id_kelas"]').val(),
            is_active: 1,
            is_naik: 0,
        });
    })




    function getKelasSiswa2(params) {
        $('#dvExcel2 tbody tr').remove()
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
                    $('#dvExcel2 tbody')
                        .append($('<tr>')
                            .append($('<td>').append(i + 1))
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


    function checkButton2() {
        setTimeout(() => {
            var id_tahun = $(form1 + ' .sesudah select[name="id_tahun"]').val();
            var id_skl = $(form1 + ' .sesudah select[name="id_skl"]').val();
            var id_semester = $(form1 + ' .sesudah select[name="id_semester"]').val();
            // var id_jurusan = $(form1 + ' .sesudah select[name="id_jurusan"]').val();
            var id_kelas = $(form1 + ' .sesudah select[name="id_kelas"]').val();
            if (id_skl && id_skl && id_semester  && id_kelas) {
                $(form1 + ' .sesudah .btn-cari').prop('disabled', false);
                $(form1 + ' .sesudah .btn-save').prop('disabled', false);
            } else {
                $(form1 + ' .sesudah .btn-cari').prop('disabled', true);
            }
        }, 1000);
    }
    $(document).on('change', form1 + ' .sesudah select[name="id_tahun"], ' + form1 +
        ' .sesudah select[name="id_skl"], ' + form1 +
        ' .sesudah select[name="id_semester"], ' + form1 + ' .sesudah select[name="id_jurusan"], ' + form1 +
        ' .sesudah select[name="id_kelas"]',
        function() {
            checkButton2();
        })

    $(document).on('click', form1 + ' .sesudah .btn-cari', function(e) {
        e.preventDefault();
        getKelasSiswa2({
            id_tahun: $(form1 + ' .sesudah select[name="id_tahun"]').val(),
            id_skl: $(form1 + ' .sesudah select[name="id_skl"]').val(),
            id_semester: $(form1 + ' .sesudah select[name="id_semester"]').val(),
            id_jurusan: $(form1 + ' .sesudah select[name="id_jurusan"]').val(),
            id_kelas: $(form1 + ' .sesudah select[name="id_kelas"]').val(),
            is_active: 1,
        });
    })








    function addSiswa(thiss) {
        $("#dvExcel1 tbody tr").each(function(index) {
            var thiss = $(this);

            if (thiss.find('input[name="ambil[]"]').is(':checked')) {
                var ambil = JSON.parse(thiss.find('input[name="ambil[]"]').attr("data"));
                var value = {
                    id_siswa: ambil.id_siswa,
                    id_tahun: $(form1 + ' .sesudah select[name="id_tahun"]').val(),
                    id_skl: $(form1 + ' .sesudah select[name="id_skl"]').val(),
                    id_semester: $(form1 + ' .sesudah select[name="id_semester"]').val(),
                    id_jurusan: $(form1 + ' .sesudah select[name="id_jurusan"]').val(),
                    id_kelas: $(form1 + ' .sesudah select[name="id_kelas"]').val(),
                    status: 1,
                }
                $.ajax({
                    url: __base_url + "api/akademik/kenaikan_kelas/create",
                    data: {
                        data: JSON.stringify([value])
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    success: function(data) {
                        $('#dvExcel2 tbody')
                        .append($('<tr>')
                            .append($('<td>').append(""))
                            .append($('<td>').append(ambil.nama_siswa))
                            .append($('<td>').append(ambil.email))
                            .append($('<td>').append(ambil.no_induk))
                            .append($('<td>').append(ambil.nisn))
                            .append($('<td>').append(ambil.jenis_kelamin))
                        );

                        $('#dvExcel2 tbody tr').each(function (a,b) {
                            $(this).find('td:nth(0)').text(a+1)
                        })
                    },
                    error: function(e) {},
                    complete: function(e) {

                    },
                });
            }
        });
    }

    function updateSiswa(thiss) {
        $("#dvExcel1 tbody tr").each(function(index) {
            var thiss = $(this);

            if (thiss.find('input[name="ambil[]"]').is(':checked')) {
                var value = JSON.parse(thiss.find('input[name="ambil[]"]').attr("data"));
                value.is_naik = 1;
                $.ajax({
                    url: __base_url + "api/akademik/kenaikan_kelas/update",
                    data: {
                        data: JSON.stringify([value])
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    success: function(data) {
                        thiss.remove();
                        $('#dvExcel1 tbody tr').each(function (a,b) {
                            $(this).find('td:nth(0)').text(a+1)
                        })
                    },
                    error: function(e) {},
                    complete: function(e) {

                    },
                });
            }
        });
    }


    $(document).on('click', form1 + ' .sesudah .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)

        $.when(
            addSiswa($(this))
        ).done(function (params) {
            updateSiswa($(this))
        })

    })












    $(document).on('change', form1 + ' select[name="id_tahun"], ' + form1 + ' select[name="id_skl"], ' + form1 +
        ' select[name="id_semester"], ' + form1 + ' select[name="id_jurusan"], ' + form1 +
        ' select[name="id_kelas"]',
        function() {
            checkButton();
        })


    $(document).on('click', form1 + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form1).serializeArray());
        value.is_active = $(form1 + ' input[name="is_active"]').val();
        $.ajax({
            url: $(form1).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(form1).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {

            },
            error: function(e) {

            },
            complete: function(e) {

            }
        });
    })















    function getKelasSiswa() {
        $('#dvExcel tbody tr').remove();
        var params = Main.objectifyForm($(formsiswabaru).serializeArray());
        $.ajax({
            url: __base_url + "api/akademik/kenaikan_kelas/getsiswabaru",
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
                            .append($('<td>').append(value.sekolah))
                            .append($('<td>').append(value.name))
                            .append($('<td>').append(value.email))
                            .append($('<td>').append(value.no_induk))
                            .append($('<td>').append(value.nisn))
                            .append($('<td>').append(value.jenis_kelamin))
                            .append($('<td>').append(value.angkatan))
                            .append($('<td>').append(value.hp_siswa))
                            .append($('<td>').append(value.hp_ortu_1))
                            .append($('<td>').append(value.hp_ortu_2))
                            .append($('<td>').append(value.email_ortu_1))
                            .append($('<td>').append(value.email_ortu_2))
                        )
                })
            }
        })
    }

    var formsiswabaru = '#siswaBaruForm';

    function checkButton() {
        setTimeout(() => {
            var id_tahun = $(formsiswabaru + ' select[name="id_tahun"]').val();
            var id_skl = $(formsiswabaru + ' select[name="id_skl"]').val();
            var id_semester = $(formsiswabaru + ' select[name="id_semester"]').val();
            // var id_jurusan = $(formsiswabaru + ' select[name="id_jurusan"]').val();
            var id_kelas = $(formsiswabaru + ' select[name="id_kelas"]').val();
            if (id_skl && id_skl && id_semester  && id_kelas) {
                $(formsiswabaru + ' .btn-cari').prop('disabled', false);
                $(formsiswabaru + ' .btn-save-upload').prop('disabled', false);
            } else {
                $(formsiswabaru + ' .btn-cari').prop('disabled', true);
                $(formsiswabaru + ' .btn-save-upload').prop('disabled', true);
            }
        }, 1000);
    }
    $(document).on('change', formsiswabaru + ' select[name="id_tahun"], ' + formsiswabaru +
        ' select[name="id_skl"], ' + formsiswabaru +
        ' select[name="id_semester"], ' + formsiswabaru + ' select[name="id_jurusan"], ' + formsiswabaru +
        ' select[name="id_kelas"]',
        function() {
            checkButton();
        })

    $(document).on('click', formsiswabaru + ' .btn-cari', function(e) {
        e.preventDefault();
        getKelasSiswa();
    })


    $(document).on('click', formsiswabaru + ' .btn-save-upload', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(formsiswabaru).serializeArray());
        value.is_active = $(formsiswabaru + ' input[name="is_active"]').val();


        $("#dvExcel tbody tr").each(function(index) {
            var thiss = $(this);

            if (thiss.find('input[name="ambil[]"]').is(':checked')) {
                var ambil = JSON.parse(thiss.find('input[name="ambil[]"]').attr("data"));
                value.id_siswa = ambil.id;
                // value.status = ambil.id;
                // value.keterangan = ambil.id;
                $.ajax({
                    url: __base_url + "api/akademik/kenaikan_kelas/simpansiswabaru",
                    data: {
                        data: JSON.stringify([value])
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    success: function(data) {
                        thiss.remove();
                    },
                    error: function(e) {},
                    complete: function(e) {

                    },
                });
            }



        });
    })




    $(document).on('click','.btn-pilihsiswa',function (e) {
        var data = JSON.parse($(this).attr('data'));
        $(form + ' input[name="nama_siswa"]').val(data.nama_siswa);
        $(form + ' input[name="id_siswa"]').val(data.id_user);

        $('#myModalsiswa .close').trigger('click');
    })

    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
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