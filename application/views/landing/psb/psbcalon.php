<?php if(!$buatpsb){ ?>
<h2 class="text-center">Maaf Penerimaan siswa baru belum tersedia</h2>
<?php } else { ?>

<style>
.content {
    background-color: #fff;
}

.form-control {
    height: 25px;
    font-size: 11px;
}

.table>thead>tr>th,
.table>tbody>tr>th,
.table>tfoot>tr>th,
.table>thead>tr>td,
.table>tbody>tr>td,
.table>tfoot>tr>td {
    border-top: 1px solid #fff;
    padding: 0px 5px;
}

label {
    margin-bottom: 0px;
}

@media print {

    input[type=checkbox],
    input[type=radio] {
        opacity: 1 !important;
    }
}

.border-success {
    border-color: #00a65a;
}

.border-error {
    border-color: #dd4b39;
}

.headerr .names {
    font-weight: bold;
    margin: 0 0px;
    font-size: 15px;
}

.widget-user-image i {
    position: absolute;
    left: 20px;
}

.fotosiswa,
.fotoayah,
.fotoibu {
    cursor: pointer;
    height: 70px;
}


.sr-only {
    position: unset;
}
</style>
<div class="row headerr">
    <div class="col-xs-2">
        <p class="text-center"><img src="<?= base_url('assets/public/attach/sekolah/'.$sekolah->foto)?>" alt=""
                srcset="" style="height:70px;"></p>

    </div>
    <div class="col-xs-8 text-center">
        <p class="names"><?= $sekolah->nm_skl ?></p>
        <p class="names">FORMULIR PENDAFTARAN PESERTA DIDIK BARU</p>
        <p class="names">TAHUN PELAJARAN <?= $buatpsb->tahun; ?></p>
    </div>
    <div class="col-xs-2">
        <div class="widget-user-image text-center">
            <input type="file" name="telp" class="form-control inputfotosiswa hidden">
            <img id="fotosiswa" class=" fotosiswa" src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar5.png')?>"
                alt="User Avatar">
            <i class="fa fa-camera hilang"></i>
        </div>
    </div>
</div>

<form action="<?= base_url('api/data/siswa_psb'); ?>" method="POST" id="psbform" class="dropzone">
    <input type="hidden" name="id_skl" value="<?= $sekolah->id_skl ?>">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="hidden" name="status" value="Baru">
    <input type="hidden" name="id_tahun" value="<?= $buatpsb->id_tahun ?>">
    <table class="table" style="font-size: 10px; border:1px solid #fff;    margin-bottom: 0px;">
        <tr>
            <td colspan="10">Mohon diisi lengkap dengan huruf cetak</td>
        </tr>
        <tr>
            <td>A.</td>
            <td colspan="9">Keterangan Calon Murid</td>
        </tr>
        <tr>
            <td></td>
            <td>1.</td>
            <td>Nama Anak</td>
            <td>:</td>
            <td>Lengkap</td>
            <td colspan="2"><input name="nama_siswa" class="form-control"></td>
            <td>Panggilan</td>
            <td colspan="2"><input name="nm_panggilan" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td>2.</td>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td colspan="3">
                <select name="jk" class="form-control">
                    <option value="">Pilih</option>
                </select>
            </td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td>3.</td>
            <td>Kelahiran</td>
            <td>:</td>
            <td>Tempat</td>
            <td colspan="2"><input name="tmp_lahir" class="form-control"></td>
            <td>Tanggal</td>
            <td colspan="2"><input name="tgl_lhr" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>4.</td>
            <td>Agama</td>
            <td>:</td>
            <td colspan="3">
                <select name="id_agm" class="form-control chosen">
                    <option value="">Pilih</option>
                </select>
            </td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td>5.</td>
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td colspan="3">
                <select name="wrg" class="form-control">
                    <option value="">Pilih</option>
                    <option value="WNI">WNI</option>
                    <option value="WNI Keturunan">WNI Keturunan</option>
                    <option value="Asing">Asing</option>
                </select>
            </td>
            <td colspan="3"><input name="wrg_negara_lain" class="form-control" placeholder="warga negara lain"></td>
        </tr>
        <tr>
            <td></td>
            <td>6.</td>
            <td>Anak ke</td>
            <td>:</td>
            <td><input type="number" min="0" name="ank_ke" class="form-control"></td>
            <td>dari</td>
            <td><input type="number" min="0" name="dari" class="form-control"></td>
            <td colspan="3">saudara</td>
        </tr>
        <tr>
            <td style="width:20px;"></td>
            <td style="width:20px;">7.</td>
            <td style="width:100px;">Jumlah Saudara</td>
            <td style="width:20px;">:</td>
            <td style="width:50px;">Kandung</td>
            <td style="width:50px;"><input type="number" min="0" name="jml_sdr_kan" class="form-control"></td>
            <td style="width:50px;">Tiri</td>
            <td style="width:50px;"><input type="number" min="0" name="jml_sdr_tir" class="form-control"></td>
            <td style="width:50px;">Angkat</td>
            <td style="width:50px;"><input type="number" min="0" name="sdr_ang" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td>8.</td>
            <td>Bahasa Sehari-hari</td>
            <td>:</td>
            <td colspan="3">
                <select name="bahasa" class="form-control chosen">
                    <option value="">Pilih</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Jawa">Jawa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </td>
            <td colspan="3"><input name="bahasalain" class="form-control" placeholder="bahasa lainnya"></td>
        </tr>
        <tr>
            <td></td>
            <td>9.</td>
            <td>Keadaan Jasmani</td>
            <td>:</td>
            <td>Berat/kg</td>
            <td><input type="number" min="0" name="berat" class="form-control"></td>
            <td>Tinggi/cm</td>
            <td><input type="number" min="0" name="tinggi" class="form-control"></td>
            <td>Gol Darah</td>
            <td>
                <select name="id_goldar" class="form-control chosen">
                    <option value="">Pilih</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Alergi</td>
            <td><input name="alergi" class="form-control"></td>
            <td>Penyakit yang pernah diderita</td>
            <td colspan="3"><input name="penyakit" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td>10.</td>
            <td>Alamat Rumah</td>
            <td>:</td>
            <td colspan="6"><textarea name="alamat" rows="4" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>11.</td>
            <td>Telepon</td>
            <td>:</td>
            <td>Hp Siswa</td>
            <td><input name="hp_siswa" class="form-control"></td>
            <td>Hp Ayah</td>
            <td><input name="hp_ortu_1" class="form-control"></td>
            <td>Hp Ibu</td>
            <td><input name="hp_ortu_2" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td>12.</td>
            <td>Cita-cita murid <i>(boleh lebih dari satu)</i></td>
            <td>:</td>
            <td colspan="6"><input name="cita" class="form-control"></td>
        </tr>
        <tr>
            <td>B.</td>
            <td colspan="9">Keterangan Orang Tua</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="3" class="text-center">AYAH</td>
            <td colspan="3" class="text-center">IBU</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Nama Lengkap</td>
            <td></td>
            <td colspan="3"><input name="nm_ayah" class="form-control"></td>
            <td colspan="3"><input name="nm_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Tempat Lahir</td>
            <td></td>
            <td colspan="3"><input name="tmp_lhr_ayah" class="form-control"></td>
            <td colspan="3"><input name="tmp_lhr_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Tanggal Lahir</td>
            <td></td>
            <td colspan="3"><input name="tgl_lhr_ayah" class="form-control"></td>
            <td colspan="3"><input name="tgl_lhr_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Kewarganegaraan</td>
            <td></td>
            <td colspan="3">
                <select name="wrg_ayah" class="form-control">
                    <option value="">Pilih</option>
                    <option value="WNI">WNI</option>
                    <option value="WNI Keturunan">WNI Keturunan</option>
                    <option value="Asing">Asing</option>
                </select>
            </td>
            <td colspan="3">
                <select name="wrg_ibu" class="form-control">
                    <option value="">Pilih</option>
                    <option value="WNI">WNI</option>
                    <option value="WNI Keturunan">WNI Keturunan</option>
                    <option value="Asing">Asing</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Pendidikan terakhir</td>
            <td></td>
            <td colspan="3">
                <select name="id_pndd_ayah" class="form-control">
                    <option value="">Pilih</option>
                </select>
            </td>
            <td colspan="3">
                <select name="id_pndd_ibu" class="form-control">
                    <option value="">Pilih</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Nama Sekolah Terakhir</td>
            <td></td>
            <td colspan="3"><input name="pnddk_ayah" class="form-control"></td>
            <td colspan="3"><input name="pnddk_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Pekerjaan</td>
            <td></td>
            <td colspan="3">
                <select name="id_pek_ayah" class="form-control">
                    <option value="">Pilih</option>
                </select>
            </td>
            <td colspan="3">
                <select name="id_pek_ibu" class="form-control">
                    <option value="">Pilih</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Nama instansi tempat bekerja</td>
            <td></td>
            <td colspan="3"><input name="instansi_ayah" class="form-control"></td>
            <td colspan="3"><input name="instansi_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Jabatan ditempat bekerja</td>
            <td></td>
            <td colspan="3"><input name="jabatan_ayah" class="form-control"></td>
            <td colspan="3"><input name="jabatan_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Penghasilan per bulan</td>
            <td></td>
            <td colspan="3"><input name="gaji_ayah" class="form-control"></td>
            <td colspan="3"><input name="gaji_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Alamat rumah</td>
            <td></td>
            <td colspan="3"><input name="almt_rmh_ayah" class="form-control"></td>
            <td colspan="3"><input name="almt_rmh_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Alamat kantor</td>
            <td></td>
            <td colspan="3"><input name="almt_knt_ayah" class="form-control"></td>
            <td colspan="3"><input name="almt_knt_ibu" class="form-control"></td>
        </tr>
        <tr>
            <td>C.</td>
            <td colspan="9">Lampirkankan pada saat pengiriman dokumen</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">Kode Pendaftaran</td>
            <td colspan="2"><input name="nomor" class="form-control" value="<?= $sekolah->id.$buatpsb->id_tahun.date('Ymds') ?>" placeholder="">
            </td>
            <td colspan="3">
                <input type="hidden" name="tanggal_daftar" value="<?= date('d F Y')?>">
                <div class="text-center"><?= $sekolah->kota; ?>, <?= date('d F Y')?></div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">Pas Foto 3x5 (4 lembar)</td>
            <td colspan="2"><input type="checkbox"> Ya</td>
            <td colspan="3">
                <div class="text-center">Pendaftar</div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">Copy AKTE kelahiran (1 lembar)</td>
            <td colspan="2"><input type="checkbox"> Ya</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">Copy Kartu Keluarga (1 lembar)</td>
            <td colspan="2"><input type="checkbox"> Ya</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">Copy Raport (1 lembar)</td>
            <td colspan="2"><input type="checkbox"> Ya</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">Copy Ijazah/STTB/STK (bisa menyusul)</td>
            <td colspan="2"><input type="checkbox"> Ya</td>
            <td colspan="3">
                <div class="text-center">
                    <hr style="width:70%;border-top: 2px dotted #ccc;margin-bottom: 0;">
                </div>
            </td>
        </tr>
    </table>
</form>
<div class="text-center"><?= $sekolah->alamat ?></div>
<div class="row btn-button hilang">
    <div class="col-xs-6">
        <button type="button" class="btn btn-primary btn-save">Simpan</button>
        <button type="button" class="btn btn-success btn-print" disabled>Cetak</button>
        <a href="<?= base_url('sekolah/psblist/'.$sekolah->slug)?>" class="btn btn-info">Lihat list PSB</a>
    </div>
</div>



<script>
$(document).ready(function() {

    var form = '#psbform';

    $('input[name="tgl_lhr"]').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    })
    $('input[name="tgl_lhr_ayah"]').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    })
    $('input[name="tgl_lhr_ibu"]').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    })



    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })

    // $(form + ' input[name="jk"]').on('ifChecked', function(event){
    //     alert(event.type + ' callback');
    // });



    $.when(
        Data.getJK(form, ' select[name="jk"]'),
        Data.getAgama(form, ' select[name="id_agm"]'),
        Data.getAgama(form, ' select[name="agm_ayah"]'),
        Data.getAgama(form, ' select[name="agm_ibu"]'),
        Data.getGoldar(form, ' select[name="id_goldar"]'),
        // Data.getTempattinggal(form, ' select[name="id_tem_t_dgn"]'),
        // Data.getStatustinggal(form, ' select[name="id_sta_t_dgn"]'),
        // Data.getTransportasirumah(form, ' select[name="id_trn_rmh"]'),
        // Data.getJarakrumah(form, ' select[name="id_jrk_rmh"]'),
        // Data.getDibiayaioleh(form, ' select[name="pendidikan_oleh"]'),
        Data.getPendidikanterakhir(form, ' select[name="id_pndd_ayah"]'),
        Data.getPendidikanterakhir(form, ' select[name="id_pndd_ibu"]'),
        Data.getPekerjaan(form, ' select[name="id_pek_ayah"]'),
        Data.getPekerjaan(form, ' select[name="id_pek_ibu"]'),
    ).done(function(usertype) {

        setTimeout(() => {
            getDatabyId();
        }, 1000);
    })


    $(document).on('click', '.fotosiswa', function(e) {
        e.preventDefault();
        $('.inputfotosiswa').trigger('click')
    })

    $(document).on('change', '.inputfotosiswa', function(event) {
        Main.previewimage(this, $('.fotosiswa'));
        setTimeout(() => {
            $('.fotosiswa').attr('src', Main.resizeImage(document.getElementById('fotosiswa'),
                200, 300))
        }, 300);
        // console.log();
    });


    $('input[name="jk"]').click(function() {
        $('input[name="jk"]').prop('checked', false);
        $(this).prop('checked', true);
    })
    $('input[name="wrg"]').click(function() {
        $('input[name="wrg"]').prop('checked', false);
        $(this).prop('checked', true);
    })
    $('input[name="bahasa"]').click(function() {
        $('input[name="bahasa"]').prop('checked', false);
        $(this).prop('checked', true);
    })

    $('.btn-print').click(function() {
        $('.hilang,.main-footer').hide();
        window.print();
        setTimeout(() => {
            $('.hilang,.main-footer').show()
        }, 300);
    })


    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        $('.btn-print').prop('disabled', false)
        if (id) {
            // untuk data siswa
            $.ajax({
                url: __base_url + "api/data/siswapsbdetailread",
                data: {
                    id: id,
                    nomor: '<?= isset($_GET['nomor']) ? $_GET['nomor'] : '' ?>'
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {

                    if(data.data.length==0){
                        swal(
                            'Updated!',
                            "Data siswa tidak ditemukan",
                            'warning'
                        );
                    }

                    $.each(data.data, function(i, value) {
                        if(value.id_tahun==0){
                            delete value.id_tahun;
                        }
                        if(value.status==''){
                            delete value.status;
                        }
                        Main.autoSetValue(form, value);

                        console.log(moment(value.tgl_lhr, 'YYYY-MM-DD').format(
                            'DD/MM/YYYY'))
                        $('input[name="tgl_lhr"]').val(moment(value.tgl_lhr, 'YYYY-MM-DD')
                            .format('DD/MM/YYYY'))
                        $('input[name="tgl_lhr_ayah"]').val(moment(value.tgl_lhr_ayah,
                            'YYYY-MM-DD').format('DD/MM/YYYY'))
                        $('input[name="tgl_lhr_ibu"]').val(moment(value.tgl_lhr_ibu,
                            'YYYY-MM-DD').format('DD/MM/YYYY'))

                        if (value.foto) {
                            $('.fotosiswa').attr('src', __base_url + __path_image +
                                'psb/' + value.foto);
                        }

                    });


                }
            })


        }
    }

    $('.btn-save').click(function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
        value.tgl_lhr = moment($(form + ' input[name="tgl_lhr"]').val(), 'DD/MM/YYYY').format(
            'YYYY-MM-DD');
        value.tgl_lhr_ayah = moment($(form + ' input[name="tgl_lhr_ayah"]').val(), 'DD/MM/YYYY').format(
            'YYYY-MM-DD');
        value.tgl_lhr_ibu = moment($(form + ' input[name="tgl_lhr_ibu"]').val(), 'DD/MM/YYYY').format(
            'YYYY-MM-DD');


        value.foto = $('.fotosiswa').attr('src');

        if (value.foto.indexOf(__base_url) != -1) {
            delete value.foto;
        }

        var url = $(form).attr('action');


        if (!value.id) {
            delete value.id;
        } else {
            url = __base_url + 'api/data/siswa_psb';
        }


        $.ajax({
            url: url,
            data: {
                data: JSON.stringify([value])
            },
            method: $(form).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('.border-success').removeClass('border-success');
                $('.border-error').removeClass('border-error');
                $(form + ' input[name="id"]').val(data.data);
                Main.autoSetError(form, [])
                $('.btn-print').prop('disabled', false);

                $('.btn-print').trigger('click');
            },
            error: function(e) {
                var value = e.responseJSON.error;
                $('.border-error').removeClass('border-error');
                $(form + ' input,' + form + ' textarea,' + form + ' select').each(
                    function() {
                        $(this).addClass('border-success');
                        for (var key in value) {
                            if (key == $(this).attr('name')) {
                                $(this).removeClass('border-success');
                                $(this).addClass('border-error');
                                // form_group.find('.help-block').text(value[key])
                            }
                        }


                    })
            },
            complete: function(e) {

            }
        });

    })



})
</script>

<?php
// echo '<pre>';
// var_dump($sekolah);
// echo '</pre>';

?>


<?php } ?>