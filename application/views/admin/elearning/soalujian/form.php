<form id="soalujianForm" method="post" action="<?=base_url('api/elearning/soalujian/'.$action); ?>"
    class="form-horizontal">
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
        <label class="col-md-3">Jurusan</label>
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
        <label class="col-md-3"> Mapel</label>
        <div class="col-md-9">
            <select name="id_mapel" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Judul</label>
        <div class="col-md-9">
            <input name="judul" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Mulai</label>
        <div class="col-md-9">
            <div class="input-group date datetimepicker">
                <input name="mulai" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3">Selesai</label>
        <div class="col-md-9">
            <div class="input-group date datetimepicker">
                <input name="selesai" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3">Durasi (Menit)</label>
        <div class="col-md-9">
            <input type="number" name="durasi" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Keterangan</label>
        <div class="col-md-9">
            <textarea name="ket" class="form-control"></textarea>
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

    Main.datetimepicker();
    var form = '#soalujianForm';

    function getDatabyId() {
        console.log('getDatabyId di form.php invoked')
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/elearning/soalujian/read",
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
                        $(form + ' input[name="mulai"]').val(value.mulai_name)
                        $(form + ' input[name="selesai"]').val(value.selesai_name)
                    });

                }
            })
        }
    }

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getTahunAjaran(form, ' select[name="id_tahun_ajaran"]'),
        Data.getSemester(form, ' select[name="id_semester"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        Data.getKelas(form, ' select[name="id_kelas"]'),
        Data.getMapel(form, ' select[name="id_mapel"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})