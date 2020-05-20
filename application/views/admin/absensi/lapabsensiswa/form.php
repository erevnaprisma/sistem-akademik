<form id="absensiSiswaForm" method="post" action="<?=base_url('api/absensi/absensi_siswa/'.$action); ?>" class="form-horizontal">
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
        <label class="col-md-3">Siswa</label>
        <div class="col-md-9">
            <div class="input-group input-group-sm">
                <input name="nama_siswa" class="form-control readonly">
                <input type="hidden" name="id_siswa">
                <span class="input-group-btn">
                    <button type="button"
                        class="btn btn-info btn-flat btn-carisiswa <?= !empty($id) ? 'readonlyyy' : '' ?>">Cari!</button>
                </span>
            </div>
            <span class="help-block"></span>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-md-3"> Siswa</label>
        <div class="col-md-9">
            <select name="id_siswa" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div> -->
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
        <label class="col-md-3"> Mata Pelajaran</label>
        <div class="col-md-9">
            <select name="id_mapel" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Guru</label>
        <div class="col-md-9">
            <div class="input-group input-group-sm">
                <input name="nama_guru" class="form-control readonly">
                <input type="hidden" name="id_guru">
                <span class="input-group-btn">
                    <button type="button"
                        class="btn btn-info btn-flat btn-cariguru <?= !empty($id) ? 'readonlyyy' : '' ?>">Cari!</button>
                </span>
            </div>
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
        <label class="col-md-3"> Semester</label>
        <div class="col-md-9">
            <select name="id_semester" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Tahun Ajaran</label>
        <div class="col-md-9">
            <select name="id_tahun_ajaran" class="form-control">
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
        <label class="col-md-3"> Keterangan</label>
        <div class="col-md-9">
            <textarea class="form-control" name="ket"></textarea>
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

    var form = '#absensiSiswaForm';

    Main.datetimepicker();


    function getGuru() {
        $.ajax({
            url: __base_url + "api/absensi/absensi_siswa/get_guru",
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
                    $(form + ' select[name="id_guru"]').append($('<option>').text(value
                        .name).attr('value', value.id));
                });
            }
        })
    }

    
    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/absensi/absensi_siswa/read",
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
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getKelas(form, ' select[name="id_kelas"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        Data.getSemester(form, ' select[name="id_semester"]'),
        Data.getMapel(form, ' select[name="id_mapel"]'),
        Data.getTahunAjaran(form, ' select[name="id_tahun_ajaran"]'),
        // getSiswa(),
        // getGuru(),
        // getMapel(),
        // getTahunAjaran(),
        // getKelas(),
        // getSekolah(),
        // getSemester(),
        // getJurusan()
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})