<form id="detailProsemForm" method="post" action="<?=base_url('api/akademik/detail_prosem/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <!-- input states -->
    <?php if ($action == 'create' || $action == 'update') {
    ?>
    <div class="form-group">
        <label class="col-md-3 detail_prosem"> Detail Prosem <?= $id_prosem ?></label>
        <div class="col-md-9">
            <input type="text" name="detail_bidang" class="form-control">
            <input type="hidden" name="id_prosem" value="<?= $id_prosem ?>">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 aw_1"> Detail Alokasi Waktu 1</label>
        <div class="col-md-9">
            <input type="text" name="detail_aw_1" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 aw_2"> Detail Alokasi Waktu 2</label>
        <div class="col-md-9">
            <input type="text" name="detail_aw_2" class="form-control">
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

    var form = '#detailProsemForm';
    var id_prosem = parseInt("<?= $id_prosem ?>");
    function getProsemById(value) {
        if (value) {
            $.ajax({
                url: __base_url + "api/akademik/prosem/read",
                data: {
                    id: value
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    console.log(data.data[0]);
                    $(".detail_prosem").text(data.data[0].bidang);
                    $(".aw_1").text(data.data[0].aw_1);
                    $(".aw_2").text(data.data[0].aw_2);
                }
            })
        }
    }

    setTimeout(function(){ 
        getProsemById(id_prosem); 
    }, 300);
    // }, 1000);
    
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/detail_prosem/read",
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
 
    getDatabyId();

})