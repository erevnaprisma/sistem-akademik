<form id="raportForm" class="form-horizontal">
    <div class="row">
        <div class="col-sm-3">
            <label class="">Sekolah</label>
            <div class="">
                <select name="id_skl" class="form-control">
                    <option value="">Select</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-3">
            <label class=""> Tahun</label>
            <div class="">
                <select name="id_tahun" class="form-control">
                    <option value="">Select</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-3">
            <label class=""> Semester</label>
            <div class="">
                <select name="id_semester" class="form-control">
                    <option value="">Select</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-3">
            <label class=""> Jurusan</label>
            <div class="">
                <select name="id_jurusan" class="form-control">
                    <option value="">Select</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-3">
            <label class=""> Kelas</label>
            <div class="">
                <select name="id_kelas" class="form-control">
                    <option value="">Select</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-3">
            <label class=""></label>
            <div class="">
                <button type="button" class="btn btn-primary btn-save-upload disabled">Cari</button>
            </div>
        </div>
    </div>
</form>
<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <!-- <th>Sekolah</th> -->
            <th>Semester</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Siswa</th>
            <th>Status</th>
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
    var form = '#raportForm';
    var raportnilaiform = '#raportNilaiForm';

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

    // loadData();
    function loadData() {
        if ($.fn.dataTable.isDataTable("#mytable")) {
            $('#mytable').DataTable().ajax.reload(null, false);
        } else {
            $('#mytable').DataTable({
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.childRowImmediate,
                        type: ''
                    }
                },
                dom: "lBfrtip",
                buttons: [],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/akademik/kenaikan_kelas/json",
                    "type": "POST",
                    "headers": {
                        'Authorization': localStorage.getItem("token")
                    },
                    "data": function(d) {

                        var value = Main.objectifyForm($(form).serializeArray());
                        $.extend(d, {
                            date: '',
                            id_tahun: value.id_tahun,
                            id_semester: value.id_semester,
                            id_jurusan: value.id_jurusan ? value.id_jurusan : 0,
                            id_kelas: value.id_kelas,
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
                        "data": "tahun"
                    },
                    // {
                    //     "data": "nm_skl"
                    // },
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
                        "data": "nama_siswa"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "keterangan"
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
                            result += "<button href=\"" + __base_url +
                                "admin/akademik/raport/raport/" + iDisplayIndex.id +"\" class=\"btn btn-info btn-create btn-xs\" title=\"Raport\"><i class=\"fa fa-eye\"></i> Raport</button>";
                            result += "<a href=\"" + __base_url +
                                "admin/akademik/raport/transkip/" + iDisplayIndex.id +"\" class=\"btn btn-warning btn-xs\" title=\"Transkip\" target=\"_blank\"><i class=\"fa fa-eye\"></i> Transkip</a>";
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
        }
    }



    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getTahun(form, ' select[name="id_tahun"]'),
        Data.getKelas(form, ' select[name="id_kelas"]'),
        Data.getSemester(form, ' select[name="id_semester"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        // Data.getSiswa(form, ' select[name="id_siswa"]')
    ).done(function(usertype) {
        // setTimeout(() => {
        //     getDatabyId()
        // }, 300);
    });

    function params() {
        var value = Main.objectifyForm($(form).serializeArray());
        console.log(value);
        
        if (value.id_tahun && value.id_semester && 
        // value.id_jurusan && 
        value.id_kelas && value.id_skl) {
            $(form + ' .btn-save-upload').removeClass('disabled')
        } else {
            $(form + ' .btn-save-upload').addClass('disabled')
        }
    }

    $(document).on('change', form + ' select', function() {
        params();
    })

    $(document).on('click', form + ' .btn-save-upload', function() {
        loadData();
    })






    $(document).on('click', raportnilaiform +' .btn-save',function () {

        var header = JSON.parse($('#header').attr('data'));

        $('#body tbody tr').each(function () {
            var thiss = $(this);
            var value = JSON.parse(thiss.find(':nth(0)').attr('data'));
            var id = $('#header').attr('data-id');

            var dataparams = {
                id_kenaikan_kelas:id, 
                keterangan: thiss.find('textarea[name="keterangan"]').val(), 
                is_active:1,  
                id_mapel:value.id_mapel,  
                id_user: header.id_siswa, 
                nilai:thiss.find('input[name="nilai"]').val()
            };

            var url = __base_url + 'api/akademik/raport/create';

            var id_raport = thiss.find('td:nth(0)').attr('data-id-raport');
            if(id_raport){
                url = __base_url + 'api/akademik/raport/update';
                dataparams.id = id_raport;
            }


            $.ajax({
                url: url,
                data: {
                    data: JSON.stringify([dataparams])
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage
                        .getItem("token")
                },
                beforeSend: function(data2) {},
                success: function(data2) {
                    thiss.addClass('bg-success');
                    thiss.find('td:nth(0)').attr('data-id-raport',data2.data);
                }
            })
            
        })
    });

    // $(document).on('click','.btn-print',function () {
    //     var mywindow = window.open('', 'Raport');
    //     mywindow.document.write('<html><head><title>Raport</title>');
    //     /*optional stylesheet*/ //
    //     mywindow.document.write('<link rel="stylesheet" href="'+ __base_url +'AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css' + '" type="text/css" />');
    //     mywindow.document.write('</head><body >');
    //     mywindow.document.write($('#raportNilaiForm').html());
    //     mywindow.document.write('</body></html>');

    //     mywindow.print();
    //     mywindow.close();

    //     return true;
    // })

});
</script>