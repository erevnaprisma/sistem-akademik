<table id="dokumenForm" class="table table-bordered">
    <tbody></tbody>
</table>

<img class="dokumenPath" src="" alt="" style="width:100%">

<script>
$(document).ready(function() {
    var form = "#dokumenForm";

    function getDatabyId() {
        var id = "<?= $id; ?>";
        if (id) {
            $.ajax({
                url: __base_url + "api/transaksi/dokumen/read",
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
                            'id', 'sekolah', 'hal','name','flaging',
                            'is_active_name',
                            'created_by_name', 'created_dt', 'updated_by_name',
                            'updated_dt'
                        ]);
                        var path = __base_url + '<?= PATH_PUBLIC_ATTACH ?>';
                        if(value.flag==0){
                            path += "dok/" + value.name;
                        } else if(value.flag==1) {
                            path += "img/" + value.name;
                        } else {
                            path += "vid/" + value.name;
                        }
                        $('.dokumenPath').attr('src',path);
                    });
                }
            })
        }
    }
    getDatabyId();
})