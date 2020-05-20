<form id="kodeGlForm" method="post" action="<?=base_url('api/keuangan/kode_gl/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3"> Kode</label>
        <div class="col-md-9">
            <input type="text" name="kode" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> keterangan</label>
        <div class="col-md-9">
            <textarea name="ket" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
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

    var form = '#kodeGlForm';

    function getSekolah() {
        $.ajax({
            url: __base_url + "api/master/sekolah/read",
            data: {
                is_active: 1,
                where: "ask.id in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")"
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $(form + ' select[name="id_skl"]').append($('<option>').text(value
                        .nm_skl).attr('value', value.id));
                });
            }
        })

    }
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/keuangan/kode_gl/read",
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
        // getMapel(),
        getSekolah()
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})