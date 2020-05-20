<style type="text/css">
    #cm {
        position: absolute;
        right: 8%;
        top: 18%;
    }
</style>

<form id="pegawaiForm" method="post" action="<?=base_url('api/kepegawaian/pegawai/'.$action); ?>" class="form-horizontal" enctype='multipart/form-data'>
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3">Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Nama</label>
        <div class="col-md-9">
            <input type="text" name="nama" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Tempat Lahir</label>
        <div class="col-md-9">
            <input type="text" name="tmp_lhr" class="form-control">
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
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Jenis Kelamin</label>
        <div class="col-md-9">
            <select name="jk" class="form-control ">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Agama</label>
        <div class="col-md-9">
            <select name="id_agama" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Suku </label>
        <div class="col-md-9">
            <input type="text" name="suku" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Status Kawin</label>
        <div class="col-md-9">
            <select name="status_kwn" class="form-control ">
                  <option value="">Select</option>
                </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Tinggi</label>
        <div class="col-md-9">
            <input type="number" name="tinggi" class="form-control"> <b id="cm">cm</b>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Berat</label>
        <div class="col-md-9">
            <input type="number" name="berat" class="form-control"> <b id="cm">kg</b>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Ukuran Baju</label>
        <div class="col-md-9">
            <input type="text" name="uk_baju" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Ukuran Sepatu</label>
        <div class="col-md-9">
            <input type="number" name="uk_spt" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Golongan Darah</label>
        <div class="col-md-9">
            <select name="id_goldar" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> alamat</label>
        <div class="col-md-9">
            <textarea class="form-control" name="alamat"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Tlp Rumah</label>
        <div class="col-md-9">
            <input type="text" name="tlp_rmh" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> HP</label>
        <div class="col-md-9">
            <input type="text" name="hp" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Email</label>
        <div class="col-md-9">
            <input type="email" name="email" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> No Induk</label>
        <div class="col-md-9">
            <input type="text" name="no_induk" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Bagian</label>
        <div class="col-md-9">
            <input type="text" name="bagian" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Jabatan</label>
        <div class="col-md-9">
            <input type="text" name="jabatan" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
   <!--  <div class="form-group">
        <label class="col-md-3"> Upload Foto</label>
        <div class="col-md-9">
            <input type="file" class="form-control" name="foto">
            <span class="help-block"></span>
        </div>
    </div> -->
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

    var form = '#pegawaiForm';
    Main.onlydatepicker();


    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/kepegawaian/pegawai/read",
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
                        $(form + ' input[name="tgl_lhr"]').val(moment(value.tgl_lhr_name, "YYYY/MM/DD").format("DD/MM/YYYY"));
                    });

                }
            })
        }
    }

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getAgama(form, ' select[name="id_agama"]'),
        Data.getJK(form, ' select[name="jk"]'),
        Data.getGoldar(form, ' select[name="id_goldar"]'),
        Data.getStatusKawin(form, ' select[name="status_kwn"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})