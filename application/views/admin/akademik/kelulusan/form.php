<form id="kelulusanForm" method="post" action="<?=base_url('api/akademik/kelulusan/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
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
        <label class="col-md-3"> Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
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
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <button class="btn btn-primary btn-cari" disabled>Cari</button>
                </div>
            </div>

    <hr />
    <div class="table-responsive" id="table-responsive">
        <table id="dvExcel" class="table table-striped table-bordered nowrap responsive">
            <thead>
                        <tr>
                            <th>No</th>
                            <th>Check</th>
                            <th>Nama Siswa</th>
                            <th>Email Siswa</th>
                            <th>No Induk</th>
                            <th>NISN</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
        </table>
    </div>
    <hr />

    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save-upload">Submit</button>
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
        // setTimeout(() => {
        //     getDatabyId()
        // }, 300);
    })

})