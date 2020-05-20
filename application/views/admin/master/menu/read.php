<table id="menuForm" class="table table-bordered">
    <tbody></tbody>
</table>

<table id="actionForm" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Default URL</th>
            <th>Is Active</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
$(document).ready(function() {
    var form = "#menuForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/master/menu/read",
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
                            'id', 'parent_name', 'name', 'label', 'default_url',
                            'icon', 'is_active_name',
                            'created_by_name', 'created_dt', 'updated_by_name',
                            'updated_dt'
                        ])
                    });
                }
            })
            $.ajax({
                url: __base_url + "api/master/menu/read",
                data: {
                    menu_id: id,
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    Main.autoSetTableHeader('#actionForm', data.data, [
                        'name', 'default_url','is_active_name',
                    ])
                }
            })
        }
    }
    getDatabyId();
})