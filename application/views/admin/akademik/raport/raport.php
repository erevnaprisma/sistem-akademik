<form id="raportNilaiForm" class="form-horizontal" style="padding: 0 25px">
    <div class="form-group">
        <table id="header" class="table " data-id="<?=$id; ?>">

        </table>
        <table id="body" class="table ">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ASPEK YANG DINILAI</th>
                    <th>KKM</th>
                    <th>MUTU</th>
                    <th>DESKRIPSI</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-save">Submit</button>
            <a href="<?= base_url('admin/akademik/raport/cetak/'.$id) ?>" target="_blank" class="btn btn-warning btn-print">Print</a>
            <!-- <button type="button" class="btn btn-warning btn-print">Print</button> -->
        </div>
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
                $('#header').attr('data',JSON.stringify(kelas))

                $.ajax({
                    url: __base_url + "api/akademik/kelasmapel/read",
                    data: {
                        is_active: 1,
                        id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                        // tingkat: kelas.tingkat,
                        id_jurusan: kelas.id_jurusan,
                        id_semester: kelas.id_semester,
                        id_tahun_ajaran: kelas.id_tahun,
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
                                            <td style=\"width:70px;\"><input name=\"nilai\" class=\"form-control\"></td>\n\
                                            <td><textarea name=\"keterangan\" class=\"form-control\"></textarea></td>\n\
                                        </tr>";
                            $('#body tbody').append(html);

                        });

                        $('#body tbody tr').each(function() {
                            var thiss = $(this);
                            var value = JSON.parse(thiss.find('td:nth(0)').attr('data'));
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
                                        thiss.find('td:nth(2)').text(kkm)
                                    }
                                }
                            })


                            $.ajax({
                                url: __base_url +
                                    "api/akademik/raport/read",
                                data: {
                                    is_active: 1,
                                    id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                                    id_kenaikan_kelas: id,
                                    id_user:kelas.id_siswa,
                                    id_mapel:value.id_mapel,
                                },
                                method: "POST",
                                headers: {
                                    'Authorization': localStorage.getItem("token")
                                },
                                beforeSend: function(data2) {},
                                success: function(data2) {
                                    if (data2.data[0]) {
                                        var nilai = data2.data[0];
                                        thiss.find('td:nth(0)').attr('data-id-raport',nilai.id);
                                        thiss.find('input[name="nilai"]').val(nilai.nilai);
                                        thiss.find('textarea[name="keterangan"]').val(nilai.keterangan);
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
        }, 300);
    })

})