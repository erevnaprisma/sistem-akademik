<form id="outletForm" method="post" action="<?=base_url('api/kantin/outlet/'.$action); ?>" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3">Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
                <option value="">Pilih Sekolah</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Nama Outlet</label>
        <div class="col-md-9">
            <input name="nama_toko" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">User</label>
        <div class="col-md-9">
            <select name="id_user" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                <option value="">Pilih User</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Keterangan</label>
        <div class="col-md-9">
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Is Active</label>
        <div class="col-md-9">
            <input type="checkbox" name="is_active">
            Yes
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-md-3">Foto</label>
        <div class="col-md-9" id="gambar">
            <input type="file" name="foto" id="foto" class="form-control" value="" />
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#outletForm';
    $('.select2').select2();


    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getUser(form, ' select[name="id_user"]',{
            user_type_id: '<?= USER_TYPE_PEDAGANG ?>', is_active: 1, 
            where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")"
        }),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

    
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/kantin/outlet/read",
                data: {
                    id: id
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    console.log(data);
                    $.each(data.data, function(i, value) {
                        Main.autoSetValue(form, value);
                    });

                }
            })
        }
    }

})