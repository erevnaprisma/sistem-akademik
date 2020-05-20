<form id="transaksikeuanganForm" method="post" action="<?=base_url('api/keuangan/transaksikeuangan/'.$action); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->

    <div class="row">
        <div class="col-md-6">
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
                <label class="col-md-3">Jurnal</label>
                <div class="col-md-9">
                    <input name="jurnal" value="<?= date('ymdhis')?>" class="form-control readonly">
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
                <label class="col-md-3">Jenis transaksi</label>
                <div class="col-md-9">
                    <select name="id_jenistransaksi" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <!-- <div class="form-group">
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
            </div> -->
            <!-- <div class="form-group">
                <label class="col-md-3">Jurusan</label>
                <div class="col-md-9">
                    <select name="id_jurusan" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Kelas</label>
                <div class="col-md-9">
                    <select name="id_kelas" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div> -->
            <!-- <div class="form-group">
                <label class="col-md-3">Siswa</label>
                <div class="col-md-9">
                    <select name="id_siswa" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div> -->
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
                <label class="col-md-3"> Keterangan</label>
                <div class="col-md-9">
                    <textarea name="ket" class="form-control"></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <button class="btn btn-primary btn-cari" disabled>Cari</button>
                </div>
            </div>
        </div>
    </div>
</form>

<table id="mytablejenistransaksi" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>No</th>
        <th>Jenis Transaksi</th>
        <th>Pembayaran</th>
        <th>Nominal</th>
    </thead>
    <tbody></tbody>
</table>

<table id="mytableform" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <!-- <th>Jenis Transaksi</th> -->
            <th>Keterangan</th>
            <th>Nominal</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

<!-- <div class="form-group"> -->
    <!-- <label class="col-md-3"></label> -->
    <!-- <div class="col-md-9"> -->
        <button class="btn btn-primary btn-save">Submit</button>
    <!-- </div> -->
<!-- </div> -->


<script>
$(document).ready(function() {

    var form = '#transaksikeuanganForm';

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/keuangan/transaksikeuangan/read",
                data: {
                    id: id,
                    id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    $.each(data.data, function(i, value) {
                        Main.autoSetValue(form, value);
                        // ambil jurnalnya
                        Data.getDetailTransaksi();
                        $(form + ' input[name="id"]').val('');
                        $(form + ' textarea[name="ket"]').val('');
                        $(form + ' input[name="nominal"]').val('');

                        $(form + ' select[name="id_kelas"]').trigger('change')
                        setTimeout(() => {
                            $.when(
                            ).done(
                                $(form + ' select[name="id_siswa"]').val(value.id_siswa)
                            )
                        }, 300);
                        });

                }
            })


        }
    }

    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getKodeGL(form, ' select[name="id_kode_gl"]'),
        Data.getTahun(form, ' select[name="id_a_thn"]'),
        Data.getJenisTransaksi(form, ' select[name="jenis_transaksi"]'),
        Data.getJurusan(form, ' select[name="id_jurusan"]'),
        Data.getKelas(form, ' select[name="id_kelas"]'),
    ).done(function(usertype) {
        setTimeout(() => {

            $('select[name="id_a_thn"]').val(new Date().getFullYear());

            getDatabyId()
        }, 300);
    });
})