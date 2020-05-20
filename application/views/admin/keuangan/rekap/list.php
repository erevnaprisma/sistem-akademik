<style>

.table-bordered td{
    border: 1px solid #ddd !important;
}
.table-bordered td{
    padding: 3px 8px !important;
}

#mytableform tr td:nth-of-type(1){
    width:5%;
}
#mytableform tr td:nth-of-type(2){
    width:20%;
}
#mytableform tr td:nth-of-type(3){
    width:35%;
}
#mytableform tr td:nth-of-type(4){
    width:20%;
    text-align: right;
}
#mytableform tr td:nth-of-type(5){
    width:20%;
    text-align: right;
}

</style>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Arus Kas</h3>
    </div>
    <form id="laporanForm" method="post" action="" class="form-horizontal" style="padding:10px">
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
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                        <button class="btn btn-primary btn-report">Cari</button>
                        <button class="btn btn-info btn-exportprint">Print</button>
                        <button class="btn btn-primary btn-exportexcel">Save to Excel</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                
            </div>
        </div>
    </form>
</div>
<br>
<div class="box box-warning">
    <div class="box-header with-border text-center">
        <h3 class="box-title">Laporan Arus Kas Tahun <span class="tahun"></span> </h3>
    </div>
    <div class="table-responsive" id="table-responsive" style="padding:10px;">
        <table id="mytableform" class="table table-striped table-bordered" style="width:100%">
            <tr>
                <td colspan="3" class="text-center"><strong>Keterangan</strong></td>
                <td class="text-center"><strong>Kredit</strong></td>
                <td class="text-center"><strong>Debit</strong></td>
            </tr>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    var form = '#laporanForm';
    function getrekap() {
        $.ajax({
            url: __base_url + "api/keuangan/kodegl/read",
            data: {is_active: 1},
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $.each(data.data,function (i,value) {
                    $('#mytableform').append('<tr class="'+value.name+'"><td>'+value.kode+'</td><td>'+value.name+'</td><td></td><td></td><td></td></tr>');
                })

                $.ajax({
                    url: __base_url + "api/keuangan/jenistransaksi/read",
                    data: {
                        is_active: 1,
                        order_by : " order by mst.id_kode_gl, mst.kode desc  ",
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    beforeSend: function(data) {},
                    success: function(data) {
                        $.each(data.data,function (i,value) {
                            console.log(value)
                            $('#mytableform .' + value.kode_gl_name).after('<tr class="'+value.id+'"><td></td><td>'+value.kode+'</td><td>'+value.jenis+'</td><td></td><td></td></tr>');
                        })
                    }
                })
                
            }
        })
    }
    $.when(
        Data.getSekolah(form, ' select[name="id_skl"]'),
        Data.getTahun(form, ' select[name="id_tahun"]'),
        getrekap(),
    ).done(function(usertype) {
        setTimeout(() => {

            // $('select[name="id_a_thn"]').val(new Date().getFullYear());

            // getDatabyId()
        }, 300);
    });


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
            $('#mytableform tr td:nth-child(4)').text('');
            $('#mytableform tr td:nth-child(5)').text('');
            $('#mytableform tr.sb').remove();
            $('#mytableform tr.sa').remove();

            var value = Main.removeObjectEmpty(Main.objectifyForm($(form).serializeArray()));
            $.ajax({
                url: __base_url + "api/keuangan/keuangan/getrekapkas",
                data: value,
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    $.each(data.data, function(i, value) {
                        var nth = 0;
                        if(value.id_kodegl=='<?= GL_KELUAR ?>'){
                            nth = 4;
                        } else {
                            nth = 3;
                        }
                        $('#mytableform .' + value.id_jenistransaksi).find('td:nth('+nth+')').text(value.total)
                    });

                    var sbkr = 0;
                    var sbdb = 0;
                    var sa = 0;
                    $('#mytableform tr').each(function () {
                        sbkr += $(this).find('td:nth(3)').text() ? parseInt($(this).find('td:nth(3)').text()) : 0;
                        sbdb += $(this).find('td:nth(4)').text() ? parseInt($(this).find('td:nth(4)').text()) : 0;
                    })
                    $('#mytableform').append('<tr class="sb"><td colspan="3">SUB TOTAL</td><td class="text-right">'+sbkr+'</td><td class="text-right">'+sbdb+'</td></tr>');
                    $('#mytableform').append('<tr class="sa"><td colspan="3">SALDO AKHIR</td><td colspan="2" class="text-right"><strong>'+(sbkr-sbdb)+'</strong></td></tr>');
                }
            })
        }
    })

    $(".btn-exportprint").click(function(e) {
        e.preventDefault()
        document.title = "Laporan Transaksi";
        $('.box-default').hide();
        $('.main-footer').hide();
        window.print();
        setTimeout(() => {
            $('.box-default').show() 
            $('.main-footer').show() 
        }, 300);
    })
    $(".btn-exportexcel").click(function(e) {
        e.preventDefault()
        Main.exportToExcel({
            table: "mytableform",
            title: "Si Edu",
            header: "Laporan Arus Kas",
            name: "Laporan Arus Kas",
            periode: $('select[name="id_tahun"] :selected').text()
        });
    })

    $('.btn-exportpdf').click(function(e) {
        e.preventDefault()
        Main.exportToPdf({
            table: "mytableform",
            title: "Si Edu",
            header: "Laporan Transaksi",
            name: "Laporan Transaksi",
            // pageOrientation:"landscape",
            // pageOrientation:"landscape",
            periode: $('select[name="id_tahun"] :selected').text()
        });
    });

    $(form + ' select[name="id_tahun"]').change(function () {
        $('.tahun').text($('select[name="id_tahun"] :selected').text())
    })
})
</script>