<form id="berbagiebookForm" method="post" action="<?=base_url('api/forum/berbagi/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="flag" value="ebook">
    <div class="form-group">
        <label class="col-md-3"> Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3">Nama</label>
        <div class="col-md-9">
            <input name="nama" class="form-control">
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

    var form = '#berbagiebookForm';

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
                url: __base_url + "api/forum/berbagi/read",
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