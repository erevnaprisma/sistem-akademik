<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Cover</th>
            <th>Jenis</th>
            <th>Buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Download</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var form = '#bukuForm';

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
        buttons: [ ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/elibrary/buku/json",
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
                "data": "cover",
                "orderable": false,
                "searchable": false,
                render: function(row, data, iDisplayIndex) {
                    if(iDisplayIndex.cover){
                        return '<image src="'+ __base_url + 'assets/public/attach/buku/' + iDisplayIndex.cover+'" style="width:150px;height:150px;">';
                    } else {
                        return 'Berkas belum diupload!'
                    }
                }
            },
            {
                "data": "jenis"
            },
            {
                "data": "buku"
            },
            {
                "data": "pengarang"
            },
            {
                "data": "penerbit"
            },
            {
                "data": "tahun"
            },
            {
                "data": "file",
                "orderable": false,
                "searchable": false,
                render: function(row, data, iDisplayIndex) {
                    if(iDisplayIndex.file){
                        return '<a href="'+ __base_url + 'assets/public/attach/buku/' + iDisplayIndex.file+'" target="_blank">' + iDisplayIndex.file+'</a>';
                    } else {
                        return 'Berkas belum diupload!'
                    }
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


});
</script>