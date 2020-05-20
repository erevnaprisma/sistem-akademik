<form id="trxKeuanganForm" method="post" action="<?=base_url('api/keuangan/trx_keuangan/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
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
        <label class="col-md-3"> Nomor</label>
        <div class="col-md-9">
            <input type="number" name="nomor" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Jenis Transaksi</label>
        <div class="col-md-9">
            <select name="id_jns_transaksi" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Pembayaran</label>
        <div class="col-md-9">
            <select name="id_pembayaran" class="form-control">
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
    <div class="form-group">
        <label class="col-md-3">Tahun Ajaran</label>
        <div class="col-md-9">
            <select name="id_tahun_ajaran" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Keterangan Transaksi</label>
        <div class="col-md-9">
            <textarea name="ket_trx" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Keterangan</label>
        <div class="col-md-9">
            <textarea name="ket" class="form-control"></textarea>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Nominal</label>
        <div class="col-md-9">
            <input type="number" name="nominal" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Siswa</label>
        <div class="col-md-9">
            <select name="id_siswa" class="form-control">
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
    var form = '#trxKeuanganForm';

    function getJenisTransaksi() {
        $.ajax({
            url: __base_url + "api/keuangan/jenis_transaksi/read",
            data: {
                is_active: 1,
                where: "ask.id in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")"
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $(form + ' select[name="id_jns_transaksi"]').append($('<option>').text(value
                        .nm_skl).attr('value', value.id));
                });
            }
        })
    }

    function getPembayaran() {
        $.ajax({
            url: __base_url + "api/keuangan/pembayaran/read",
            data: {
                is_active: 1,
                where: "ask.id in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")"
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $(form + ' select[name="id_pembayaran"]').append($('<option>').text(value
                        .nm_skl).attr('value', value.id));
                });
            }
        })
    }

    function getJurusan() {
        $.ajax({
            url: __base_url + "api/akademik/jurusan/read",
            data: {
                is_active: 1,
                where: "ask.id in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")"
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $(form + ' select[name="id_jurusan"]').append($('<option>').text(value
                        .nm_skl).attr('value', value.id));
                });
            }
        })
    }

    function getTahunAjaran() {
        $.ajax({
            url: __base_url + "api/akademik/tahun_ajaran/read",
            data: {
                is_active: 1,
                where: "ask.id in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")"
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data, function(i, value) {
                    $(form + ' select[name="id_tahun_ajaran"]').append($('<option>').text(value
                        .nm_skl).attr('value', value.id));
                });
            }
        })
    }

    function getSekolah() {
        $.ajax({
            url: __base_url + "api/master/sekolah/read",
            data: {
                is_active: 1,
                where: "ask.id in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")"
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
                url: __base_url + "api/keuangan/trx_keuangan/read",
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

    $.when(
        // getMapel(),
        getSekolah()
    ).done(function(usertype) {
        setTimeout(() => {
            getDatabyId()
        }, 300);
    })

})