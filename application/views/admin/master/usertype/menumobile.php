<form class="menumobile" method="post" action="<?=base_url('api/master/usertype/'.$action); ?>">
<input type="hidden" name="id" value="<?=$id; ?>">
<table class="table">
    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="akademik"></td>
        <td colspan="2">Akademik</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="nilaimatapelajaran"></td>
        <td>Nilai Mata Pelajaran</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="jadwalpelajaran"></td>
        <td>Jadwal Pelajaran</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="kalenderpendidikan"></td>
        <td>Kalender Pendidikan</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="penilaiandiri"></td>
        <td>Penilaian Diri</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="penilaianteman"></td>
        <td>Penilaian Teman</td>
    </tr>

    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="kesiswaan"></td>
        <td colspan="2">Kesiswaan</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="prestasisiswa"></td>
        <td>Prestasi Siswa</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="pelanggaransiswa"></td>
        <td>Pelanggaran Siswa</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="agendaosis"></td>
        <td>Agenda OSIS</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="kegiatanekskul"></td>
        <td>Kegiatan Ekskul</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="tatatertib"></td>
        <td>Tata Tertib</td>
    </tr>

    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="absensi"></td>
        <td colspan="2">Absensi</td>
    </tr>
    
    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="keuangan"></td>
        <td colspan="2">Keuangan</td>
    </tr>

    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="elibrary"></td>
        <td colspan="2">E-library</td>
    </tr>
    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="elearning"></td>
        <td colspan="2">E-learning</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="materi"></td>
        <td>Materi</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="ujian"></td>
        <td>Ujian</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="hasilujian"></td>
        <td>Hasil Ujian</td>
    </tr>

    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="kantin"></td>
        <td colspan="2">Kantin</td>
    </tr>
    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="product"></td>
        <td colspan="2">Produk</td>
    </tr>
    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="order"></td>
        <td colspan="2">Order</td>
    </tr>

    <tr>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="forum"></td>
        <td colspan="2">Forum</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="forumorangtua"></td>
        <td>Forum Orang Tua</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="forumguru"></td>
        <td>Forum Guru</td>
    </tr>
    <tr>
        <td></td>
        <td style="width:50px;"><input type="checkbox" name="menu_mobile" value="forumsiswa"></td>
        <td>Forum Siswa</td>
    </tr>
    
</table>
<button class="btn btn-primary btn-save">Submit</button>
</form>

<script>
    $(function () {
        var form = '.menumobile';
        function getDatabyId() {
            var id = $(form + ' input[name="id"]').val();
            if (id) {
                $.ajax({
                    url: __base_url + "api/master/usertype/read",
                    data: {
                        id: id
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    beforeSend: function(data) {},
                    success: function(data) {
                        $.each(data.data, function(i, value) {
                            if(value.menu_mobile){
                                var menu = value.menu_mobile.split(',');
                                $('input[name="menu_mobile"]').each(function () {
                                    if(menu.indexOf($(this).val())>=0){
                                        $(this).prop('checked',true);
                                    }
                                })
                            }
                        });

                    }
                })
            }
        }
        getDatabyId();
    })
</script>