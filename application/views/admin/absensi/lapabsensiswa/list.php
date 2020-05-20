<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Absensi Siswa</h3>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form id="lapabsensiswa" action="<?= base_url('admin/absensi/lapabsensiswa/read')?>" class="form-horizontal" style="padding:10px">
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
        <h3 class="box-title">Laporan Absensi Siswa <span class="tahun"></span> <span class="kelas"></span></h3>
    </div>
    <div class="table-responsive" id="table-responsive" style="padding:10px;">
        <table id="mytable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">NIS</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Hadir</th>
                    <th rowspan="2">Terlambat</th>
                    <th rowspan="2">Ijin</th>
                    <th rowspan="2">Sakit</th>
                    <th rowspan="2">Alfa</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>



<script>
$(document).ready(function() {

    var form = "#lapabsensiswa";

    Data.getSekolah(form, ' select[name="id_skl"]');
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
                // id_kelas: {
                //     required: true,
                // },
            },
        }).form();
        if ($(form).valid()) {
            
            $('#mytable tbody tr').remove();
            // $('#mytable thead tr:nth(0) th:nth-child(n+4)').remove()
            // $('#mytable thead tr:nth(1) th').remove();

            var value = Main.removeObjectEmpty(Main.objectifyForm($(form).serializeArray()));
            $.ajax({
                url: __base_url + "api/data/lapabsensisiswa",
                data: value,
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    // console.log(data)

                    var siswa = [];
                    // var mapel = [];
                    var absen = [];

                    $.each(data.data,function (i,value) {

                        if(
                            value.nama_siswa
                            && value.id_datang
                        ){

                            // ambil mapel
                            // console.log(value.id_mapel)
                            // if(!mapel[value.id_mapel] && value.id_mapel != 0){
                            //     mapel[value.id_mapel] = [];
                            //     if(value.mapel_name){
                            //         mapel[value.id_mapel].push(value.mapel_name);
                            //     }
                            // }
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
                    for(var a in siswa) {
                        // console.log(i)
                        if(!absen[a]) {
                            absen[a] = [];
                        }
                        for(var k = 1; k <= 5; k++) {
                            if(!absen[a][k]){
                                absen[a][k] = 0
                            }
                        }
                    }

                    console.log(absen)


                    $.each(data.data,function (i,value) {
                        if(
                            value.nama_siswa
                            && value.id_datang
                        ){
                            absen[value.id_siswa][value.id_datang] = absen[value.id_siswa][value.id_datang] + 1;
                        }

                    })
                    
                    console.log(absen);

                    // // var no = 0;
                    // // for(var prop in absen) {
                    // //     if(absen.hasOwnProperty(prop)) {
                    // //         console.log(absen[prop])
                    // //         $('#mytable tbody').append(`
                    // //             <tr>
                    // //                 <td>`+(++no)+`</td>
                    // //                 <td>`+absen[prop].no_induk+`</td>
                    // //                 <td>`+prop+`</td>
                    // //             </tr>
                    // //         `);
                    // //     }
                    // // }


                    // // console.log('====');
                    // // console.log(absen)
                    

                    var no = 0;
                    absen.forEach(function (value,i) {

                        console.log(value)
                        var td = '';
                        for(var c in value) {
                            if(!isNaN(value[c])) {
                                td += '<td>'+value[c]+'</td>'
                                // console.log(a[c]);
                            }
                        }

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
        document.title = "Laporan Absensi Siswa";
        $('.box-default').hide();
        $('.main-footer').hide();
        window.print();
        setTimeout(() => {
            $('.box-default').show() 
            $('.main-footer').show() 
        }, 300);
    })
    $(".btn-exportexcel").click(function(e) {
        e.preventDefault()
        Main.exportToExcel({
            table: "mytable",
            title: "Si Edu",
            header: "Laporan Absensi Siswa",
            name: "Laporan Absensi Siswa",
            periode: $('select[name="id_tahun_ajaran"] :selected').text() +' '+ $('select[name="id_kelas"] :selected').text()
        });
    })
});
</script>