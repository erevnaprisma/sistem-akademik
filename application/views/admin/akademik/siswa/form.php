<style>
.fotosiswa,.fotoayah,.fotoibu{
    width:215px;
    height:215px;
}
</style>
<form id="siswaForm" method="post" action="<?=base_url('api/akademik/siswa/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="id_user">
    <input type="hidden" name="user_type_id" value="<?= USER_TYPE_SISWA ?>">
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
        <label class="col-md-3"> ID Kartu</label>
        <div class="col-md-9">
            <input type="text" name="id_card" class="form-control">
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
        <label class="col-md-3"> Nama Siswa</label>
        <div class="col-md-9">
            <input type="text" name="nama_siswa" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-md-3"> Name</label>
        <div class="col-md-9">
            <input type="text" name="name" class="form-control">
            <span class="help-block"></span>
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-md-3"> Email</label>
        <div class="col-md-9">
            <input type="text" name="email" class="form-control" readonly>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Jurusan</label>
        <div class="col-md-9">
            <select name="id_jurusan" class="form-control" disabled>
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Kelas</label>
        <div class="col-md-9">
            <select name="id_kls" class="form-control" disabled>
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    
    <!-- <div class="form-group">
        <label class="col-md-3"> Email</label>
        <div class="col-md-9">
            <input type="email" name="email" class="form-control">
            <span class="help-block"></span>
        </div>
    </div> -->
    
    <!-- <div class="form-group">
        <label class="col-md-3"> NISN</label>
        <div class="col-md-9">
            <input type="text" name="nisn" class="form-control">
            <span class="help-block"></span>
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-md-3"> Jenis Kelamin</label>
        <div class="col-md-9">
            <select name="jk" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Angkatan</label>
        <div class="col-md-9">
            <input type="text" name="angkatan" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> HP siswa</label>
        <div class="col-md-9">
            <input type="text" name="hp_siswa" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> HP Ortu 1</label>
        <div class="col-md-9">
            <input type="text" name="hp_ortu_1" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> HP Ortu 2</label>
        <div class="col-md-9">
            <input type="text" name="hp_ortu_2" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Email ortu 1</label>
        <div class="col-md-9">
            <input type="email" name="email_ortu_1" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3"> Email ortu 2</label>
        <div class="col-md-9">
            <input type="email" name="email_ortu_2" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Foto</label>
        <div class="col-md-9">
            <input type="file" name="fotosiswa" accept="image/*" class="inputfotosiswa form-control">
            <img class="img-responsive img-circle fotosiswa" src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar5.png')?>">
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

    var form = '#siswaForm';

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        Data.getKelas(form, ' select[name="id_kls"]'),
        Data.getJK(form, ' select[name="jk"]'),

    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/siswa/read",
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
                        if (value.foto) {
                            $('.fotosiswa').attr('src', __base_url + __path_image +
                                'user/' + value.foto);
                        }
                        $(form + ' input[name="email"]').val(value.emailname);
                    });

                }
            })
        }
    }

})