<style>
    .text-bold {
        font-weight: bold;
    }
    .table th, .table td {
        font-size:10px;
        padding: 3px 5px !important;
    }
    .borderless td, .borderless th {
        border: none !important;
    }
    .logo{
        position: absolute;
        top: 10px;
        left: 20px;
        width: 50px;
        height: 50px;
    }
</style>
<form id="raportNilaiForm" class="form-horizontal" style="padding: 0 25px">
    <div class="form-group">
        <img src="" alt="" srcset="" class="logo">
        <table class="table borderless">
            <tr>
                <td style="font-size:16px;text-align:center;padding: 0px !important;">LAPORAN HASIL PENILAIAN AKHIR SEMESTER</td>
            </tr>
            <tr>
                <td style="font-size:16px;text-align:center;padding: 0px !important;;"></td>
            </tr>
            <tr>
                <td style="font-size:12px;text-align:center;padding: 0px !important;;"></td>
            </tr>
        </table>
        <hr>
        <table id="header" class="table " data-id="<?=$id; ?>">

        </table>
        <table id="body" class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ASPEK YANG DINILAI</th>
                    <th>KBM</th>
                    <th>MUTU</th>
                    <th>DESKRIPSI</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <br>
        <table id="footer" class="table table-bordered">
            <tr>
                <td class="text-bold" style="width:250px;">JUMLAH</td>
                <td style="width:120px;">0</td>
                <td></td>
            </tr>
            <tr>
                <td class="text-bold">RATA-RATA</td>
                <td>0</td>
                <td></td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered">
            <tr>
                <td colspan="3" style="text-align:center">Ketidakhadiran</td>
            </tr>
            <tr>
                <td style="width:50%">Sakit</td>
                <td style="width:10%">:</td>
                <td style="width:40%">0 hari</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td>:</td>
                <td>0 hari</td>
            </tr>
            <tr>
                <td>Tanpa Keterangan</td>
                <td>:</td>
                <td>0 hari</td>
            </tr>
        </table>
        <br>
        <table class="table borderless">
            <tr>
                <td style="width:33%;text-align:center">
                    <br>
                    Orang tua/wali murid
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    (...................................)
                </td>
                <td style="width:33%;text-align:center">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    Mengetahui, <br>
                    Ka <span class="sekolah"></span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span class="kepala_sekolah"></span>
                </td>
                <td style="width:33%;text-align:center">
                    <span class="kota_tanggal"></span> <br>
                    Wali Kelas <span class="kelas"></span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span class="wali_kelas"></span>
                </td>
            </tr>
        </table>
    </div>
