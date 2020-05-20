<form id="forumForm" method="post" action="<?=base_url('api/forum/forum/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="id_forum_type" value="<?=$id_forum_type; ?>">
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
        <label class="col-md-3">Title</label>
        <div class="col-md-9">
            <input name="title" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Konten</label>
        <div class="col-md-9">
            <textarea name="content" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Star</label>
        <div class="col-md-9">
            <input type="number" min="0" max="5" name="star" class="form-control"
                onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">View</label>
        <div class="col-md-9">
            <input type="number" min="0" name="view" class="form-control"
                onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Replay</label>
        <div class="col-md-9">
            <input type="number" min="0" name="replay" class="form-control"
                onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
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

    var form = '#forumForm';

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/forum/forum/read",
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
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})