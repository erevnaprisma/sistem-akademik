<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a class="note" href="#tab_1" data-toggle="tab" aria-expanded="true">Note</a></li>
        <li class=""><a class="galeri" href="#tab_2" data-toggle="tab" aria-expanded="false">Galeri</a></li>
        <li class=""><a class="video" href="#tab_3" data-toggle="tab" aria-expanded="false">Video</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sekolah</th>
                        <th>Kepada</th>
                        <!-- <th>Note</th> -->
                        <th>Dibaca</th>
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
                        <th>Sekolah</th>
                        <!-- <th>Kepada</th> -->
                        <th>Note</th>
                        <th>Dibaca</th>
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
                        <th>Sekolah</th>
                        <!-- <th>Kepada</th> -->
                        <th>Note</th>
                        <th>Dibaca</th>
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

    $(document).on('click','.note',function (e) {
        e.preventDefault();
        note();
    })
    $(document).on('click','.galeri',function (e) {
        e.preventDefault();
        galeri();
    })
    $(document).on('click','.video',function (e) {
        e.preventDefault();
        video();
    })

    // karena yang muncul pertama kali ini
    note();
    function note() {
        if ($.fn.dataTable.isDataTable("#mytable")) {
            $('#mytable').DataTable().ajax.reload(null, false);
        } else {


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
                        b.attr('href', __base_url + 'admin/anjungan/mading/createnote');
                        b.attr('title', 'CREATE');
                    },
                }, ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/anjungan/mading/json",
                    "type": "POST",
                    "headers": {
                        'Authorization': localStorage.getItem("token")
                    },
                    "data": function(d) {

                        $.extend(d, {
                            hal: 'madingnote',
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
                        "data": null,
                        "defaultContent": ""
                    },
                    {
                        "data": "sekolah"
                    },
                    {
                        "data": "kepada"
                    },
                    // {
                    //     "data": "note"
                    // },
                    {
                        "data": "dibaca"
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
                                "admin/anjungan/mading/readnote/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/updatenote/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/gambar/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-success btn-update btn-xs\" title=\"Gambar\"><i class=\"fa fa-pencil\"></i> Gambar</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/dokumen/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-primary btn-update btn-xs\" title=\"Dokumen\"><i class=\"fa fa-pencil\"></i> Dokumen</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/delete/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                            return result;
                        }
                    },
                ],
                //"order": [[0, 'desc']],
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

    function galeri() {
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
                        b.attr('href', __base_url + 'admin/anjungan/mading/creategaleri');
                        b.attr('title', 'CREATE');
                    },
                }, ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/anjungan/mading/json",
                    "type": "POST",
                    "headers": {
                        'Authorization': localStorage.getItem("token")
                    },
                    "data": function(d) {

                        $.extend(d, {
                            hal: 'madinggaleri',
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
                        "data": null,
                        "defaultContent": ""
                    },
                    {
                        "data": "sekolah"
                    },
                    // {
                    //     "data": "kepada"
                    // },
                    {
                        "data": "note"
                    },
                    {
                        "data": "dibaca"
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
                                "admin/anjungan/mading/readgaleri/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/updategaleri/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/gambar/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-success btn-update btn-xs\" title=\"Gambar\"><i class=\"fa fa-pencil\"></i> Gambar</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/delete/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                            return result;
                        }
                    },
                ],
                //"order": [[0, 'desc']],
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

    function video() {
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
                        b.attr('href', __base_url + 'admin/anjungan/mading/createvideo');
                        b.attr('title', 'CREATE');
                    },
                }, ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/anjungan/mading/json",
                    "type": "POST",
                    "headers": {
                        'Authorization': localStorage.getItem("token")
                    },
                    "data": function(d) {

                        $.extend(d, {
                            hal: 'madingvideo',
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
                        "data": null,
                        "defaultContent": ""
                    },
                    {
                        "data": "sekolah"
                    },
                    // {
                    //     "data": "kepada"
                    // },
                    {
                        "data": "note"
                    },
                    {
                        "data": "dibaca"
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
                                "admin/anjungan/mading/readvideo/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/updatevideo/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/video/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-success btn-update btn-xs\" title=\"Video\"><i class=\"fa fa-pencil\"></i> Video</button>";

                            result += "<button href=\"" + __base_url +
                                "admin/anjungan/mading/delete/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                            return result;
                        }
                    },
                ],
                //"order": [[0, 'desc']],
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



    var form = '#infoForm';
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
                note();
                galeri();
                video();
            },
            error: function(e) {
                Main.autoSetError(form, e.responseJSON.error)
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