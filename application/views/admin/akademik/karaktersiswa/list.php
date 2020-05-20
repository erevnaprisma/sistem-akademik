<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a class="note" href="#tab_1" data-toggle="tab" aria-expanded="true">Penilaian Diri</a></li>
        <li class=""><a class="galeri" href="#tab_2" data-toggle="tab" aria-expanded="false">Penilaian Teman</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Mapel</th>
                        <th>Siswa</th>
                        <th>Penilaian</th>
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
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Mapel</th>
                        <th>Siswa</th>
                        <th>Penilaian</th>
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
    </div>
    <!-- /.tab-content -->
</div>


<script>
$(document).ready(function() {
    var form = '#karaktersiswaForm';

    $('.nav-tabs-custom ul li:nth(1)').click(function() {
        mytable2();
    })

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

    mytable();

    function mytable(params) {
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
                    b.attr('href', __base_url + 'admin/akademik/karaktersiswa/create?flag=diri');
                    b.attr('title', 'CREATE');
                },
            }, ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": __base_url + "api/akademik/karaktersiswa/json",
                "type": "POST",
                "headers": {
                    'Authorization': localStorage.getItem("token")
                },
                "data": function(d) {


                    var params = {
                        date: '',
                        flag: 'diri',
                        id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                    };

                    if(Main.getCurrentUser().user_type_id =='<?= USER_TYPE_SISWA ?>'){
                        params.id_user = Main.getCurrentUser().id;
                    }
                    $.extend(d, params);
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
                    "data": "semester"
                },
                {
                    "data": "jurusan"
                },
                {
                    "data": "nama_kelas"
                },
                {
                    "data": "tanggal_name"
                },
                {
                    "data": "mapel"
                },
                {
                    "data": "nama_siswa"
                },

                {
                    "data": "penilaian"
                },
                {
                    "data": "is_active_name"
                },
                {
                    "data": "created_by_name"
                },
                {
                    "data": "created_dt_name"
                },
                {
                    "data": "updated_by_name"
                },
                {
                    "data": "updated_dt_name"
                },
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "render": function(row, data, iDisplayIndex) {
                        var result = "";
                        result += "<button href=\"" + __base_url +
                            "admin/akademik/karaktersiswa/read/" +
                            iDisplayIndex.id +
                            "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                        result += "<button href=\"" + __base_url +
                            "admin/akademik/karaktersiswa/update/" +
                            iDisplayIndex.id +"?flag=diri"+
                            "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                        result += "<button href=\"" + __base_url +
                            "admin/akademik/karaktersiswa/delete/" +
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

    function mytable2() {
        if ($.fn.dataTable.isDataTable('#mytable2')) {
            $('#mytable2').DataTable().ajax.reload(null, false);
        } else {


            $('#mytable2').DataTable({
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
                        b.attr('href', __base_url + 'admin/akademik/karaktersiswa/create?flag=teman');
                        b.attr('title', 'CREATE');
                    },
                }, ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/akademik/karaktersiswa/json",
                    "type": "POST",
                    "headers": {
                        'Authorization': localStorage.getItem("token")
                    },
                    "data": function(d) {

                        var params = {
                            date: '',
                            flag: 'teman',
                            id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                        };

                        if(Main.getCurrentUser().user_type_id =='<?= USER_TYPE_SISWA ?>'){
                            params.no_id_user = Main.getCurrentUser().id;
                        }

                        $.extend(d, params);
                        
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
                        "data": "semester"
                    },
                    {
                        "data": "jurusan"
                    },
                    {
                        "data": "nama_kelas"
                    },
                    {
                        "data": "tanggal_name"
                    },
                    {
                        "data": "mapel"
                    },
                    {
                        "data": "nama_siswa"
                    },

                    {
                        "data": "penilaian"
                    },
                    {
                        "data": "is_active_name"
                    },
                    {
                        "data": "created_by_name"
                    },
                    {
                        "data": "created_dt_name"
                    },
                    {
                        "data": "updated_by_name"
                    },
                    {
                        "data": "updated_dt_name"
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "render": function(row, data, iDisplayIndex) {
                            var result = "";
                            result += "<button href=\"" + __base_url +
                                "admin/akademik/karaktersiswa/read/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                            result += "<button href=\"" + __base_url +
                                "admin/akademik/karaktersiswa/update/" +
                                iDisplayIndex.id + "?flag=teman"+
                                "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                            result += "<button href=\"" + __base_url +
                                "api/akademik/karaktersiswa/delete/" +
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

    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
        if (value.tanggal) {
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
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
                mytable2();
                // $('#mytable2').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click', '.btn-pilihsiswa', function(e) {
        var data = JSON.parse($(this).attr('data'));
        $(form + ' input[name="nama_siswa"]').val(data.nama_siswa);
        $(form + ' input[name="id_siswa"]').val(data.id_user);
        $('#myModalsiswa .close').trigger('click');
    })

});
</script>