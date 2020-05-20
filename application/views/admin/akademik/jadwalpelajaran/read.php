<table id="jadwalpelajaranForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#jadwalpelajaranForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/jadwalpelajaran/read",
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
                            'id', 'jurusan_name', 'kelas_name','semester_name','hari_name', 'mapel_name',
                            'sekolah_name', 'pkl_mulai','pkl_selesai',
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