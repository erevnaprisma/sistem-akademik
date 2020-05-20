<form id="notifForm" method="post" action="<?=base_url('api/master/notif/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="flag" value="mobile">
    <div class="form-group">
        <label class="col-md-3"> Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-md-3">Flag</label>
        <div class="col-md-9">
            <select name="flag" class="form-control chosen">
                <option value="">Select</option>
                < ?php foreach ($this->m_notif->flaging as $key => $value) { ?>
                    <option value="< ?= $key ?>">< ?= $value ?></option>
                < ?php } ?>
            </select>
            <span class="help-block"></span>
        </diV>
    </div> -->
    <!-- <div class="form-group">
        <label class="col-md-3">Tanggal</label>
        <div class="col-md-9">
            <div class="input-group date datetimepicker">
                <input name="tanggal" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div> -->
    <div class="form-group">
        <label class="col-md-3">Title</label>
        <div class="col-md-9">
            <input name="title" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Note</label>
        <div class="col-md-9">
            <textarea name="note" class="form-control"></textarea>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-md-3"> Kata Motivasi</label>
        <div class="col-md-9">
            <input type="file" name="file" class="form-control">
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

    var form = '#notifForm';

    Main.datetimepicker();

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/master/notif/read",
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
                        // $(form + ' input[name="tanggal_selesai"]').val(value.tanggal_selesai_name);
                    });
                }
            })
        }
    }
})