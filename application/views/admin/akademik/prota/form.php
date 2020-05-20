<form id="protaForm" method="post" action="<?=base_url('api/akademik/prota/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
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
        <label class="col-md-3"> Tahun Ajaran</label>
        <div class="col-md-9">
            <select name="id_tahun_ajaran" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Bidang</label>
        <div class="col-md-9">
            <input type="text" name="bidang" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <!-- input states -->
    <!-- <div class="form-group">
        <label class="col-md-3">Semester</label>
        <div class="col-md-9">
            <select name="id_semester" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option value="">Select</option>
                </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> NO SK</label>
        <div class="col-md-9">
            <input type="text" name="no_sk" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Kompetensi Inti</label>
        <div class="col-md-9">
            <textarea name="kompetensi_inti" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Kompetensi Dasar</label>
        <div class="col-md-9">
            <textarea name="kompetensi_dasar" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Materi Pokok</label>
        <div class="col-md-9">
            <textarea name="materi_pokok" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Alokasi Waktu</label>
        <div class="col-md-9">
            <input type="text" name="alokasi_waktu" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Keterangan</label>
        <div class="col-md-9">
            <textarea name="keterangan" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div> -->
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

    var form = '#protaForm';

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getTahunAjaran(form, ' select[name="id_tahun_ajaran"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/akademik/prota/read",
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
 
    

})