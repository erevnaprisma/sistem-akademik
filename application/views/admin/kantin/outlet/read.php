<table id="outletForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#outletForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
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
                    $.each(data.data, function(i, value) {
                        Main.autoSetTableRead(form, value, [
                            'nama_toko',
                            'nm_skl',
                            'foto',
                            'keterangan',
                            'created', 'created_dt', 
                            'updated',
                            'updated_dt'
                        ])
                    });
                }
            })
        }
    }
    getDatabyId();
})