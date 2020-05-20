<form id="userForm" role="form" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group has-success">
        <label class="col-md-3"></i> Name</label>
        <div class="col-md-9">
            <input type="text" name="name" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group has-success">
        <label class="col-md-3"></i> Email</label>
        <div class="col-md-9">
            <input type="text" name="email" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <!-- <div class="form-group has-success">
                  <label class="col-md-3"></i> Password</label>
                  <div class="col-md-9">
                  <input type="password" name="password" class="form-control">
                  <span class="help-block"></span>
                </div>
                </div> -->
    <div class="form-group">
        <label class="col-md-3">User Type</label>
        <div class="col-md-9">
            <select name="user_type_id" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Is Active</label>
        <div class="col-md-9">
            <input type="checkbox" name="is_active">
            Yes
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    function getUsertype() {
        $.ajax({
            url: __base_url + "api/master/usertype/read",
            data: {
                is_active: 1
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $('form#userForm select[name="user_type_id"]').append($('<option>')
                        .text(value.name).attr('value', value.id));
                });
            }
        })

    }

    function getDatabyId() {
        var id = $('form#userForm input[name="id"]').val();
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
                        Main.autoSetValue('form#userForm', value)
                    });

                }
            })
        }
    }
    $.when(
        getUsertype(),
    ).done(function() {
        getDatabyId();
    })

})