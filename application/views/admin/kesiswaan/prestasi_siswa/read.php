<table id="prestasiSiswaForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#prestasiSiswaForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/kesiswaan/prestasi_siswa/read",
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
                            'id', 'sekolah','jurusan', 'nama_kelas', 'semester', 'nama_siswa', 'prestasi', 'tanggal',
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