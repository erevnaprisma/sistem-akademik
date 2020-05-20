<form id="jadualForm" method="post" action="<?=base_url('api/data/jadualgururead'); ?>" class="form-horizontal">
    <!-- <input type="hidden" name="id" value=""> -->
    <input type="hidden" name="id_skl" value="<?= $sekolah->id_skl ?>">
    <!-- input states -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3">Tahun</label>
                <div class="col-md-9">
                    <select name="id_tahun" class="form-control">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Jurusan</label>
                <div class="col-md-9">
                    <select name="id_jurusan" class="form-control">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3">Semester</label>
                <div class="col-md-9">
                    <select name="id_semester" class="form-control">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Kelas</label>
                <div class="col-md-9">
                    <select name="id_kelas" class="form-control">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <button class="btn btn-primary btn-save">Submit</button>
                    <!-- <button class="btn btn-info btn-print">Print</button> -->
                </div>
            </div>
        </div>
    </div>


</form>

<div id="schedule"></div>

<script>
$(document).ready(function() {
    var form = '#jadualForm';
    $.when(
        // Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getTahun(form, ' select[name="id_tahun"]'),
        Data.getKelas(form, ' select[name="id_kelas"]'),
        Data.getSemester(form, ' select[name="id_semester"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        // Data.getSiswa(form, ' select[name="id_siswa"]')
    ).done(function(usertype) {
        // setTimeout(() => {
        //     getDatabyId()
        // }, 300);
    });


    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        console.log('Bismillah')
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
        $.ajax({
            url: $(form).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(form).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                var result = [];
                $.each(data.data, function(i, value) {
                    result.push({
                        day: 1,
                        periods: [{
                            "start": value.pkl_mulai,
                            "end": value.pkl_selesai,
                            "title": value.mapel_name,
                            // "backgroundColor": "rgba(0, 0, 0, 0.5)",
                            // "borderColor": "#000",
                            // "textColor": "#fff"
                        }]
                    })
                });

                buildJQS(result);

            },
            error: function(e) {
                Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    function buildJQS(data) {
        $('#schedule').jqs('reset');
        $('#schedule').jqs('import', data);
    }
    $('#schedule').jqs({
        mode: 'read',
        days: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        data: []
    });

})
</script>