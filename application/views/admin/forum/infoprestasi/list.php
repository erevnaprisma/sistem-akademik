<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a class="sekolah" href="#tab_1" data-toggle="tab" aria-expanded="true">Sekolah</a></li>
        <li class=""><a class="guru" href="#tab_2" data-toggle="tab" aria-expanded="false">Guru</a></li>
        <li class=""><a class="siswa" href="#tab_3" data-toggle="tab" aria-expanded="false">Siswa</a></li>
        <li class=""><a class="staff" href="#tab_4" data-toggle="tab" aria-expanded="false">Staff</a></li>
    </ul>
    <div class="tab-content">
        <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sekolah</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Prestasi</th>
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

    $(document).on('click', '.sekolah,.guru,.siswa,.staff', function(e) {
        $('#mytable').DataTable().ajax.reload(null, false);
    })


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
                b.attr('href', __base_url + 'admin/forum/infoprestasi/create');
                b.attr('title', 'CREATE');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/forum/infoprestasi/json",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {

                $.extend(d, {
                    flag: $('.content .nav-tabs-custom .active a').attr('class'),
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
                "data": null,
                "defaultContent": ""
            },
            {
                "data": "sekolah"
            },
            {
                "data": "nama"
            },
            {
                "data": "tanggal_name"
            },
            {
                "data": "prestasi"
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
                    result += "<button href=\"" + __base_url + "admin/forum/infoprestasi/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                    result += "<button href=\"" + __base_url + "admin/forum/infoprestasi/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                    result += "<button href=\"" + __base_url + "admin/forum/infoprestasi/delete/" +
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


    var form = '#infoprestasiForm';
    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
        if(value.tanggal){
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





});
</script>