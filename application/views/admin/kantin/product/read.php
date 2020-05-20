<table id="productForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#productForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
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
                    $.each(data.data, function(i, value) {
                        Main.autoSetTableRead(form, value, [
                            'nama_toko',
                            'code',
                            'name',
                            'nm_skl',
                            'kategori',
                            'purchase_price',
                            'retail_price',
                            'foto',
                            'created', 'created_dt', 
                            'updated',
                            'updated_dt'
                        ], '2')
                    });
                }
            })
        }
    }
    getDatabyId();
})