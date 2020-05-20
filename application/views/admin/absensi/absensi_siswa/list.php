
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">List Absensi</a></li>
            </ul>
            <div class="tab-content">
            <!-- iyeu teh awalan kanggo nyieun form -->
                <div class="row">
                    <div class="col-md-6">
                        <form class="form-horizontal" id="absensiBuka">
                            <div class="form-group">
                                <label class="col-md-3"> Sekolah</label>
                                <div class="col-md-9">
                                    <select name="id_skl" class="form-control">
                                        <option value="">Pilih Sekolah</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3"> Jurusan</label>
                                <div class="col-md-9">
                                    <select name="id_jurusan" class="form-control">
                                        <option value="">Pilih Jurusan</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3"> Kelas</label>
                                <div class="col-md-9">
                                    <select name="id_kelas" class="form-control">
                                        <option value="">Pilih Kelas</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3"> Semester</label>
                                <div class="col-md-9">
                                    <select name="id_semester" class="form-control">
                                        <option value="">Pilih Semester</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3"> Tahun Ajaran</label>
                                <div class="col-md-9">
                                    <select name="id_tahun_ajaran" class="form-control">
                                        <option value="">Pilih Tahun Ajaran</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3"> Mata Pelajaran</label>
                                <div class="col-md-9">
                                    <select name="id_mapel" class="form-control">
                                        <option value="">Pilih Mata Pelajaran</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3">Guru</label>
                                <div class="col-md-9">
                                    <div class="input-group input-group-sm">
                                        <input name="nama_guru" class="form-control readonly">
                                        <input type="hidden" name="id_guru">
                                        <span class="input-group-btn">
                                            <button type="button"
                                                class="btn btn-info btn-flat btn-cariguru <?= !empty($id) ? '' : '' ?>">Cari!</button>
                                        </span>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3">Tanggal</label>
                                <div class="col-md-9">
                                    <div class="input-group date datetimepicker">
                                        <input name="date_of_entry" class="form-control" placeholder="Masukan Tanggal">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <span class="help-block"></span>
                                </diV>
                            </div>
                            <button class="btn btn-primary" id="add" href="<?= site_url('admin/absensi/absensi_siswa/create'); ?>" title="Tambah Absensi">Tambah Absensi</button>
                        </form>
                    </div>
                </div>
                <hr>    
                
                
              <div class="tab-pane active" id="tab_1">
                <style type="text/css">
                    .modal-admin{
                        width: 50%;
                    }
                </style>
                <div class="modal" tabindex="-1" role="dialog" id="adds">
                  <div class="modal-dialog modal-admin" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title"><center>Modal title</center></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Modal body text goes here.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary tambah">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Masuk</th>
                            <th>Kehadiran</th>
                            <th>Siswa</th>
                            <th>Mapel</th>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Sekolah</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
              </div>
              
            </div>
            <!-- /.tab-content -->
          </div>
        
    </div>
</div>



