
<form id="siswaForm" method="post" action="<?=base_url('api/akademik/siswa/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3">Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control" required>
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Kelas</label>
        <div class="col-md-9">
            <select name="id_kls" class="form-control">
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
        <label class="col-md-3">File Upload</label>
        <div class="col-md-9">
            <div class="input-group input-group-sm">
                <input type="file" id="fileUpload" class="form-control" />
                <span class="input-group-btn">
                    <button type="button" id="upload" class="btn btn-info btn-flat btn-upload">Upload</button>
                </span>
            </div>
        </div>
    </div>
    
    

    <hr />
    <div class="table-responsive" id="table-responsive">
        <table id="dvExcel" class="table table-striped table-bordered nowrap responsive"></table>
    </div>

    <hr />
    <div class="form-group" style="display:none;">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save-upload">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#siswaForm';

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getKelas(form, ' select[name="id_kls"]'),
        
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/siswa/read",
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