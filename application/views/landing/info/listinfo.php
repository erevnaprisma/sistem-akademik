<div class="callout callout-default">
    <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Dari</th>
                <th>Kepada</th>
                <th>Notes</th>
                <th>Komentar</th>
                <th>Dibaca</th>
            </tr>
        </thead>
        <!-- <tbody>
            <tr>
                <td>1</td>
                <td>
                    Eka Mustika <br>
                    09-12-2013
                </td>
                <td>
                    Siswa SMA
                </td>
                <td>
                    <a href="< ?= base_url('sekolah/infodetail/sdit-al-kautsar?id=1')?>" style="color:black;text-decoration:none;">
                        <b> Persiapan Ujian Nasional </b> <br>
                        Kepada siswa-siswi SMA yang akan mengikuti Ujian Nasional, ibu mohom supaya selalu belajar dan berdoa <br>
                    </a>
                    <b>Gambar: 1   Dokumen: 1</b>
                </td>
                <td>
                    <h2>1</h2> <br>
                    09-12-2013
                </td>
                <td>
                    <h2>2</h2> <br>
                    09-12-2013
                </td>
            </tr>
        </tbody> -->
    </table>
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
            "url": __base_url + "api/data/anjunganinfojson",
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
                "data": null,
                "defaultContent": ""
            },
            {
                "data": "created_by_name"
            },
            {
                "data": "kepada"
            },
            {
                "data": "note",
                "render": function(row, data, iDisplayIndex) {
                    var html = "";
                    html += " <a href=\" " + __base_url + "sekolah/infodetail/" + iDisplayIndex.slug + "?id="+ iDisplayIndex.id +" \"> " + iDisplayIndex.note  + " </a> ";
                    return html;
                }
            },
            {
                "data": "komen"
            },
            {
                "data": "dibaca"
            },
            // {
            //     "data": "updated_dt"
            // },
            // {
            //     "data": null,
            //     "orderable": false,
            //     "searchable": false,
            //     "render": function(row, data, iDisplayIndex) {
            //         var result = "";
            //         result += "<button href=\"" + __base_url + "admin/anjungan/home/read/" +
            //             iDisplayIndex.id +
            //             "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
            //         result += "<button href=\"" + __base_url + "admin/anjungan/home/update/" +
            //             iDisplayIndex.id +
            //             "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
            //         result += "<button href=\"" + __base_url + "admin/anjungan/home/delete/" +
            //             iDisplayIndex.id +
            //             "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
            //         return result;
            //     }
            // },
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
})
</script>