<div class="callout callout-default">
    <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Tahun</th>
                <th>Nama</th>
                <th>Panggilan</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<script>
$(document).ready(function() {

    var slug = '<?= $slug; ?>';

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
            // text: "Create",
            // className: "btn btn-create btn-success fa fa-plus",
            // init: function(a, b, c) {
            //     b.attr('href', __base_url + 'admin/anjungan/home/create');
            //     b.attr('title', 'CREATE');
            //     b.attr('data-zoom', 'modal-xl');
            // },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/data/psoblistjson",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {

                $.extend(d, {
                    hal: 'note',
                    id_skl: '<?= $sekolah->id_skl ?>'
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
                "data": "foto",
                "render": function(row, data, iDisplayIndex) {
                    var html = "";
                    html += " <img src='" + __base_url + __path_image + 'psb/' + iDisplayIndex
                        .foto + "' style=\"width:65px;height:65px;\"> ";
                    return html;
                }
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
                "data": "tahun",
            },
            {
                "data": "nama_siswa",
            },
            {
                "data": "nm_panggilan",
            },
            {
                "data": "tmp_lahir"
            },
            {
                "data": "tgl_lhr"
            },
            {
                "data": "nm_ayah"
            },
            {
                "data": "nm_ibu"
            },
            {
                "data": "alamat"
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    if(iDisplayIndex.status=='Baru'){
                        result += "<a href=\"" + __base_url + "sekolah/psbcalon/" + slug + '?id=' +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-xs btn-href\" title=\"Update\" style=\"color:#fff !important;\"><i class=\"fa fa-pencil\"></i> Update</a>";
                    }
                    return result;
                }
            },
        ],
        "order": [
            [0, 'asc']
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
    $(document).on('click', '.btn-href', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        swal({
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                title: 'Masukan kode pendaftaran',
                //                            text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit!',
                cancelButtonText: 'Cancel!',
                showLoaderOnConfirm: true,
            }).then(function (data) {
                // console.log(data)
                window.location  = url+'&nomor='+data;
            }, function (dismiss) {

            });
    })
})
</script>