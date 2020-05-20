<form id="sekolahForm" method="post" action="<?=base_url('api/master/sekolah/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3">Sekolah</label>
        <div class="col-md-9">
            <input name="nm_skl" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Kepala Sekolah</label>
        <div class="col-md-9">
            <input name="kepala_sekolah" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Sub Domain</label>
        <div class="col-md-9">
            <input name="slug" class="form-control" placeholder="sekolahtingkatlokasi, contoh: prismasmpdepok">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Alamat</label>
        <div class="col-md-9">
            <textarea name="alamat" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Kota</label>
        <div class="col-md-9">
            <input name="kota" class="form-control">
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

    var form = '#sekolahForm';

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/master/sekolah/read",
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

    $.when().done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })


    $(document).on('keyup', form + ' input[name="nm_skl"]', function() {
        $(form + ' input[name="slug"]').val(Main.convertToSlug($(this).val()))
    })

})