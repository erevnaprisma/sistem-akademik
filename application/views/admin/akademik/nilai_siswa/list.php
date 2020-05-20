<table>
    <tr>
        <td>Kelas</td>
        <td width="5%">:</td>
        <td><b id="nama_kelas"></b></td>
    </tr>
    <tr>
        <td>Semester</td>
        <td width="5%">:</td>
        <td><b id="semester"></b></td>
    </tr>
    <tr>
        <td>Tahun Ajaran</td>
        <td width="5%">:</td>
        <td><b id="tahun_ajaran"></b></td>
    </tr>
</table><br>
<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Siswa</th>
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
    var form = '#nilaiSiswaForm';
    var id_penilaian = parseInt("<?= $id_penilaian ?>");

    function getPenilaian(){
        $.ajax({
            url: __base_url + "api/akademik/penilaian/read",
            data: {
                id: id_penilaian
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                console.log(data.data[0]);
                $("#nama_kelas").text(data.data[0].nama_kelas);
                $("#semester").text(data.data[0].semester);
                $("#tahun_ajaran").text(data.data[0].tahun);
            }
        })
    }

    setTimeout(function(){
        getPenilaian();
    }, 300);

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
                b.attr('href', __base_url + 'admin/akademik/nilai_siswa/create/'+id_penilaian);
                b.attr('title', 'CREATE');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/akademik/nilai_siswa/json/"+id_penilaian,
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
                "data": "nama_siswa"
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
                    // result += "<button href=\"" + __base_url + "admin/akademik/nilai_siswa/read/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                    // result += "<button href=\"" + __base_url + "admin/akademik/nilai_siswa/update/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    // result += "<button href=\"" + __base_url + "admin/akademik/nilai_siswa/delete/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";

                    result = "<div class='dropdown'>" +
                              "<button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Pilih " +
                              "<span class='caret'></span></button>" +
                              "<ul class='dropdown-menu'>" +
                              "<li><a href=\"" + __base_url + "admin/akademik/siswa/read/" + iDisplayIndex.id_siswa +
                              "\" title=\"Read\" class=\"btn-read\"><i class=\"fa fa-eye\"></i> Read</a></li>" +
                              "<li><a href=\"" + __base_url + "admin/akademik/nilai_harian/index/" + iDisplayIndex.id + 
                              "\" title=\"Nilai Harian\"><i class=\"fa fa-list\"></i> Nilai Harian</a></li>" +
                              "<li><a href=\"" + __base_url + "admin/akademik/nilai_uts/index/" + iDisplayIndex.id +
                              "\" title=\"Nilai UTS\"><i class=\"fa fa-list\"></i> Nilai UTS</a></li>" +
                              "<li><a href=\"" + __base_url + "admin/akademik/nilai_uas/index/" + iDisplayIndex.id +
                              "\" title=\"Nilai UAS\"><i class=\"fa fa-list\"></i> Nilai UAS</a></li>" +
                              "<li><a href=\"" + __base_url + "admin/akademik/nilai_siswa/update/" + iDisplayIndex.id + "/" + id_penilaian +
                              "\" title=\"Update\" class=\"btn-update\"><i class=\"fa fa-pencil\"></i> Update</a></li>" +
                              "<li><a href=\"" + __base_url + "api/akademik/nilai_siswa/delete/" + iDisplayIndex.id +
                              "\" title=\"Delete\" class=\"btn-delete\"><i class=\"fa fa-times\"></i> Delete</a></li>" +
                              "</ul></div>";
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