<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
    <tr>
 
            <th>No</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Tahun</th>
            <th>Nomor</th>
            <th>Nama Siswa</th>
            <th>Nama Panggilan</th>
            <th>Jenis Kelamin</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>HP Siswa</th>
            <th>HP Orangtua</th>
            <th>HP Orangtua2</th>
            <th>Is Active</th>
            <th>Tanggal daftar</th>
            <!-- <th>Created Date</th> -->
            <th>Updated By</th>
            <th>Updated Date</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var form = '#psbForm';

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
                    b.attr('href', __base_url + 'admin/anjungan/psb/create');
                    b.attr('title', 'CREATE');
                },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/anjungan/psb/json",
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
                "data": "status",
                "render": function (row, data, iDisplayIndex) {
                    'Baru','Seleksi','Diterima','Ditolak'
                    var res = '';
                    if(iDisplayIndex.status=='Baru'){
                        res = '<span class="label label-primary">Baru</span>';
                    } else if(iDisplayIndex.status=='Seleksi'){
                        res = '<span class="label label-warning">Seleksi</span>';
                    } else if(iDisplayIndex.status=='Diterima'){
                        res = '<span class="label label-success">Diterima</span>';
                    } else if(iDisplayIndex.status=='Ditolak'){
                        res = '<span class="label label-danger">Ditolak</span>';
                    }
                    return res;
                }
            },
            {
                "data": "foto",
                "render": function(row, data, iDisplayIndex) {
                    var html = "";
                    html += " <img src='" + __base_url + __path_image + 'psb/' + iDisplayIndex
                        .foto + "' style=\"width:65px;height:65px;\"> ";
                    return html;
                }
            },
            {
                "data": "tahun"
            },
            {
                "data": "nomor"
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "nm_panggilan"
            },
            {
                "data": "jenis_kelamin"
            },
            {
                "data": "nm_ayah"
            },
            {
                "data": "nm_ibu"
            },
            {
                "data": "hp_siswa"
            },
            {
                "data": "hp_ortu_1"
            },
            {
                "data": "hp_ortu_2"
            },
            {
                "data": "is_active_name"
            },
            {
                "data": "tanggal_daftar"
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
                    result += "<a href=\"" + __base_url + "sekolah/psbcalon/" + iDisplayIndex.slug + '?id=' +
                        iDisplayIndex.id + '&nomor='+ iDisplayIndex.nomor +
                        "\" class=\"btn btn-info btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</a>";
                    result += "<button href=\"" + __base_url + "admin/anjungan/psb/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    result += "<button href=\"" + __base_url + "admin/anjungan/psb/delete/" +
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