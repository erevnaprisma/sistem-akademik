<table id="mytableguru" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Action</th>
            <th>Nama guru</th>
            <th>Email</th>
            <th>MAPEL</th>
            <!-- <th>Jenis Kelamin</th> -->
        </tr>
    </thead>
</table>


<script>
$(document).ready(function() {
    var form = '#guruForm';

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
    $('#mytableguru').DataTable({
        responsive: {
            details: {
                type: ''
            }
        },
        dom: "lBfrtip",
        buttons: [
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/akademik/guru/json",
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
                var dt_params = $('#mytableguru').data('dt_params');
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
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    result += "<button data='" + Main.removequotes(JSON.stringify(iDisplayIndex)) + "'"+
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-pilihguru btn-xs\" title=\"Pilih\"> Pilih</button>";
                    return result;
                }
            },
            {
                "data": "username"
            },
            {
                "data": "emailname"
            },
            {
                "data": "mapel"
            },
            // {
            //     "data": "jenis_kelamin"
            // },
            
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
            $('#mytableguru_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });

        },
    });

});
</script>