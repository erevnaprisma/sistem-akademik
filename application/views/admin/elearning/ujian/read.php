<style>
.help-block {
    color: red;
}

</style>
<div class="box box-default">
    <div class="row" style="padding:10px;">
        <div class="col-xs-12">
            <table class="table information">
                <tr>
                    <td style="width:25%;">Jumlah pilihan ganda</td>
                    <td style="width:25%;"></td>
                    <td style="width:25%;">Nilai</td>
                    <td style="width:25%;"></td>
                </tr>
                <tr>
                    <td>Jumlah essay</td>
                    <td></td>
                    <td>Hasil</td>
                    <td></td>
                </tr>
                <tr>
                    <td>No Induk</td>
                    <td></td>
                    <td>Sekolah</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td></td>
                    <td>Tahun Ajaran</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td></td>
                    <td>Tanggal</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Mapel</td>
                    <td></td>
                    <td>Durasi</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <form id="soalPilihanForm" method="post" action="<?=base_url('api/elearning/soalujian/'.$action); ?>"
        class="form-horizontal" style="padding: 10px;">
        <input type="hidden" name="id_soalujian" value="<?= $id?>">
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Soal Pilihan Ganda
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="box-body">
                    <table class="table tableLoadGanda">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width:200px;">Image</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Soal Essay
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="box-body">
                    <table class="table tableLoadEssay">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width:200px;">Image</th>
                                <th>Nilai</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
$(function() {


    var pil = ["a", "b", "c", "d", "e"];
    var form = '#soalPilihanForm';


    function getNamaSiswa() {
        var id_soalujian = $(form + ' input[name="id_soalujian"]').val();
        if (id_soalujian) {
            $.ajax({
                    url: __base_url + "api/elearning/hasilujian/informationread",
                    data: {
                        id_soalujian: id_soalujian,
                        id_siswa: Main.getCurrentUser().id,
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    beforeSend: function(data) {},
                    success: function(data) {
                        $('.information tr:nth(2) td:nth(1)').text(data.siswa[0].no_induk);
                        $('.information tr:nth(2) td:nth(3)').text(data.soalujian[0].sekolah);
                        $('.information tr:nth(3) td:nth(1)').text(data.siswa[0].nama_siswa);
                        $('.information tr:nth(3) td:nth(3)').text(data.soalujian[0].tahun);

                        $('.information tr:nth(4) td:nth(1)').text(data.soalujian[0].nama_kelas);
                        $('.information tr:nth(4) td:nth(3)').text(data.soalujian[0].nama_kelas);
                        $('.information tr:nth(5) td:nth(1)').text(data.soalujian[0].mapel);
                        $('.information tr:nth(5) td:nth(3)').text(data.soalujian[0].durasi+" Menit");
                    }
                })
        }
    }
    getNamaSiswa();


    function getDatabyId() {
        var id_soalujian = $(form + ' input[name="id_soalujian"]').val();
        if (id_soalujian) {
            $.ajax({
                url: __base_url + "api/elearning/soalujian/pilihanread",
                data: {
                    id_soalujian: id_soalujian,
                    order_by: " order by mst.urut ",
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {

                    var noGanda = 0;
                    var noEssay = 0;

                    $.each(data.data, function(i, value) {
                        if (value.flag == "ganda") {
                            ++noGanda;

                            var jawaban = [];
                            if (value.jawaban) {
                                JSON.parse(value.pilihan).forEach(function(value, i) {
                                    jawaban.push(
                                        '<input type="checkbox" name="ganda" value="' +
                                        pil[i] + '"> ' + pil[i] + ". " + value);
                                });
                            }

                            $('.tableLoadGanda tbody').append(`
                                <tr class="soal-` + value.id + `" data-id="` + value.id + `">
                                    <td>` + noGanda + `</td>
                                    <td>` + (value.file ? '<img src="' + __base_url +
                                'assets/public/attach/soalujian/' + value.file +
                                '" style="width:200px;">' : "") + `</td>
                                    <td>` + value.nilai + `</td>
                                    <td>` + value.pertanyaan + `</td>
                                    <td>` + jawaban.join('<br/>') + `</td>
                                </tr>
                            `)
                        } else {
                            ++noEssay;
                            $('.tableLoadEssay tbody').append(`
                                <tr class="soal-` + value.id + `" data-id="` + value.id + `">
                                    <td>` + noEssay + `</td>
                                    <td>` + (value.file ? '<img src="' + __base_url +
                                'assets/public/attach/soalujian/' + value.file +
                                '" style="width:200px;">' : "") + `</td>
                                    <td>` + value.nilai + `</td>
                                    <td>` + value.pertanyaan + `</td>
                                    <td><textarea name="essay" class="form-control" rows="7"></textarea></td>
                                </tr>
                            `)
                        }
                    });

                    $('.information tr:nth(0) td:nth(1)').text(noGanda)
                    $('.information tr:nth(1) td:nth(1)').text(noEssay)

                }
            })
        }
    }


function jumlahTerjawab() {
    $('.information tr:nth(0) td:nth(3)').text($('.tableLoadGanda tbody tr.bg-success').length)
    $('.information tr:nth(1) td:nth(3)').text($('.tableLoadEssay tbody tr.bg-success').length)
}


    $.when(getDatabyId())
        .done(function() {
            setTimeout(() => {
                var id_soalujian = $(form + ' input[name="id_soalujian"]').val();
                if (id_soalujian) {
                    $.ajax({
                        url: __base_url + "api/elearning/ujian/jawabread",
                        data: {
                            id_soalujian: id_soalujian,
                            is_active: 1
                        },
                        method: "POST",
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        beforeSend: function(data) {},
                        success: function(data) {
                            $.each(data.data, function(i, value) {
                                var soal = $('.soal-' + value.id_soalujiandetail);
                                if (value.flag == "ganda") {
                                    soal.find('input[name="ganda"][value="' +value.ganda + '"]').prop("checked",true);
                                } else {
                                    soal.find('textarea[name="essay"]').val(value.essay)
                                }
                                soal.addClass('bg-success');
                            })
                            jumlahTerjawab();
                        }
                    })
                }
            }, 500);
        })

    $(document).on('click', '.tableLoadGanda input[name="ganda"]', function() {
        var thiss = $(this)
        thiss.parents('tr').find('input[name="ganda"]').prop('checked', false)
        thiss.prop('checked', true)
        var value = Main.objectifyForm($(form).serializeArray());
        value.flag = "ganda";
        value.id_soalujiandetail = thiss.parents('tr').attr('data-id');

        $.ajax({
            url: __base_url + 'api/elearning/ujian/jawab',
            data: {
                data: JSON.stringify([value])
            },
            method: $(form).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                if (!thiss.parents('tr').hasClass('bg-success')) {
                    thiss.parents('tr').addClass('bg-success');
                }
                jumlahTerjawab();
            },
            error: function(e) {},
            complete: function(e) {}
        });
    })

    $(document).on('change', '.tableLoadEssay textarea[name="essay"]', function() {
        var thiss = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.flag = "essay";
        value.id_soalujiandetail = thiss.parents('tr').attr('data-id');

        $.ajax({
            url: __base_url + 'api/elearning/ujian/jawab',
            data: {
                data: JSON.stringify([value])
            },
            method: $(form).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                if (!thiss.parents('tr').hasClass('bg-success')) {
                    thiss.parents('tr').addClass('bg-success');
                }
                jumlahTerjawab();
            },
            error: function(e) {},
            complete: function(e) {}
        });
    })

})
</script>