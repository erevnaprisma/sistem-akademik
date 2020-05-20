<form id="userForm" method="post" action="<?=base_url('api/master/user/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <?php if ($action == 'create' || $action == 'update') {
    ?>
    <div class="form-group">
        <label class="col-md-3"> Name</label>
        <div class="col-md-9">
            <input type="text" name="name" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Email</label>
        <div class="col-md-9">
            <input type="text" name="email" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
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
        <label class="col-md-3">Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
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
    <?php
}?>
    <?php if ($action == 'create' || $action == 'resetpassword') {
        ?>
    <div class="form-group">
        <label class="col-md-3"> Password</label>
        <div class="col-md-9">
            <input type="password" name="password" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Repeat Password</label>
        <div class="col-md-9">
            <input type="password" name="password_repeat" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <?php
    }?>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#userForm';
    
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getUsertype(form, ' select[name="user_type_id"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId();
        }, 300);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/master/user/read",
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
                        Main.autoSetValue(form, value)
                    });

                }
            })
        }
    }

    function showskl() {
        var usertypeid = $(form + ' select[name="user_type_id"]').val();
        if(usertypeid=='<?= USER_TYPE_SUPERADMIN ?>'){
            $(form + ' select[name="id_skl"]').parents('.form-group').hide();
        } else {
            $(form + ' select[name="id_skl"]').parents('.form-group').show();
        }
    }

    $(document).on('change', form + ' select[name="user_type_id"]',function () {
        // showskl()
    })

})