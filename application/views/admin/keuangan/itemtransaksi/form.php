<form id="itemtransaksiForm" method="post" action="<?=base_url('api/keuangan/itemtransaksi/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
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
        <label class="col-md-3">Tahun Buku</label>
        <div class="col-md-9">
            <select name="id_a_thn" class="form-control <?= !empty($id) ? '' : '' ?>">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Jenis Transaksi</label>
        <div class="col-md-9">
            <select name="id_jns_transaksi" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Pembayaran</label>
        <div class="col-md-9">
            <input name="pembayaran" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Nominal</label>
        <div class="col-md-9">
            <input name="nominal" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Jatuh Tempo</label>
        <div class="col-md-9">
            <div class="input-group date onlydatepicker">
                <input name="alert_date" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
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


    Main.onlydatepicker();

    var form = '#itemtransaksiForm';

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/keuangan/itemtransaksi/read",
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
        Data.getTahun(form, ' select[name="id_a_thn"]'),
        Data.getJenisTransaksi(form, ' select[name="id_jns_transaksi"]',{
            id_kode_gl: '<?= GL_MASUK ?>',
            is_active: 1
        }),
    ).done(function(usertype) {
        setTimeout(() => {
            $('select[name="id_a_thn"]').val(new Date().getFullYear());
            getDatabyId()
        }, 300);
    })

})