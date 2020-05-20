<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a class="kelas" href="#tab_1" data-toggle="tab" aria-expanded="true">Kelas</a></li>
        <li class=""><a class="guru" href="#tab_2" data-toggle="tab" aria-expanded="false">Guru</a></li>
        <li class=""><a class="event" href="#tab_3" data-toggle="tab" aria-expanded="false">Event</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Jurusan</th>
                        <th>Semester</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Is Active</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Updated By</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <table id="mytable2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Semester</th>
                        <th>Guru</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Is Active</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Updated By</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <table id="mytable3" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Semester</th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Is Active</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Updated By</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>



<script>
$(document).ready(function() {


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

    $(document).on('click', '.kelas', function(e) {
        e.preventDefault();
        kelas();
    })
    $(document).on('click', '.guru', function(e) {
        e.preventDefault();
        guru();
    })
    $(document).on('click', '.event', function(e) {
        e.preventDefault();
        event();
    })

    // karena yang muncul pertama kali ini
    kelas();

    function kelas() {
        if ($.fn.dataTable.isDataTable("#mytable")) {
            $('#mytable').DataTable().ajax.reload(null, false);
        } else {


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
                        b.attr('href', __base_url +
                        'admin/akademik/jadwalpelajaran/create');
                        b.attr('title', 'CREATE');
                    },
                }, ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/akademik/jadwalpelajaran/json",
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
                        "data": "jurusan_name"
                    },
                    {
                        "data": "semester_name"
                    },
                    {
                        "data": "kelas_name"
                    },
                    {
                        "data": "mapel_name"
                    },
                    {
                        "data": "hari_name"
                    },
                    {
                        "data": "pkl_mulai"
                    },
                    {
                        "data": "pkl_selesai"
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
                                "admin/akademik/jadwalpelajaran/read/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                            result += "<button href=\"" + __base_url +
                                "admin/akademik/jadwalpelajaran/update/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                            result += "<button href=\"" + __base_url +
                                "admin/akademik/jadwalpelajaran/delete/" +
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
        }
    }

    function guru() {
        if ($.fn.dataTable.isDataTable("#mytable2")) {
            $('#mytable2').DataTable().ajax.reload(null, false);
        } else {
            $('#mytable2').DataTable({
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
                        b.attr('href', __base_url + 'admin/anjungan/jadwalguru/create');
                        b.attr('title', 'CREATE');
                    },
                }, ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/anjungan/jadwalguru/json",
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
                        var dt_params = $('#mytable2').data('dt_params');
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
                        "data": "semester_name"
                    },
                    {
                        "data": "guru_name"
                    },
                    {
                        "data": "hari_name"
                    },
                    {
                        "data": "pkl_mulai"
                    },
                    {
                        "data": "pkl_selesai"
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
                                "admin/anjungan/jadwalguru/read/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/jadwalguru/update/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/jadwalguru/delete/" +
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
                    $('#mytable2_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                        });

                },
            });
        }
    }

    function event() {
        if ($.fn.dataTable.isDataTable("#mytable3")) {
            $('#mytable3').DataTable().ajax.reload(null, false);
        } else {
            $('#mytable3').DataTable({
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
                        b.attr('href', __base_url + 'admin/anjungan/jadwalevent/create');
                        b.attr('title', 'CREATE');
                    },
                }, ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/anjungan/jadwalevent/json",
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
                        var dt_params = $('#mytable3').data('dt_params');
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
                        "data": "semester_name"
                    },
                    {
                        "data": "tanggal_name"
                    },
                    {
                        "data": "pkl_mulai"
                    },
                    {
                        "data": "pkl_selesai"
                    },
                    {
                        "data": "kegiatan"
                    },
                    {
                        "data": "lokasi"
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
                                "admin/anjungan/jadwalevent/read/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/jadwalevent/update/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                            result += "<button href=\"" + __base_url +
                                "api/anjungan/jadwalevent/delete/" +
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
                    $('#mytable3_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                        });

                },
            });
        }
    }



    var jadwalpelajaranForm = '#jadwalpelajaranForm';
    $(document).on('click', jadwalpelajaranForm + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(jadwalpelajaranForm).serializeArray());
        value.is_active = $(jadwalpelajaranForm + ' input[name="is_active"]').val();
        $.ajax({
            url: $(jadwalpelajaranForm).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(jadwalpelajaranForm).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
                kelas();
            },
            error: function(e) {
                Main.autoSetError(jadwalpelajaranForm, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    var jadwalguruForm = '#jadwalguruForm';

    $(document).on('click', '.btn-pilihguru', function(e) {
        var data = JSON.parse($(this).attr('data'));
        console.log(data);
        
        $(jadwalguruForm + ' input[name="nama_guru"]').val(data.username);
        $(jadwalguruForm + ' input[name="id_guru"]').val(data.id_user);
        $('#myModalguru .close').trigger('click');
    })

    $(document).on('click', jadwalguruForm + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(jadwalguruForm).serializeArray());
        value.is_active = $(jadwalguruForm + ' input[name="is_active"]').val();
        $.ajax({
            url: $(jadwalguruForm).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(jadwalguruForm).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
                guru();
            },
            error: function(e) {
                Main.autoSetError(jadwalguruForm, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    var jadwaleventForm = '#jadwaleventForm';
    $(document).on('click', jadwaleventForm + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(jadwaleventForm).serializeArray());
        value.is_active = $(jadwaleventForm + ' input[name="is_active"]').val();
        value.tanggal = moment(value.tanggal, "DD/MM/YYYY").format("YYYY/MM/DD");
        $.ajax({
            url: $(jadwaleventForm).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(jadwaleventForm).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
                event();
            },
            error: function(e) {
                Main.autoSetError(jadwaleventForm, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })






    // $(document).on('click', form + ' .btn-save', function(e) {
    //     e.preventDefault();
    //     var btn = $(this)
    //     var value = Main.objectifyForm($(form).serializeArray());
    //     value.is_active = $(form + ' input[name="is_active"]').val();
    //     if (value.tanggal) {
    //         value.tanggal = moment(value.tanggal, "DD/MM/YYYY").format("YYYY/MM/DD");
    //         console.log(value.tanggal);
    //     }
    //     $.ajax({
    //         url: $(form).attr('action'),
    //         data: {
    //             data: JSON.stringify([value])
    //         },
    //         method: $(form).attr('method'),
    //         headers: {
    //             'Authorization': localStorage.getItem("token")
    //         },
    //         success: function(data) {
    //             $('#myModal button.close').trigger('click');
    //             $('#mytable').DataTable().ajax.reload(null, false);
    //         },
    //         error: function(e) {
    //             Main.autoSetError(form, e.responseJSON.error)
    //         },
    //         complete: function(e) {

    //         }
    //     });
    // })






    // $(document).on('click', form + ' .btn-save', function(e) {
    //     e.preventDefault();
    //     var btn = $(this)
    //     var value = Main.objectifyForm($(form).serializeArray());
    //     value.is_active = $(form + ' input[name="is_active"]').val();
    //     if (value.tanggal) {
    //         value.tanggal = moment(value.tanggal, "DD/MM/YYYY").format("YYYY/MM/DD");
    //         console.log(value.tanggal);
    //     }
    //     $.ajax({
    //         url: $(form).attr('action'),
    //         data: {
    //             data: JSON.stringify([value])
    //         },
    //         method: $(form).attr('method'),
    //         headers: {
    //             'Authorization': localStorage.getItem("token")
    //         },
    //         success: function(data) {
    //             $('#myModal button.close').trigger('click');
    //             $('#mytable').DataTable().ajax.reload(null, false);
    //         },
    //         error: function(e) {
    //             Main.autoSetError(form, e.responseJSON.error)
    //         },
    //         complete: function(e) {

    //         }
    //     });
    // })


});
</script>