<script>
$(document).ready(function() {
    var dutu = localStorage.getItem("currentUser");
    var dutux = $.parseJSON(dutu);
    console.log(dutux[0]['id']);
    var form = '#absensiBuka';
    var form2 = '#absensiSiswaForm';

    
    Data.getSekolah(form, ' select[name="id_skl"]');
    Data.getKelas(form, ' select[name="id_kelas"]');
    Data.getJurusan(form, ' select[name="id_jurusan"]');
    Data.getSemester(form, ' select[name="id_semester"]');
    Data.getMapel(form, ' select[name="id_mapel"]');
    Data.getTahunAjaran(form, ' select[name="id_tahun_ajaran"]');


    $(document).on('click', '.btn-pilihguru', function(e) {
        var data = JSON.parse($(this).attr('data'));
        console.log(data);
        
        $(form + ' input[name="nama_guru"]').val(data.username);
        $(form + ' input[name="id_guru"]').val(data.id_user);
        $('#myModalguru .close').trigger('click');
    })
    // getSekolah();
    // getSemester();
    // getTahunAjaran();
    $(document).on("change",'select[name="id_skl"]',function(e){
        e.preventDefault();
        var skl = $('select[name="id_skl"]').val();
        getJurusan(skl);
        getKelas(skl,"");
        getMapel(skl);
    });

    $(document).on("change", 'select[name="id_jurusan"]',function(e){
        e.preventDefault();
        var skl = $('select[name="id_skl"]').val();
        var jurusan = $('select[name="id_jurusan"]').val();
        getKelas(skl, jurusan);
    })

    $(document).on("change", 'select[name="id_mapel"]',function(e){
        e.preventDefault();
        var skl = $('select[name="id_skl"]').val();
        var mapel = $('select[name="id_mapel"]').val();
        getGuru(skl, mapel);
    })

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
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/absensi/absensi_siswa/json",
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
                "data": "date_of_entry_name"
            },
            {
                "data": "kehadiran"
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "mapel_name"
            },
            {
                "data": "nama_guru"
            },
            {
                "data": "nama_kelas"
            },
            {
                "data": "jurusan"
            },
            {
                "data": "semester"
            },
            {
                "data": "tahun"
            },
            {
                "data": "nm_skl"
            },
            {
                "data": "ket"
            },
            {
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

    function tutup(){
        $("#myModal").modal("hide");
    }

    $(document).on('click', "#add", function(e){
        e.preventDefault();



        $("#absensiBuka").validate({
            rules: {
                id_skl: {
                    required: true,
                },
                id_kelas: {
                    required: true,
                },
                id_semester: {
                    required: true,
                },
                id_tahun_ajaran: {
                    required: true,
                },
                id_mapel: {
                    required: true,
                },
                nama_guru: {
                    required: true,
                },
                date_of_entry: {
                    required: true,
                },
            },
        }).form();
        if ($("#absensiBuka").valid()) {


            var skl = $('select[name="id_skl"]').val();
            var jurusan = $('select[name="id_jurusan"]').val();
            var kelas = $('select[name="id_kelas"]').val();
            var semester = $('select[name="id_semester"]').val();
            var thn_ajar = $('select[name="id_tahun_ajaran"]').val();
            var mapel = $('select[name="id_mapel"]').val();
            var guru = $('input[name="id_guru"]').val();
            var tanggal = $('input[name="date_of_entry"]').val();
            $.ajax({
                url: __base_url + "admin/absensi/absensi_siswa/openAbsen",
                data: {
                    is_active: 1,
                    skl: skl,
                    jurusan: jurusan,
                    kelas: kelas,
                    semester: semester,
                    thn_ajar: thn_ajar,
                    mapel: mapel,
                    guru: guru,
                    tanggal: tanggal
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    //console.log(data);
                    $('#adds').find('.modal-body').html(data);                
                    $('#adds').modal('show');
                }
            })
            //return $('#adds').modal('show');
            //return false;
        }
    })

    $(document).on('click','.tambah', function(e){

        e.preventDefault();
        var user = $.parseJSON(localStorage.getItem("currentUser"))[0].id;
        //console.log(user);
        var a=$('input[name="id_abs_siswa[]"]').map(function(){
            return $(this).val();
        }).get();
        var nama_siswa=$('input[name="nama_siswa[]"]').map(function(){
            return $(this).val();
        }).get();
        var id_device=$('input[name="id_device[]"]').map(function(){
            return $(this).val();
        }).get();
        var b=$('select[name="kehadiran[]"]').map(function(){
            return $(this).val();
        }).get();
        var c=$('input[name="abs_ket[]"]').map(function(){
            return $(this).val();
        }).get();
        var skl = $('select[name="id_skl"]').val();
        var jurusan = $('select[name="id_jurusan"]').val();
        var kelas = $('select[name="id_kelas"]').val();
        var semester = $('select[name="id_semester"]').val();
        var thn_ajar = $('select[name="id_tahun_ajaran"]').val();
        var mapel = $('select[name="id_mapel"]').val();
        var mapel_name = $('select[name="id_mapel"] :selected').text();
        var guru = $('input[name="id_guru"]').val();
        var tanggal = $('input[name="date_of_entry"]').val();
        //console.log(skl);
        $.ajax({
            url: __base_url + "api/absensi/absensi_siswa/save",
            data: {
                is_active: 1,
                skl: skl,
                jurusan: jurusan,
                kelas: kelas,
                semester: semester,
                thn_ajar: thn_ajar,
                mapel: mapel,
                mapel_name: mapel_name,
                guru: guru,
                tanggal: tanggal,
                abs_siswa: a,
                kehadiran: b,
                keterangan: c,
                user: user,
                nama_siswa: nama_siswa,
                id_device: id_device,
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $('#adds button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
                //console.log(data);
                /*$('#adds').find('.modal-body').html(data);                
                $('#adds').modal('show');*/
            }
        })
    })

    $(document).on('click', form2 + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form2).serializeArray());
        value.is_active = 1;
        console.log(value);
        $.ajax({
            url: $(form2).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(form2).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(form2, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })


});
</script>