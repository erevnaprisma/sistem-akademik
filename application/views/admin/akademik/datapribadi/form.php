<form id="datapribadiForm" method="post" action="<?=base_url('api/akademik/datapribadi/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="id_siswa" value="<?=$id_siswa?>">
    <div class="form-group">
        <label class="col-md-3">Nama Panggilan</label>
        <div class="col-md-9">
            <input name="nm_panggilan" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tempat Lahir</label>
        <div class="col-md-9">
            <input name="tmp_lahir" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tanggal Lahir</label>
        <div class="col-md-9">
            <div class="input-group date onlydatepicker">
                <input name="tgl_lhr" class="form-control">
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
            <select name="id_agm" class="form-control chosen">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Kewarganegaraan</label>
        <div class="col-md-9">
            <input name="wrg" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Suku</label>
        <div class="col-md-9">
            <input name="suku" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Golongan Darah</label>
        <div class="col-md-9">
            <select name="id_goldar" class="form-control chosen">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tinggi</label>
        <div class="col-md-9">
            <input name="tinggi" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Berat</label>
        <div class="col-md-9">
            <input name="berat" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">UK. Baju</label>
        <div class="col-md-9">
            <input name="uk_baju" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">UK. Sepatu</label>
        <div class="col-md-9">
            <input name="uk_spt" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Alamat</label>
        <div class="col-md-9">
            <textarea name="alamat" class="form-control"></textarea>
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
        <label class="col-md-3">Email</label>
        <div class="col-md-9">
            <input name="email" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tinggal Dengan</label>
        <div class="col-md-9">
            <select name="id_sta_t_dgn" class="form-control chosen">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group" style="display:none;">
        <label class="col-md-3">Tinggal Dengan Lainnya</label>
        <div class="col-md-9">
            <input name="sta_t_dgn_lain" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Status Rumah</label>
        <div class="col-md-9">
            <select name="id_tem_t_dgn" class="form-control chosen">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group" style="display:none;">
        <label class="col-md-3">Status Rumah Lainnya</label>
        <div class="col-md-9">
            <input name="tem_t_dgn_lain" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Jarak Rumah</label>
        <div class="col-md-9">
            <select name="id_jrk_rmh" class="form-control chosen">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group" style="display:none;">
        <label class="col-md-3">Jarak Rumah Lainnya</label>
        <div class="col-md-9">
            <input name="jrk_rmh_lain" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Transportasi</label>
        <div class="col-md-9">
            <select name="id_trn_rmh" class="form-control chosen">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group" style="display:none;">
        <label class="col-md-3">Transportasi Lainnya</label>
        <div class="col-md-9">
            <input name="trn_rmh_lain" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Status Anak</label>
        <div class="col-md-9">
            <input name="status_anak" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Anak ke </label>
        <div class="col-md-9">
            <input name="ank_ke" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Dari</label>
        <div class="col-md-9">
            <input name="dari" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Jumlah Saudara Kandung</label>
        <div class="col-md-9">
            <input name="jml_sdr_kan" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Jumlah Saudara Tiri</label>
        <div class="col-md-9">
            <input name="jml_sdr_tir" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Jumlah Saudara Angkat</label>
        <div class="col-md-9">
            <input name="sdr_ang" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Pendidikan Dibiayai Oleh</label>
        <div class="col-md-9">
            <select name="pendidikan_oleh" class="form-control chosen">
                <option value="">Select</option>
            </select>
            <!-- <input name="pendidikan_oleh" class="form-control"> -->
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Dibeasiswakan Oleh</label>
        <div class="col-md-9">
            <input name="beasiswa_oleh" class="form-control">
            <span class="help-block"></span>
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

    var form = '#datapribadiForm';

    Main.onlydatepicker();

    $.when(
        Data.getJK(form, ' select[name="jk"]'),
        Data.getAgama(form, ' select[name="id_agm"]'),
        // Data.getAgama(form, ' select[name="agm_ayah"]'),
        // Data.getAgama(form, ' select[name="agm_ibu"]'),
        Data.getGoldar(form, ' select[name="id_goldar"]'),
        Data.getTempattinggal(form, ' select[name="id_tem_t_dgn"]'),
        Data.getStatustinggal(form, ' select[name="id_sta_t_dgn"]'),
        Data.getTransportasirumah(form, ' select[name="id_trn_rmh"]'),
        Data.getJarakrumah(form, ' select[name="id_jrk_rmh"]'),
        Data.getDibiayaioleh(form, ' select[name="pendidikan_oleh"]'),
        // Data.getPendidikanterakhir(form, ' select[name="id_pndd_ayah"]'),
        // Data.getPendidikanterakhir(form, ' select[name="id_pndd_ibu"]'),
        // Data.getPekerjaan(form, ' select[name="id_pek_ayah"]'),
        // Data.getPekerjaan(form, ' select[name="id_pek_ibu"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            $('select[name="id_sta_t_dgn"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_tem_t_dgn"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_jrk_rmh"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_trn_rmh"]').append($('<option>').text('Lainnya').attr('value',
                0));
            // $('select[name="id_pek_ayah"]').append($('<option>').text('Lainnya').attr('value',
            //     0));
            // $('select[name="id_pek_ibu"]').append($('<option>').text('Lainnya').attr('value',
            //     0));
            getDatabyId();
        }, 1000);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/datapribadi/read",
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
                        Main.autoSetValue(form, value)
                        $(form + ' input[name="tgl_lhr"]').val(value.tgl_lhr_name);
                        
                    });
                }
            })
        }
    }

})