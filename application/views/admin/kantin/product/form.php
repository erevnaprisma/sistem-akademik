<form id="productForm" method="post" action="<?=base_url('api/kantin/product/'.$action); ?>" class="form-horizontal" enctype="multipart/form-data">
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
        <label class="col-md-3">Code</label>
        <div class="col-md-9">
            <input name="code" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Nama Produk</label>
        <div class="col-md-9">
            <input name="name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Kategori</label>
        <div class="col-md-9">
            <select name="category" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                <option value="">Pilih Kategori</option>
            </select>
        </div>
    </div>
    <div class="form-group" id="id_toko">
        <label class="col-md-3">Toko</label>
        <div class="col-md-9">
            <select name="id_toko" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                <option value="">Pilih Toko</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Harga Modal</label>
        <div class="col-md-9">
            <input name="purchase_price" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Harga Jual</label>
        <div class="col-md-9">
            <input name="retail_price" class="form-control">
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

    var form = '#productForm';
    // $('.select2').select2()
    
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getCategoryProduct(form, ' select[name="category"]'),
        Data.getOutlet(form, ' select[name="id_toko"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/kantin/product/read",
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