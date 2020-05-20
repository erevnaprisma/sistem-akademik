<form id="raportNilaiForm" class="form-horizontal" style="padding: 0 25px">
    <div class="form-group">
        <table id="header" class="table " data-id="<?=$id; ?>">

        </table>
        <table id="body" class="table ">
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
                    </tr>\n\
                    <tr>\n\
                        <td>Nomor Induk</td>\n\
                        <td>: ' + kelas.no_induk + '</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Nama Sekolah</td>\n\
                        <td>: ' + kelas.nm_skl + '</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <td>Alamat Sekolah</td>\n\
                        <td>: ' + kelas.alamat + '</td>\n\
                        <td></td>\n\
                        <td></td>\n\
                    </tr>';
                $('#header').html(html);
                // $('#header').attr('data', JSON.stringify(kelas));


// console.log(kelas);

                    


                $.ajax({
                    url: __base_url + "api/data/transkipread",
                    data: {
                        is_active: 1,
                        id_user: kelas.id_siswa,
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    beforeSend: function(data) {},
                    success: function(data) {
                        $.each(data.data, function(i, value) {
                            console.log(value);
                            
                            var html = "<tr>\n\
                                            <td style=\"width:50px;\">" + (i + 1) + "</td>\n\
                                            <td style=\"width:200px;\">" + value.name + "</td>\n\
                                            <td style=\"width:50px;\">"+value.kkm+"</td>\n\
                                            <td style=\"width:70px;\">"+value.nilai+"</td>\n\
                                            <td>"+value.keterangan+"</td>\n\
                                        </tr>";
                            $('#body tbody').append(html);

                        });
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