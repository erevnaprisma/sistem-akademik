<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Penilaian</h3>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form id="lapabsenmapel" action="<?= base_url('admin/akademik/lappenilaian/read')?>" class="form-horizontal" style="padding:10px">
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
                    <label class="col-md-3"> Tahun Ajaran</label>
                    <div class="col-md-9">
                        <select name="id_tahun_ajaran" class="form-control">
                            <option value="">Pilih Tahun Ajaran</option>
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
                    <label class="col-md-3"> Mapel</label>
                    <div class="col-md-9">
                        <select name="id_mapel" class="form-control">
                            <option value="">Pilih Mapel</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <button class="btn btn-primary btn-report">Cari</button>
                        <button class="btn btn-info btn-exportprint">Print</button>
                        <button class="btn btn-primary btn-exportexcel">Save to Excel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<div class="box box-warning">
    <div class="box-header with-border text-center">
        <h3 class="box-title">Laporan Penilaian <span class="tahun"></span> <span class="kelas"></span></h3>
    </div>
    <div class="table-responsive" id="table-responsive" style="padding:10px;">
        <table id="mytable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">NIS</th>
                    <th rowspan="2">Nama</th>
                </tr>
                <tr>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>



<script>
$(document).ready(function() {

    var form = "#lapabsenmapel";

    Data.getMapel(form, ' select[name="id_mapel"]');
    Data.getSekolah(form, ' select[name="id_skl"]');
    Data.getKelas(form, ' select[name="id_kelas"]');
    Data.getTahunAjaran(form, ' select[name="id_tahun_ajaran"]');

    $('.btn-report').click(function(e) {
        e.preventDefault();
        $(form).validate({
            rules: {
                id_skl: {
                    required: true,
                },
                id_tahun_ajaran: {
                    required: true,
                },
                id_kelas: {
                    required: true,
                },
            },
        }).form();
        if ($(form).valid()) {
            
            $('#mytable tbody tr').remove();
            $('#mytable thead tr:nth(0) th:nth-child(n+4)').remove()
            $('#mytable thead tr:nth(1) th').remove();

            var value = Main.removeObjectEmpty(Main.objectifyForm($(form).serializeArray()));
            $.ajax({
                url: __base_url + "api/data/lappenilaian",
                data: value,
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    var lap = []; var mapel = []; var siswa = []; var penilaian = [];
                    data.data.forEach(function (value,i) {
                        if(value.id_siswa && value.id_mapel && value.tanggal_name){

                            if(!penilaian[value.id_penilaian]){
                                penilaian[value.id_penilaian] = []
                            }
                            penilaian[value.id_penilaian] = {id_penilaian:value.id_penilaian,tanggal_name:value.tanggal_name,mapel_name:value.mapel_name}

                            mapel[value.id_mapel] = {id_mapel:value.id_mapel,mapel_name:value.mapel_name};
                            siswa[value.id_siswa] = {no_induk:value.no_induk,nama_siswa:value.nama_siswa};
                            if(!lap[value.id_siswa]){
                                lap[value.id_siswa] = []
                            }
                            if(!lap[value.id_siswa][value.id_penilaian]){
                                lap[value.id_siswa][value.id_penilaian] = []
                            }
                            if(!lap[value.id_siswa][value.id_penilaian]){
                                lap[value.id_siswa][value.id_penilaian] = []
                            }
                            lap[value.id_siswa][value.id_penilaian] = value.nilai;
                        }
                    })

                    penilaian.forEach(function (value) {
                        $('#mytable tr:nth(0)').append('<th>'+value.tanggal_name+'</th>')
                        $('#mytable tr:nth(1)').append('<th>'+value.mapel_name+'</th>')
                    })

                    var no = 0;
                    siswa.forEach(function (value,i) {
                        var td = "";
                        penilaian.forEach(function (a) {
                            td += "<td>"+lap[i][a.id_penilaian]+"</td>";
                        })

                        $('#mytable tbody').append(`
                            <tr class="">
                                <td>`+(++no)+`</td>
                                <td>`+(value.no_induk)+`</td>
                                <td>`+(value.nama_siswa)+`</td>
                                `+ td +`
                            </tr>
                        `)
                    })
                    
                }
            })
        }
    })

    $(".btn-exportprint").click(function(e) {
        e.preventDefault()
        $(form).validate({
            rules: {
                id_skl: {
                    required: true,
                },
                id_tahun_ajaran: {
                    required: true,
                },
                id_kelas: {
                    required: true,
                },
            },
        }).form();
        if ($(form).valid() && $('#mytable tbody tr').length) {

            e.preventDefault()
            document.title = "Laporan Absensi Siswa";
            $('.box-default').hide();
            $('.main-footer').hide();
            window.print();
            setTimeout(() => {
                $('.box-default').show() 
                $('.main-footer').show() 
            }, 300);
        }
    })
    $(".btn-exportexcel").click(function(e) {
        e.preventDefault()
        Main.exportToExcel({
            table: "mytable",
            title: "Si Edu",
            header: "Laporan Absensi Mapel",
            name: "Laporan Absensi Mapel",
            periode: $('select[name="id_tahun_ajaran"] :selected').text() +' '+ $('select[name="id_kelas"] :selected').text()
        });
    })
});
</script>