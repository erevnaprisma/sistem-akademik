<form id="nilaiUtsForm" method="post" action="<?=base_url('api/akademik/nilai_uts/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="id_nilai_siswa" value="<?=$id_nilai_siswa; ?>">
    <!-- input states -->
    <?php if ($action == 'create' || $action == 'update') {
    ?>
    <div class="form-group">
        <label class="col-md-3"> Nilai UTS </label>
        <div class="col-md-9">
            <input type="number" name="nilai_uts" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Keterangan</label>
        <div class="col-md-9">
            <textarea name="keterangan" class="form-control"></textarea>
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
    <?php
}?>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#nilaiUtsForm';
    
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/nilai_uts/read",
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
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})