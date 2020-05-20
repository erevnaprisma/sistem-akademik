<form id="laporanForm" method="post" action="" class="form-horizontal">
    <input type="hidden" name="id" value="">
    <!-- input states -->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3">Jurnal</label>
                <div class="col-md-9">
                    <input name="jurnal" value="" class="form-control readonly">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Sekolah</label>
                <div class="col-md-9">
                    <select name="id_skl" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Tahun Buku</label>
                <div class="col-md-9">
                    <select name="id_a_thn" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Group GL</label>
                <div class="col-md-9">
                    <select name="id_kode_gl" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <div class="form-group">
                <label class="col-md-3">Jenis Transaksi</label>
                <div class="col-md-9">
                    <select name="jenis_transaksi" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Pegawai</label>
                <div class="col-md-9">
                    <div class="input-group input-group-sm">
                        <input name="nama_pegawai" class="form-control readonly">
                        <input type="hidden" name="id_peg">
                        <span class="input-group-btn">
                            <button type="button"
                                class="btn btn-info btn-flat btn-caripegawai <?= !empty($id) ? 'readonly' : '' ?>">Cari!</button>
                        </span>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Siswa</label>
                <div class="col-md-9">
                    <div class="input-group input-group-sm">
                        <input name="nama_siswa" class="form-control readonly">
                        <input type="hidden" name="id_siswa">
                        <span class="input-group-btn">
                            <button type="button"
                                class="btn btn-info btn-flat btn-carisiswa <?= !empty($id) ? 'readonly' : '' ?>">Cari!</button>
                        </span>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3">Kelas</label>
                <div class="col-md-9">
                    <select name="id_kls" class="form-control">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <button class="btn btn-primary btn-save">Submit</button>
                </div>
            </div>
        </div>
    </div>

</form>
<div class="table-responsive" id="table-responsive">
    <table id="mytableform" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Transaksi</th>
                <th>No Jurnal</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
        </thead>
    </table>
</div>

<script>
$(document).ready(function() {
    var form = '#laporanForm';
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getKodeGL(form, ' select[name="id_kode_gl"]'),
        Data.getTahun(form, ' select[name="id_a_thn"]'),
        Data.getKelas(form, ' select[name="id_kls"]'),
        Data.getJenisTransaksi(form, ' select[name="jenis_transaksi"]'),
    ).done(function(usertype) {
        setTimeout(() => {

            $('select[name="id_a_thn"]').val(new Date().getFullYear());

            // getDatabyId()
        }, 300);
    });
})
</script>