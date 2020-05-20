<form id="homeForm" method="post" action="<?=base_url('api/anjungan/home/'.$action); ?>" class="form-horizontal">
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
        <label class="col-md-3"> Home</label>
        <div class="col-md-9">
            <textarea name="home" class="textarea" placeholder="Place some text here"
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
    var form = '#homeForm';

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
                url: __base_url + "api/anjungan/home/read",
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
                    $('iframe').contents().find('.wysihtml5-editor').html(data.data[0].home);
                }
            })
        }
    }

})