</form>
<script>
$(document).ready(function() {
    function getHeader() {
        var id = $('#header').attr('data-id');
        $.ajax({
            url: __base_url + "api/akademik/kenaikan_kelas/read",
            data: {
                is_active: 1,
                id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                id: id
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                var kelas = data.data[0] ? data.data[0] : {};

                    $('.table:nth(0) tr:nth(1) td').text(kelas.nm_skl)
                    $('.table:nth(0) tr:nth(2) td').text(kelas.alamat)

                    $('.logo').attr('src',__base_url+__path_attach+'sekolah/'+kelas.foto);
                    $('.sekolah').text(kelas.nm_skl)
                    $('.kepala_sekolah').text(kelas.kepala_sekolah)
                    $('.kelas').text(kelas.nama_kelas)
                    $('.kota_tanggal').text(kelas.kota+', '+moment(new Date()).format('DD') + ' ' + Main.monthNameIndo(moment(new Date()).format('M')) + ' ' +moment(new Date()).format('YYYY'))
                    $('.wali_kelas').text(kelas.wali_kelas_name)

                var html = '<tr>\n\
                        <td style="width:20%;">Nama Peserta Didik</td>\n\
                        <td style="width:25%;">: ' + kelas.nama_siswa + '</td>\n\
                        <td style="width:20%;">Kelas</td>\n\
                        <td style="width:25%;">: ' + kelas.nama_kelas + '</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Nomor Induk</td>\n\
                        <td>: ' + kelas.no_induk + '</td>\n\
                        <td>Semester</td>\n\
                        <td>: ' + kelas.semester + '</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Nama Sekolah</td>\n\
                        <td>: ' + kelas.nm_skl + '</td>\n\
                        <td>Tahun Pelajaran</td>\n\
                        <td>: ' + kelas.tahun + '</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Alamat Sekolah</td>\n\
                        <td>: ' + kelas.alamat + '</td>\n\
                        <td></td>\n\
                        <td></td>\n\
                    </tr>';
                $('#header').html(html);
                $('#header').attr('data', JSON.stringify(kelas))

                $.ajax({
                    url: __base_url + "api/akademik/kelasmapel/read",
                    data: {
                        is_active: 1,
                        id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                        // tingkat: kelas.tingkat,
                        id_jurusan: kelas.id_jurusan,
                        id_semester: kelas.id_semester,
                        id_tahun_ajaran: kelas.id_tahun_ajaran,
                        id_kls: kelas.id_kelas,
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    beforeSend: function(data) {},
                    success: function(data) {
                        $.each(data.data, function(i, value) {
                            var html = "<tr>\n\
                                            <td style=\"width:50px;\" data='" + JSON.stringify(value) + "'>" + (i +
                                1) + "</td>\n\
                                            <td style=\"width:200px;\">" + value.mapel_name + "</td>\n\
                                            <td style=\"width:50px;\"></td>\n\
                                            <td style=\"width:70px;\"></td>\n\
                                            <td></td>\n\
                                        </tr>";
                            $('#body tbody').append(html);
                        });

                        var index = 0;
                        $('#body tbody tr').each(function() {
                            index ++;
                            var thiss = $(this);
                            var value = JSON.parse(thiss.find('td:nth(0)').attr(
                                'data'));
                            $.ajax({
                                url: __base_url +
                                    "api/akademik/kkm/read",
                                data: {
                                    is_active: 1,
                                    id_skl: JSON.parse(Main
                                        .getselectedSchool()).join(
                                        ','),
                                    // tingkat: value.tingkat,
                                    id_jurusan: value.id_jurusan,
                                    id_semester: value.id_semester,
                                    id_tahun_ajaran: value
                                        .id_tahun_ajaran,
                                    id_mapel: value.id_mapel,
                                },
                                method: "POST",
                                headers: {
                                    'Authorization': localStorage
                                        .getItem("token")
                                },
                                beforeSend: function(data2) {},
                                success: function(data2) {
                                    if (data2.data[0]) {
                                        var kkm = data2.data[0].kkm;
                                        thiss.find('td:nth(2)')
                                            .text(kkm)
                                    }
                                }
                            })


                            $.ajax({
                                url: __base_url +
                                    "api/akademik/raport/read",
                                data: {
                                    is_active: 1,
                                    id_skl: JSON.parse(Main
                                        .getselectedSchool()).join(
                                        ','),
                                    id_kenaikan_kelas: id,
                                    id_user: kelas.id_siswa,
                                    id_mapel: value.id_mapel,
                                },
                                method: "POST",
                                headers: {
                                    'Authorization': localStorage
                                        .getItem("token")
                                },
                                beforeSend: function(data2) {},
                                success: function(data2) {
                                    if (data2.data[0]) {
                                        var nilai = data2.data[0];
                                        thiss.find('td:nth(3)').text(nilai.nilai);
                                        thiss.find('td:nth(4)').text(nilai.keterangan);

                                        var jml = parseInt($('#footer tr td:nth(1)').text());
                                        
                                        jml = jml + parseInt(nilai.nilai)
                                        console.log(jml);
                                        console.log(Main.terbilang(jml));
                                        
                                        $('#footer tr:nth(0) td:nth(1)').text(jml)
                                        $('#footer tr:nth(0) td:nth(2)').text(Main.terbilang(jml))
                                        $('#footer tr:nth(1) td:nth(1)').text(parseInt(jml/index))
                                        $('#footer tr:nth(1) td:nth(2)').text(Main.terbilang(parseInt(jml/index)))
                                    }
                                }
                            })
                        })
                    }
                })
            }
        });



    }
    $.when(
        getHeader(),
        // getKelas(),
        // getSemester(),
        // getJurusan(),
        // getSiswa()
    ).done(function(usertype) {
        setTimeout(() => {
            // getDatabyId()
            window.print();
            window.close();
        }, 3000);
    })

})

</script>