<style>
#dataorangtuaForm .box.box-solid {
    border: 1px solid #ccc;
}
.fotosiswa,.fotoayah,.fotoibu{
    width:215px;
    height:215px;
}
</style>
<form id="dataorangtuaForm" method="post" action="<?=base_url('api/akademik/dataorangtua/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="id_siswa" value="<?=$id_siswa; ?>">
    <!-- input states -->

    <div class="box box-solid">
        <div class="box-header with-border bg-aqua">
            <h3 class="box-title">Data Ayah</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-3">Nama</label>
                <div class="col-md-9">
                    <input name="nm_ayah" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Nama Panggilan</label>
                <div class="col-md-9">
                    <input name="pg_ayah" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Tempat Lahir</label>
                <div class="col-md-9">
                    <input name="tmp_lhr_ayah" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Tanggal Lahir</label>
                <div class="col-md-9">
                    <div class="input-group date onlydatepicker">
                        <input name="tgl_lhr_ayah" class="form-control">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Agama</label>
                <div class="col-md-9">
                    <select name="agm_ayah" class="form-control chosen">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Kewarganegaraan</label>
                <div class="col-md-9">
                    <input name="wrg_ayah" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Pendidikan Terakhir</label>
                <div class="col-md-9">
                    <select name="id_pndd_ayah" class="form-control chosen">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Sekolah Pendidikan Terakhir</label>
                <div class="col-md-9">
                    <input name="pnddk_ayah" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Pekerjaan</label>
                <div class="col-md-9">
                    <select name="id_pek_ayah" class="form-control chosen">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group" style="display:none;">
                <label class="col-md-3">Pekerjaan Lainnya</label>
                <div class="col-md-9">
                    <input name="pek_ayah_lain" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Jabatan</label>
                <div class="col-md-9">
                    <input name="jbt_ayah" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Gaji</label>
                <div class="col-md-9">
                    <input name="gaji_ayah" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Alamat Kantor</label>
                <div class="col-md-9">
                    <textarea name="almt_knt_ayah" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Alamat Rumah</label>
                <div class="col-md-9">
                    <textarea name="almt_rmh_ayah" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Telpon</label>
                <div class="col-md-9">
                    <input name="telp" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Keterangan</label>
                <div class="col-md-9">
                    <textarea name="ket" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Foto</label>
                <div class="col-md-9">
                    <input type="file" name="fotoayah" accept="image/*" class="inputfotoayah form-control">
                    <img class="img-responsive img-circle fotoayah"
                        src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar4.png')?>">
                    <span class="help-block"></span>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
    </div>

    <div class="box box-solid">
        <div class="box-header with-border bg-green">
            <h3 class="box-title">Data Ibu</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-3">Nama</label>
                <div class="col-md-9">
                    <input name="nm_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Nama Panggilan</label>
                <div class="col-md-9">
                    <input name="pg_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Tempat Lahir</label>
                <div class="col-md-9">
                    <input name="tmp_lhr_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Tanggal Lahir</label>
                <div class="col-md-9">
                    <div class="input-group date onlydatepicker">
                        <input name="tgl_lhr_ibu" class="form-control">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Agama</label>
                <div class="col-md-9">
                    <select name="agm_ibu" class="form-control chosen">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Kewarganegaraan</label>
                <div class="col-md-9">
                    <input name="wrg_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Pendidikan Terakhir</label>
                <div class="col-md-9">
                    <select name="id_pndd_ibu" class="form-control chosen">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Sekolah Pendidikan Terakhir</label>
                <div class="col-md-9">
                    <input name="pndd_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Pekerjaan</label>
                <div class="col-md-9">
                    <select name="id_pek_ibu" class="form-control chosen">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group" style="display:none;">
                <label class="col-md-3">Pekerjaan Lainnya</label>
                <div class="col-md-9">
                    <input name="pek_ibu_lain" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Jabatan</label>
                <div class="col-md-9">
                    <input name="jbt_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Gaji</label>
                <div class="col-md-9">
                    <input name="gaji_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Alamat Kantor Ayah</label>
                <div class="col-md-9">
                    <textarea name="almt_knt_ibu" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Alamat Rumah Ayah</label>
                <div class="col-md-9">
                    <textarea name="almt_rmh_ibu" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Telpon</label>
                <div class="col-md-9">
                    <input name="telp_ibu" class="form-control">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Keterangan</label>
                <div class="col-md-9">
                    <textarea name="ket_ibu" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Foto</label>
                <div class="col-md-9">
                    <input type="file" name="fotoibu" accept="image/*" class="inputfotoibu form-control">
                    <img class="img-responsive img-circle fotoibu"
                        src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar2.png')?>">
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
    </div>




    <div class="form-group">
        <label class="col-md-3">Is Active</label>
        <div class="col-md-9">
            <input type="checkbox" name="is_active">
            Yes
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#dataorangtuaForm';

    Main.onlydatepicker();



    $.when(
        Data.getAgama(form, ' select[name="agm_ayah"]'),
        Data.getAgama(form, ' select[name="agm_ibu"]'),
        // Data.getGoldar(form, ' select[name="id_goldar"]'),
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
            getDatabyId()
        }, 300);
    })


    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/dataorangtua/read",
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
                        Main.autoSetValue(form, value);
                        $(form + ' input[name="tgl_lhr_ayah"]').val(value
                            .tgl_lhr_ayah_name);
                        $(form + ' input[name="tgl_lhr_ibu"]').val(value.tgl_lhr_ibu_name);
                        if (value.foto_ayah) {
                            $('.fotoayah').attr('src', __base_url + __path_image +
                                'user/' + value.foto_ayah);
                        }
                        if (value.foto_ibu) {
                            $('.fotoibu').attr('src', __base_url + __path_image +
                                'user/' + value.foto_ibu);
                        }
                    });

                }
            })
        }
    }
})