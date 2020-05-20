<form id="rppForm" method="post" action="<?=base_url('api/akademik/rpp/'.$action); ?>" class="form-horizontal">
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
    <!-- <div class="form-group">
        <label class="col-md-3"> Tingkat</label>
        <div class="col-md-9">
            <input type="number" name="tingkat" class="form-control">
            <span class="help-block"></span>
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-md-3"> Semester</label>
        <div class="col-md-9">
            <select name="id_semester" class="form-control select2">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Mata Pelajaran</label>
        <div class="col-md-9">
            <select name="id_mapel" class="form-control select2">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3"> Kode</label>
        <div class="col-md-9">
            <input type="text" name="kode" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Materi</label>
        <div class="col-md-9">
            <input type="text" name="materi" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Deskripsi</label>
        <div class="col-md-9">
            <textarea name="desc" class="form-control"></textarea>
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

    var form = '#rppForm';



    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/rpp/read",
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

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getSemester(form, ' select[name="id_semester"]'),
        Data.getMapel(form, ' select[name="id_mapel"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})