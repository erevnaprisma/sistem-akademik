<table id="pegawaiForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#pegawaiForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/kepegawaian/pegawai/read",
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
                            'id', 'name',
                            'tmp_lhr', 'tgl_lhr',
                            'jk', 'id_agama',
                            'suku', 'status_kwn',
                            'tinggi', 'berat',
                            'uk_baju', 'uk_spt',
                            'id_goldar', 'alamat',
                            'tlp_rmh', 'hp',
                            'email', 'no_induk',
                            'bagian', 'jabatan',
                            'golongan', 'status',
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