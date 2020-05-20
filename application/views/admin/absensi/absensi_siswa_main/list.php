<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal - Jam Masuk</th>
            <th>Tanggal - Jam Keluar</th>
            <th>Siswa</th>
            <th>Keterlamabatan</th>
            <th>Sekolah</th>
            <th>Jurusan</th>
            <th>Kelas</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var form = '#absensiSiswaMainForm';

    

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

    

    /*$('body').on('expanded.pushMenu collapsed.pushMenu', function() {
        setTimeout(function(){
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        }, 350);
    });*/

    var table=$('#mytable').DataTable({
        responsive: {
            details: {
                // display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
        dom: "lBfrtip",
        buttons: [{
            /*text: "Create",
            className: "btn btn-create btn-success fa fa-plus",
            init: function(a, b, c) {
                b.attr('href', __base_url + 'admin/absensi/absensi_siswa/create');
                b.attr('title', 'CREATE');
            },*/
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/absensi/absensi_siswa_main/json",
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
        /*"scrollY":"200px",
        "scrollX": true,
        "scrollColapse":true,*/
        //"paging":false,
        "columns": [{
                //"class": "details-control",
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": ""
            },
            {
                "data": "date_of_entry"
            },
            {
                "data": "date_of_out"
            },
            {
                "data": "nama_siswa"
            },
            {
                /*"name":"terlambat",
                "orderable": true,
                "searchable": true,
                "data": function(row, type, val, meta){
                    if(val == "Ontime"){
                        return "<span style='color:green;'>"+row.terlambat+"</span>";
                    }else{
                        return "<span style='color:red;'>"+row.terlambat+"</span>";
                    }
                }*/
                "data":"terlambat"
            },
            {
                "data": "nm_skl"
            },
            {
                "data": "jurusan"
            },
            {
                "data": "nama_kelas"
            },
            /*{
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
            },*/
        ],
        //"scrollX":true,
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

    $("#mytable").append(
        $('<tfoot/>').append( $("#mytable thead tr").clone() )
    );

    $('#mytable tfoot th').each( function () {
        var title = $(this).text();
        console.log(title);
        if(title != "No"){
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }
        
    } );

    table.columns().every( function () {
        var that = this;
 
        $( 'tfoot input', this.footer() ).on( 'keyup', function (e) {
            if(e.keyCode == 13){
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            }
        } );
    } );

    /*$(document).on('click', form + ' .btn-save', function(e) {
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
    })*/


});
</script>