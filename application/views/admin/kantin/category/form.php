<form id="categoryForm" method="post" action="<?=base_url('api/kantin/category/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3">Nama Kategori</label>
        <div class="col-md-9">
            <input name="name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
                <option value="">Pilih Sekolah</option>
            </select>
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

    var form = '#categoryForm';
    $('.select2').select2({
        dropdownParent: $('#myModal')
    });
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
                url: __base_url + "api/kantin/category/read",
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
                        //console.log(value.id_user);
                        Main.autoSetValue(form, value);
                        if(value.id_user != ''){
                            $(form + ' select[name="id_user"]').select2("val",value.id_user);
                        }
                    });

                }
            })
        }
    }


})