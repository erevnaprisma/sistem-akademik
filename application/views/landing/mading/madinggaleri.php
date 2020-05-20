<div class="callout callout-default">
    <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Gambar</th>
                <th>Komentar</th>
                <th>Dilihat</th>
            </tr>
        </thead>
        <!-- <tbody>
            <tr>
                <td>1</td>
                <td>


                    <a href="< ?= base_url('sekolah/infogaleridetail/sdit-al-kautsar?id=1')?>"
                        style="color:black;text-decoration:none;">
                        <b>Lomba Sains Nasional </b>
                        <p>Foto-foto dari lomba sains nasional</p>
                        <p>Eka Mustika - 09-12-2013 07:28</p>
                    </a>
                </td>
                <td>
                    <h2>5</h2> <br>
                    09-12-2013
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
                    hal: 'madinggaleri',
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
                "data": "note",
                "render": function(row, data, iDisplayIndex) {
                    var html = "";
                    html += " <a href=\" " + __base_url + "sekolah/madinggaleridetail/" + iDisplayIndex.slug + "?id="+ iDisplayIndex.id +" \"> " + iDisplayIndex.note  + " </a> ";
                    html += iDisplayIndex.created_by_name + " - " + iDisplayIndex.created_dt_name;
                    return html;
                }
            },
            {
                "data": "img_first",
                "render": function(row, data, iDisplayIndex) {
                    var html = "";
                    if(iDisplayIndex.gambar>0){
                        html += " <img src=\" " + __base_url + __path_attach + 'info/' + iDisplayIndex.img_first +" \" style=\"width:50px;height:50px;\">";
                    }
                    
                    html += iDisplayIndex.gambar + " gambar"; 
                    
                    return html;
                }
            },
            {
                "data": "komen"
            },
            {
                "data": "dibaca"
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
})
</script>