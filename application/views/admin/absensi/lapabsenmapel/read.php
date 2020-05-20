<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css">

<style>
    .header td {
        padding:0 10px;
    }
</style>

<script src="<?php echo base_url(); ?>AdminLTE-2.4.10/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<div class="box box-warning">
    <div class="box-header with-border text-center">
        <h3 class="box-title">Laporan Absensi Mapel <span class="tahun"></span> <span class="kelas"></span></h3>
    </div>
    <table class="header">
        <tr>
            <td>Sekolah</td>
            <td>:</td>
            <td><?= $_GET['skl_name']?></td>
        </tr>
        <tr>
            <td>Tahun Ajaran</td>
            <td>:</td>
            <td><?= $_GET['tahun_ajaran_name']?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?= $_GET['kelas_name']?></td>
        </tr>
        <tr>
            <td>Mapel</td>
            <td>:</td>
            <td><?= !empty($_GET['mapel_name']) ? $_GET['mapel_name'] : 'Semua'?></td>
        </tr>
    </table>
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

<script>
$(document).ready(function() {

    var form = "#lapabsenmapel";
    $.ajax({
        url: "<?= base_url("api/data/lapabsensimapel")?>",
        data: {
            id_skl:'<?= $_GET['id_skl']?>',
            id_tahun_ajaran:'<?= $_GET['id_tahun_ajaran']?>',
            id_kelas:'<?= $_GET['id_kelas']?>',
            id_mapel:'<?= $_GET['id_mapel']?>',
        },
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
            $.each(data.data,function (i,value) {
                if(
                    value.nama_siswa
                    && value.id_mapel
                    && value.id_datang
                    && value.id_mapel != 0
                ){
                    absen[value.id_siswa][value.id_mapel][value.id_datang] = absen[value.id_siswa][value.id_mapel][value.id_datang] + 1;
                }

            })
            
            arrMapel = [];
            mapel.forEach(function (value,i) {
                $('#mytable tr:nth(0)').append('<th colspan="5">'+value+'</th>')
                $('#mytable tr:nth(1)').append('<th class="'+i+'-1">Hadir</th><th class="'+i+'-2">Lambat</th><th class="'+i+'-3">Ijin</th><th class="'+i+'-4">Sakit</th><th class="'+i+'-5">Alfa</th>')
            })

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
            })

            setTimeout(() => {
                 window.print()
                 window.close()
            }, 500);
        }
    })

});
</script>
