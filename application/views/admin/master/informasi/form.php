<form id="informasiForm" method="post" action="<?=base_url('api/master/informasi/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- <input type="hidden" name="flag" value="mobile"> -->
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
        <label class="col-md-3">Kepada</label>
        <div class="col-md-9">
            <select name="kepada" class="form-control chosen">
                <option value="">Select</option>
                <?php foreach ($this->m_informasi->flaging as $key => $value) { ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php } ?>
            </select>
            <span class="help-block"></span>
        </diV>
    </div>

    <div class="form-group">
        <label class="col-md-3">Prihal</label>
        <div class="col-md-9">
            <input name="prihal" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Keterangan</label>
        <div class="col-md-9">
            <textarea name="keterangan" rows="10" class="form-control"></textarea>
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

    var form = '#informasiForm';
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
                url: __base_url + "api/master/informasi/read",
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