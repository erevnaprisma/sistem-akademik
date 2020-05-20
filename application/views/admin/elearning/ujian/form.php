<form id="ujianForm" method="post" action="<?=base_url('api/elearning/ujian/'.$action); ?>"
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
        <label class="col-md-3">Jenis ujian</label>
        <div class="col-md-9">
            <select name="id_jenis_ujian" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">ujian</label>
        <div class="col-md-9">
            <input name="ujian" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Pengarang</label>
        <div class="col-md-9">
            <input name="pengarang" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Penerbit</label>
        <div class="col-md-9">
            <input name="penerbit" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tahun</label>
        <div class="col-md-9">
            <input name="tahun" class="form-control">
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

    var form = '#ujianForm';

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/elearning/ujian/read",
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
        Data.getJenisujian(form, ' select[name="id_jenis_ujian"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})