<form id="infoForm" method="post" action="<?=base_url('api/anjungan/info/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="hal" value="<?= $hal ?>">
    <div class="form-group">
        <label class="col-md-3"> Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>

    <?php if($hal=='madingnote'){?>

    <div class="form-group">
        <label class="col-md-3"> Kepada</label>
        <div class="col-md-9">
            <input type="text" name="kepada" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>

    <?php } ?>
    <div class="form-group">
        <label class="col-md-3"> Note</label>
        <div class="col-md-9">
            <textarea name="note" class="textarea" placeholder="Place some text here"
                style="width: 100%; height: 200px;">
                          </textarea>
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

    var form = '#infoForm';

    $(form + ' .textarea').wysihtml5();
    window.describeEditor = window.editor;

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
                url: __base_url + "api/anjungan/info/read",
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
                    $('iframe').contents().find('.wysihtml5-editor').html(data.data[0].note);
                }
            })
        }
    }
})