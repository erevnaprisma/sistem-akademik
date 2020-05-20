<form id="hasilnilaiForm" method="post" action="<?=base_url('api/akademik/hasilnilai/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3"> Jurusan</label>
        <div class="col-md-9">
            <select name="id_jurusan" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Kelas</label>
        <div class="col-md-9">
            <select name="id_kelas" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Semester</label>
        <div class="col-md-9">
            <select name="id_semester" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> User</label>
        <div class="col-md-9">
            <select name="id_user" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Tanggal</label>
        <div class="col-md-9">
            <div class="input-group date onlydatepicker">
                <input name="tanggal" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <span class="help-block"></span>
        </diV>
    </div>
    <div class="form-group">
        <label class="col-md-3">Materi</label>
        <div class="col-md-9">
            <input name="materi" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Nilai</label>
        <div class="col-md-9">
            <input name="nilai" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Is Active</label>
        <div class="col-md-9">
            <input type="checkbox" name="is_active">
            Yes
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    Main.onlydatepicker();

    var form = '#hasilnilaiForm';

    function getUser() {
        $.ajax({
            url: __base_url + "api/user/read",
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

    function getJurusan() {
        $.ajax({
            url: __base_url + "api/akademik/jurusan/read",
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
                    $(form + ' select[name="id_jurusan"]').append($('<option>').text(value
                        .jurusan).attr('value', value.id));
                });
            }
        })
    }

    function getKelas() {
        $.ajax({
            url: __base_url + "api/akademik/kelas/read",
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
                    $(form + ' select[name="id_kelas"]').append($('<option>').text(value
                        .nama_kelas).attr('value', value.id));
                });
            }
        })
    }

    function getSemester() {
        $.ajax({
            url: __base_url + "api/akademik/semester/read",
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
                    $(form + ' select[name="id_semester"]').append($('<option>').text(value
                        .semester).attr('value', value.id));
                });
            }
        })
    }

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/hasilnilai/read",
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

                        // console.log(value)
                        Main.autoSetValue(form, value)
                        $(form + ' input[name="tanggal"]').val(moment(value.tanggal, "YYYY/MM/DD").format("DD/MM/YYYY"));
                    });

                }
            })
        }
    }

    $.when(
        getUser(),
        getJurusan(),
        getKelas(),
        getSemester()
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})