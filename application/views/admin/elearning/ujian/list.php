<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <th>Semester</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Mapel</th>
            <th>Judul</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Durasi</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var form = '#ujianForm';

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
        buttons: [],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/elearning/ujian/json",
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
                "data": "tahun"
            },
            {
                "data": "semester"
            },
            {
                "data": "jurusan"
            },
            {
                "data": "nama_kelas"
            },
            {
                "data": "mapel"
            },
            {
                "data": "judul"
            },
            {
                "data": "mulai_name"
            },
            {
                "data": "selesai_name"
            },
            {
                "data": "durasi"
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    result += "<a href=\"" + __base_url + "admin/elearning/ujian/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-success btn-xs\" title=\"Kerjakan\"><i class=\"fa fa-pencil\"></i> Kerjakan</a>";
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


});
</script>