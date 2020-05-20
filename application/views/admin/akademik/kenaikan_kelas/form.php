<form id="kelulusanForm" method="post" action="<?=base_url('api/akademik/kenaikan_kelas/'.$action); ?>" class="form-horizontal">
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
        <label class="col-md-3"> Tahun</label>
        <div class="col-md-9">
            <select name="id_tahun" class="form-control">
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
        <label class="col-md-3">Siswa</label>
        <div class="col-md-9">
            <div class="input-group input-group-sm">
                <input name="nama_siswa" class="form-control readonly">
                <input type="hidden" name="id_siswa">
                <span class="input-group-btn">
                    <button type="button"
                        class="btn btn-info btn-flat btn-carisiswa <?= !empty($id) ? 'readonly' : '' ?>">Cari!</button>
                </span>
            </div>
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

    <!-- <hr />
    <div class="table-responsive" id="table-responsive">
        <table id="dvExcel" class="table table-striped table-bordered nowrap responsive"></table>
    </div>
    <hr /> -->

    <div class="form-group" style="">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#kelulusanForm';
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getTahun(form, ' select[name="id_tahun"]'),
        Data.getKelas(form, ' select[name="id_kelas"]'),
        Data.getSemester(form, ' select[name="id_semester"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        // Data.getSiswa(form, ' select[name="id_siswa"]')
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/kenaikan_kelas/read",
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
                    });

                }
            })
        }
    }

})