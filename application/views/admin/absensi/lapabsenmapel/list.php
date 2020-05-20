<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Absensi Mapel</h3>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form id="lapabsenmapel" action="<?= base_url('admin/absensi/lapabsenmapel/read')?>" class="form-horizontal" style="padding:10px">
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
        <h3 class="box-title">Laporan Absensi Mapel <span class="tahun"></span> <span class="kelas"></span></h3>
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
                url: __base_url + "api/data/lapabsensimapel",
                data: value,
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    // console.log(data)

                    var siswa = [];
                    var mapel = [];
                    var absen = [];

                    $.each(data.data,function (i,value) {

                        if(
                            value.nama_siswa
                            && value.id_mapel
                            && value.id_datang
                        ){

                            // ambil mapel
                            // console.log(value.id_mapel)
                            if(!mapel[value.id_mapel] && value.id_mapel != 0){
                                mapel[value.id_mapel] = [];
                                if(value.mapel_name){
                                    mapel[value.id_mapel].push(value.mapel_name);
                                }
                            }
                            // ambil siswa
                            if(!siswa[value.id_siswa] && value.id_siswa != 0){
                                siswa[value.id_siswa] = [];
                                if(value.nama_siswa){
                                    // console.log(value.nama_siswa)
                                    siswa[value.id_siswa]  = {no_induk:value.id_siswa,nama_siswa:value.nama_siswa};
                                }
                            }
                        }
                    })

                    // console.log(siswa)
                    // $.each(siswa,function (i,value) {
                    for(var a in siswa) {
                        // console.log(i)
                        if(!absen[a]) {
                            absen[a] = [];
                        }

                        for(var b in mapel) {
                        // $.each(mapel,function (j,item) {
                            if(!absen[a][b]){
                                absen[a][b] = []
                            }

                            for(var k = 1; k <= 5; k++) {
                                if(!absen[a][b][k]){
                                    absen[a][b][k] = 0
                                }
                            }
                            
                        }

                    }

                    console.log(absen)


                    $.each(data.data,function (i,value) {
                        if(
                            value.nama_siswa
                            && value.id_mapel
                            && value.id_datang
                            && value.id_mapel != 0
                        ){
                            // if(!absen[value.id_siswa]){
                            //     absen[value.id_siswa] = [];
                            // }
                            // if(!absen[value.id_siswa][value.id_mapel]) {
                            //     absen[value.id_siswa][value.id_mapel] = [];
                            // }
                            // console.log(value.nama_siswa)
                            // console.log(value.id_siswa)
                            // console.log(value.id_mapel)
                            // console.log(value.id_datang)
                            // if(!absen[value.id_siswa][value.id_mapel][value.id_datang]) {
                            //     absen[value.id_siswa][value.id_mapel][value.id_datang] = 0;
                            // }
    
                            absen[value.id_siswa][value.id_mapel][value.id_datang] = absen[value.id_siswa][value.id_mapel][value.id_datang] + 1;
                        }

                    })
                    
                    arrMapel = [];
                    mapel.forEach(function (value,i) {
                        $('#mytable tr:nth(0)').append('<th colspan="5">'+value+'</th>')
                        $('#mytable tr:nth(1)').append('<th class="'+i+'-1">Hadir</th><th class="'+i+'-2">Lambat</th><th class="'+i+'-3">Ijin</th><th class="'+i+'-4">Sakit</th><th class="'+i+'-5">Alfa</th>')
                    })

                    // console.log(absen);

                    // var no = 0;
                    // for(var prop in absen) {
                    //     if(absen.hasOwnProperty(prop)) {
                    //         console.log(absen[prop])
                    //         $('#mytable tbody').append(`
                    //             <tr>
                    //                 <td>`+(++no)+`</td>
                    //                 <td>`+absen[prop].no_induk+`</td>
                    //                 <td>`+prop+`</td>
                    //             </tr>
                    //         `);
                    //     }
                    // }


                    // console.log('====');
                    // console.log(absen)
                    

                    var no = 0;
                    absen.forEach(function (value,i) {

                        var td = '';
                        value.forEach(a => {
                            for(var c in a) {
                                if(!isNaN(a[c])) {
                                    td += '<td>'+a[c]+'</td>'
                                    // console.log(a[c]);
                                }

                            }
                        });

                        // console.log(value)
                        $('#mytable tbody').append(`
                            <tr class="`+i+`">
                                <td>`+(++no)+`</td>
                                <td>`+(siswa[i].no_induk)+`</td>
                                <td>`+(siswa[i].nama_siswa)+`</td>
                                `+td +`
                            </tr>
                        `)

                        $('.'+i).find('')
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

            window.open(__base_url +'admin/absensi/lapabsenmapel/read?id_skl='+$('select[name="id_skl"]').val()
            +'&skl_name='+$('select[name="id_skl"] :selected').text()
            +'&id_tahun_ajaran='+$('select[name="id_tahun_ajaran"]').val()
            +'&tahun_ajaran_name='+$('select[name="id_tahun_ajaran"] :selected').text()
            +'&id_kelas='+$('select[name="id_kelas"]').val()
            +'&kelas_name='+$('select[name="id_kelas"] :selected').text()
            +'&id_mapel='+$('select[name="id_mapel"]').val()
            +'&mapel_name='+$('select[name="id_mapel"] :selected').text()
            ,'_blank');
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