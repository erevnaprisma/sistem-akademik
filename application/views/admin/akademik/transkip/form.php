<form id="transkipForm" method="post" action="<?=base_url('api/akademik/transkip/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <?php if ($action == 'create' || $action == 'update') {
    ?>
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
        <label class="col-md-3"> Jurusan</label>
        <div class="col-md-9">
            <select name="id_jurusan" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Siswa</label>
        <div class="col-md-9">
            <select name="id_siswa" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> SKS</label>
        <div class="col-md-9">
            <input type="number" name="sks" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Nilai</label>
        <div class="col-md-9">
            <input type="number" name="nilai" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Bobot</label>
        <div class="col-md-9">
            <input type="number" name="bobot" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Keterangan</label>
        <div class="col-md-9">
            <textarea name="keterangan" class="form-control"></textarea>
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

    var form = '#transkipForm';

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

    function getSiswa() {
        $.ajax({
            url: __base_url + "api/akademik/siswa/read",
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
                    $(form + ' select[name="id_siswa"]').append($('<option>').text(value
                        .nama_siswa).attr('value', value.id));
                });
            }
        })
    }
    
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/transkip/read",
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
                        $(form + ' input[name="tanggal"]').val(value.tanggal_name);
                    });

                }
            })
        }
    }
 
    $.when(
        getKelas(),
        getSemester(),
        getJurusan(),
        getSiswa()
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})