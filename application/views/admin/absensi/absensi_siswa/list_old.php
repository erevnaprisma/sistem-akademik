<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Siswa</th>
            <th>Mapel</th>
            <th>Guru</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Semester</th>
            <th>Tahun Ajaran</th>
            <th>Sekolah</th>
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
    var form = '#absensiSiswaForm';

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
                b.attr('href', __base_url + 'admin/absensi/absensi_siswa/create');
                b.attr('title', 'CREATE');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/absensi/absensi_siswa/json",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {

                $.extend(d, {
                    date: '',
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
                "data": "date_of_entry_name"
            },
            {
                "data": "date_of_out_name"
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "mapel_name"
            },
            {
                "data": "nama_guru"
            },
            {
                "data": "nama_kelas"
            },
            {
                "data": "jurusan"
            },
            {
                "data": "semester"
            },
            {
                "data": "tahun"
            },
            {
                "data": "nm_skl"
            },
            {
                "data": "ket"
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
                    result += "<button href=\"" + __base_url + "admin/absensi/absensi_siswa/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";

                    result += "<button href=\"" + __base_url + "admin/absensi/absensi_siswa/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";

                    result += "<button href=\"" + __base_url + "admin/absensi/absensi_siswa/delete/" +
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
        console.log(value);
        if(value.date_of_entry && value.date_of_out){
            value.date_of_entry = moment(value.date_of_entry, "DD/MM/YYYY HH:mm:ss").format("YYYY/MM/DD HH:mm:ss");
            value.date_of_out = moment(value.date_of_out, "DD/MM/YYYY HH:mm:ss").format("YYYY/MM/DD HH:mm:ss");

            console.log(value.date_of_entry);
            console.log(value.date_of_out);
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

    $(document).on('click', '.btn-pilihsiswa', function(e) {
        var data = JSON.parse($(this).attr('data'));
        $(form + ' input[name="nama_siswa"]').val(data.nama_siswa);
        $(form + ' input[name="id_siswa"]').val(data.id_user);
        $('#myModalsiswa .close').trigger('click');
    })

    $(document).on('click', '.btn-pilihguru', function(e) {
        var data = JSON.parse($(this).attr('data'));
        console.log(data);
        
        $(form + ' input[name="nama_guru"]').val(data.username);
        $(form + ' input[name="id_guru"]').val(data.id_user);
        $('#myModalguru .close').trigger('click');
    })
    

});
</script>