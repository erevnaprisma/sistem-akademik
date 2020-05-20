<form id="absensiKaryawanForm" method="post" action="<?=base_url('api/absensi/absensi_karyawan/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <?php if ($action == 'create' || $action == 'update') {
    ?>
   <div class="form-group">
        <label class="col-md-3">Tanggal Masuk</label>
        <div class="col-md-9">
            <div class="input-group date datetimepicker">
                <input name="date_of_entry" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tanggal Keluar</label>
        <div class="col-md-9">
            <div class="input-group date datetimepicker">
                <input name="date_of_out" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Telat</label>
        <div class="col-md-9">
            <select name="come_late" class="form-control">
                <option value="1">Iya</option>
                <option value="0">Tidak</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Karyawan</label>
        <div class="col-md-9">
            <select name="id_user" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Sekolah</label>
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
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    var form = '#absensiKaryawanForm';

    Main.datetimepicker();

    function getUser() {
        $.ajax({
            url: __base_url + "api/master/user/read",
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
                    $(form + ' select[name="id_user"]').append($('<option>').text(value
                        .name).attr('value', value.id));
                });
            }
        })
    }

    function getSekolah() {
        $.ajax({
            url: __base_url + "api/master/sekolah/read",
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
                    $(form + ' select[name="id_skl"]').append($('<option>').text(value
                        .nm_skl).attr('value', value.id));
                });
            }
        })
    }
    
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
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
                        Main.autoSetValue(form, value);
                        $(form + ' input[name="date_of_entry"]').val(value.date_of_entry_name);
                        $(form + ' input[name="date_of_out"]').val(value.date_of_out_name);
                    });

                }
            })
        }
    }
 
    $.when(
        getUser(),
        getSekolah()
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})