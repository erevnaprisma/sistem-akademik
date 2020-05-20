<form id="cashlesspaymentForm" method="post" action="<?=base_url('api/keuangan/cashlesspayment/'.$action); ?>"
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
        <label class="col-md-3">Trans</label>
        <div class="col-md-9">
            <select name="trans" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">User</label>
        <div class="col-md-9">
            <div class="input-group input-group-sm">
                <input name="nama_user" class="form-control readonly">
                <input type="hidden" name="id_user">
                <span class="input-group-btn">
                    <button type="button"
                        class="btn btn-info btn-flat btn-cariuser <?= !empty($id) ? 'readonly' : '' ?>">Cari!</button>
                </span>
            </div>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Nominal</label>
        <div class="col-md-9">
            <input name="nominal" class="form-control">
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-md-3">Is Active</label>
        <div class="col-md-9">
            <input type="checkbox" name="is_active">
            Yes
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#cashlesspaymentForm';

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/keuangan/cashlesspayment/read",
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
        Data.getTrans(form, ' select[name="trans"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})