<table id="forumForm" class="table table-bordered">
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#forumForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        var id_forum_type = "<?= $id_forum_type; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/forum/forum/read",
                data: {
                    id: id,
                    id_forum_type: id_forum_type,
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    $.each(data.data, function(i, value) {
                        Main.autoSetTableRead(form, value, [
                            'id','sekolah','forum_type','title','star','view','replay',
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