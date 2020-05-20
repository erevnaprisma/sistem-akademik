<form id="nilaiSiswaForm" method="post" action="<?=base_url('api/akademik/nilai_siswa/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="id_penilaian" value="<?=$id_penilaian; ?>">
    <!-- input states -->
    <?php if ($action == 'create' || $action == 'update') {
    ?>
    <div class="form-group">
        <label class="col-md-3">Siswa</label>
        <div class="col-md-9">
            <select name="id_siswa" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
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

    var form = '#nilaiSiswaForm';

    function getSiswa() {
        $.ajax({
            url: __base_url + "api/akademik/siswa/read",
            data: {
                is_active: 1
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $(form + ' select[name="id_siswa"]').append($('<option>').text(value
                        .nama_siswa).attr('value', value.id));
                });
            }
        })
    }
    
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/nilai_siswa/read",
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
        getSiswa()
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})