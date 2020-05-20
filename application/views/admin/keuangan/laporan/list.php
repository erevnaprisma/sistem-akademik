<style>
@media print {
    body * {
        visibility: hidden;
    }

    #mytableform,
    #mytableform * {
        visibility: visible;
    }

    #mytableform {
        position: absolute;
        left: 0;
        top: 0;
    }
}

.table-responsive .table>tbody>tr>td,
.table-responsive .table>tbody>tr>th,
.table-responsive .table>tfoot>tr>td,
.table-responsive .table>tfoot>tr>th,
.table-responsive .table>thead>tr>td,
.table-responsive .table>thead>tr>th {
    padding: 3px 8px;
    /* line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd; */
}
</style>

<!-- <ul>
    <li><a href=""> Jurnal Umum</a></li>
    <li>Penerimaan
        <ul>
            <li><a href="<?=base_url('admin/keuangan/laporan/terimaperkelas'); ?>" class="btn btn-create"
                    title="Laporan Pembayaran Per Kelas">Laporan Pembayaran Per Kelas</a></li>
            <li><a href="">Laporan Pembayaran Siswa</a></li>
            <li><a href="">Laporan Pembayaran Siswa Menunggak</a></li>
            <li><a href="">Laporan Pembayaran Calon Siswa</a></li>
            <li><a href="">Laporan Pembayaran Calon Siswa Menuggak</a></li>
        </ul>
    </li>
    <li>Pengeluaran
        <ul>
            <li><a href="">Laporan Transaksi Pengeluaran</a></li>
            <li><a href="">Laporan Pembayaran Siswa</a></li>
            <li><a href="">Laporan Pembayaran Siswa Menunggak</a></li>
            <li><a href="">Laporan Pembayaran Calon Siswa</a></li>
            <li><a href="">Laporan Pembayaran Calon Siswa Menuggak</a></li>
        </ul>
    </li>
</ul>

<script>
$(document).ready(function() {
    $(document).on('click', '.btn-terimaperkelas', function(e) {

    })
})
</script> -->

<form id="laporanForm" method="post" action="" class="form-horizontal">
    <input type="hidden" name="id" value="">
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
                <label class="col-md-3">Tahun Buku</label>
                <div class="col-md-9">
                    <select name="id_tahun" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Group GL</label>
                <div class="col-md-9">
                    <select name="id_kodegl" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Jenis Transaksi</label>
                <div class="col-md-9">
                    <select name="id_jenistransaksi" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3">Item Transaksi</label>
                <div class="col-md-9">
                    <select name="id_itemtransaksi" class="form-control <?= !empty($id) ? 'readonly' : '' ?>">
                        <option value="">Select</option>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Tanggal Mulai</label>
                <div class="col-md-9">
                    <div class="input-group date onlydatepicker">
                        <input name="startdate" class="form-control">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Tanggal Selesai</label>
                <div class="col-md-9">
                    <div class="input-group date onlydatepicker">
                        <input name="enddate" class="form-control">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3"></label>
                <div class="col-md-9">
                    <button class="btn btn-primary btn-report">Cari</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-info btn-exportprint">Print</button>
        <button class="btn btn-primary btn-exportexcel">Save to Excel</button>
        <!-- <button class="btn btn-info btn-exportword">Save to Word</button> -->
        <!-- <button class="btn btn-warning btn-exportpdf">Save to PDF</button> -->
    </div>
</div>
<br>
<div class="table-responsive" id="table-responsive">
    <table id="mytableform" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun Buku</th>
                <th>Kode GL</th>
                <th>Jenis Transaksi</th>
                <th>Tanggal</th>
                <th>Jurnal</th>
                <th>Keterangan</th>
                <th>Siswa</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    var form = '#laporanForm';
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getKodeGL(form, ' select[name="id_kodegl"]'),
        Data.getTahun(form, ' select[name="id_tahun"]'),
        Data.getJenisTransaksi(form, ' select[name="id_jenistransaksi"]'),
        Data.getItemTransaksi(form, ' select[name="id_itemtransaksi"]'),
    ).done(function(usertype) {
        setTimeout(() => {

            // $('select[name="id_a_thn"]').val(new Date().getFullYear());

            // getDatabyId()
        }, 300);
    });

    $(document).on('click', '.btn-pilihsiswa', function(e) {
        var data = JSON.parse($(this).attr('data'));
        $(form + ' input[name="nama_siswa"]').val(data.nama_siswa);
        $(form + ' input[name="id_siswa"]').val(data.id);
        $('#myModalsiswa .close').trigger('click');
    })

    $(document).on('click', '.btn-pilihpegawai', function(e) {
        var data = JSON.parse($(this).attr('data'));
        console.log(data)
        $(form + ' input[name="nama_pegawai"]').val(data.nama);
        $(form + ' input[name="id_peg"]').val(data.id);
        $('#myModalpegawai .close').trigger('click');
    })

    $(document).on('click', '.btn-report', function(e) {
        e.preventDefault()

        $("#laporanForm").validate({
            rules: {
                id_skl: {
                    required: true,
                },
                id_tahun: {
                    required: true,
                },
            },
        }).form();
        if ($("#laporanForm").valid()) {
            $('#mytableform tbody').empty();

            var value = Main.removeObjectEmpty(Main.objectifyForm($(form).serializeArray()));
            if (value.startdate) {
                value.startdate = moment(value.startdate,'DD/MM/YYYY').format('YYYY-MM-DD');
            }
            if (value.enddate) {
                value.enddate = moment(value.enddate,'DD/MM/YYYY').format('YYYY-MM-DD');
            }
            $.ajax({
                url: __base_url + "api/keuangan/keuangan/readdetail",
                data: value,
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    $.each(data.data, function(i, value) {
                        $('#mytableform tbody')
                            .append($('<tr>')
                                .append($('<td>').append(i + 1))
                                .append($('<td>').append(value.tahun))
                                .append($('<td>').append(value.name_gl))
                                .append($('<td>').append(value.jenis_transaksi))
                                .append($('<td>').append(value.created_dt_name))
                                .append($('<td>').append(value.jurnal))
                                .append($('<td>').append(value.ket_detail))
                                .append($('<td>').append(value.nama_siswa))
                                .append($('<td>').append(value.nominal_detail))
                            )
                    })

                }
            })
        }
    })

    $(".btn-exportprint").click(function() {
        document.title = "Laporan Transaksi";
        window.print();
    })
    $(".btn-exportexcel").click(function() {
        Main.exportToExcel({
            table: "mytableform",
            title: "Si Edu",
            header: "Laporan Transaksi",
            name: "Laporan Transaksi",
            periode: ""
        });
    })

    $('.btn-exportpdf').click(function() {

        Main.exportToPdf({
            table: "mytableform",
            title: "Si Edu",
            header: "Laporan Transaksi",
            name: "Laporan Transaksi",
            // pageOrientation:"landscape",
            // pageOrientation:"landscape",
            periode: ""
        });
    });
})
</script>