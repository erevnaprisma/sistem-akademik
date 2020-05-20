<form id="karaktersiswaForm" method="post" action="<?=base_url('api/akademik/karaktersiswa/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="flag" value="<?=$flag; ?>">
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
        <label class="col-md-3"> Tahun Ajaran</label>
        <div class="col-md-9">
            <select name="id_tahun_ajaran" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Semester</label>
        <div class="col-md-9">
            <select name="id_semester" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Jurusan</label>
        <div class="col-md-9">
            <select name="id_jurusan" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Kelas</label>
        <div class="col-md-9">
            <select name="id_kelas" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Mata Pelajaran</label>
        <div class="col-md-9">
            <select name="id_mapel" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Siswa</label>
        <div class="col-md-9">
            <div class="input-group input-group-sm">
                <input name="nama_siswa" class="form-control readonly">
                <input type="hidden" name="id_siswa">
                <span class="input-group-btn">
                    <button type="button"
                        class="btn btn-info btn-flat btn-carisiswa <?= !empty($id) ? 'readonlyyy' : '' ?>">Cari!</button>
                </span>
            </div>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tanggal</label>
        <div class="col-md-9">
            <div class="input-group date onlydatepicker">
                <input name="tanggal" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3">Karakter</label>
        <div class="col-md-9">
            <input name="penilaian" class="form-control">
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


    if('<?= $flag == 'diri'?>'){
        $('#myModalsiswa').attr('data-karakter','diri')
    } else {
        $('#myModalsiswa').attr('data-karakter','teman')
    }

    var form = '#karaktersiswaForm';

    Main.onlydatepicker();

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/karaktersiswa/read",
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
                        $(form + ' input[name="tanggal"]').val(moment(value.tanggal, "YYYY/MM/DD").format("DD/MM/YYYY"));
                    });

                }
            })
        }
    }

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getKelas(form, ' select[name="id_kelas"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        Data.getSemester(form, ' select[name="id_semester"]'),
        Data.getMapel(form, ' select[name="id_mapel"]'),
        Data.getTahunAjaran(form, ' select[name="id_tahun_ajaran"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})