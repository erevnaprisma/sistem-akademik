<table id="kegiatanekskulForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#kegiatanekskulForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/kesiswaan/kegiatanekskul/read",
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
                            'id', 'sekolah','ekskul', 'kegiatan', 'tanggal_name','pkl_mulai','pkl_selesai','tempat',
                            'is_active_name',
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