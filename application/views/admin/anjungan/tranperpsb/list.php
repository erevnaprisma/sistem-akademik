<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
    <tr>
 
            <th>No</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Tahun</th>
            <th>No Induk</th>
            <th>Nama Siswa</th>
            <th>Nama Panggilan</th>
            <th>Jenis Kelamin</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Updated By</th>
            <th>Updated Date</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var form = '#tranperpsbForm';

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
                    b.attr('href', __base_url + 'admin/anjungan/tranperpsb/create');
                    b.attr('title', 'CREATE');
                },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/anjungan/tranperpsb/json",
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
                "data": "in_siswa",
                "render": function(row, data, iDisplayIndex) {
                    var html = "";
                    if(iDisplayIndex.in_siswa=='Sudah ditranper'){
                        html = '<span class="label label-success">Sudah di tranper</span>'
                    }
                    return html;
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
                        if(iDisplayIndex.in_siswa==''){
                            result += "<button href=\"" + __base_url + "admin/anjungan/tranperpsb/update/" +
                                iDisplayIndex.id +
                                "\" data-id='"+iDisplayIndex.id+"' data-id_skl='"+iDisplayIndex.id_skl+"' data-slug='"+iDisplayIndex.slug+"' data-id_tahun='"+iDisplayIndex.id_tahun+"' class=\"btn btn-warning btn-tranper btn-xs\" title=\"Tranper\"><i class=\"fa fa-pencil\"></i> Tranper</button>";
                            result += "<button href=\"" + __base_url + "admin/anjungan/tranperpsb/delete/" +
                                iDisplayIndex.id +
                                "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                        }
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

    $(document).on('click', '.btn-tranper', function(e) {
        e.preventDefault();
        var thiss = $(this);

        swal({
            title: 'Tranper PSB ke data siswa',
            text: "Yakin Mau Transfer data",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit!',
            cancelButtonText: 'Cancel!',
            showLoaderOnConfirm: true,
        }).then(function (data) {
            // console.log(data)
            var value = {
            id: thiss.attr('data-id'),
            id_skl: thiss.attr('data-id_skl'),
            id_tahun: thiss.attr('data-id_tahun'),
            slug: thiss.attr('data-slug'),
            };
            $.ajax({
                url: __base_url + 'api/anjungan/tranperpsb/update',
                data: {
                    data: JSON.stringify([value])
                },
                method: 'POST',
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function(data) {
                    $('#mytable').DataTable().ajax.reload(null, false);
                },
                error: function(e) {
                    Main.autoSetError(form, e.responseJSON.error)
                },
                complete: function(e) {

                }
            });
        }, function (dismiss) {

        });

       
    })


});
</script>