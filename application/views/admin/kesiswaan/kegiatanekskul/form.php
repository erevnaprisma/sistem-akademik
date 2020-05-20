<form id="kegiatanekskulForm" method="post" action="<?=base_url('api/kesiswaan/kegiatanekskul/'.$action); ?>" class="form-horizontal">
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
        <label class="col-md-3"> Ekskul</label>
        <div class="col-md-9">
            <select name="id_ekskul" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Kegiatan</label>
        <div class="col-md-9">
            <input type="text" name="kegiatan" class="form-control">
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
        <label class="col-md-3">Mulai</label>
        <div class="col-md-9">
            <div class="input-group date onlytimepicker">
                <input name="pkl_mulai" class="form-control">
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
            <div class="input-group date onlytimepicker">
                <input name="pkl_selesai" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Tempat</label>
        <div class="col-md-9">
            <input type="text" name="tempat" class="form-control">
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

    var form = '#kegiatanekskulForm';
    Main.onlydatepicker();
    Main.onlytimepicker();

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/kesiswaan/kegiatanekskul/read",
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
                        $(form + ' input[name="tanggal"]').val(value.tanggal_name);
                    });

                }
            })
        }
    }
 
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getEkskul(form, ' select[name="id_ekskul"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})