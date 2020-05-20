<table id="absensiKaryawanForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#absensiKaryawanForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/absensi/absensi_karyawan/read",
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
                            'id', 'date_of_entry', 'date_of_out', 'come_late', 'user_name', 
                            'nm_skl', 'is_active_name',
                            'created_by_name', 'created_dt', 'updated_by_name',
                            'updated_dt'
                        ])
                    });
                }
            })
        }
    }
    getDatabyId();
})