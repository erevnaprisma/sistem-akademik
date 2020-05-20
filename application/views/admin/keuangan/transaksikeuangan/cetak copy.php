<style>
.headertable td {
    border-top: 0 !important;
}
</style>
<table class="table headertable" style="width:100%;">
    <tr>
        <td style="width:12%;">Tanggal</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="created_dt_name">-</td>
        <td style="width:12%;">No. Jurnal</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="jurnal">-</td>
        <td style="width:12%;">Transaksi</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="jenis">-</td>
    </tr>
    <tr>
        <td style="width:12%;">Sub Transaksi</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="group_name">-</td>
        <td style="width:12%;">Nama Siswa</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="nama_siswa">-</td>
        <td style="width:12%;">Kelas</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="nama_kelas">-</td>
    </tr>
    <tr>
        <td style="width:12%;">Keterangan</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="group_ket">-</td>
        <td style="width:12%;">Nama Pegawai</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="created_by_name">-</td>
        <td style="width:12%;">Sekolah</td>
        <td style="width:3%;">:</td>
        <td style="width:18%;" class="nm_skl">-</td>
    </tr>
</table>
<br>
<table class="table table-striped table-bordered detail" style="width:100%;">
    <thead>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Transaksi</th>
            <th style="text-align:center;">Nominal</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>


<script>
$(document).ready(function() {
    var jurnal = '<?= $jurnal ?>';
    console.log(jurnal);

    function getjurnal(jurnal) {
        if (jurnal) {
            $.ajax({
                url: __base_url + "api/keuangan/keuangan/readdetail",
                data: {
                    jurnal: jurnal
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    var value = data.data[0];
                    for (var key in value) {
                        $('.' + key).text(value[key]);
                    }

                    $.each(data.data, function(i, value) {
                        $(".detail")
                            .append($('<tr>')
                                .append($('<td>').append(i + 1))
                                .append($('<td>').append(value.ket))
                                .append($('<td>').append("Rp. " + Main.numberWithCommas(
                                    value
                                    .nominal)))
                            )
                    })
                }
            })
        }
    }


    $.when(
        getjurnal(jurnal),
    ).done(function(jc, jcdetail, material, activitylog) {
        setTimeout(() => {
            document.title = "No. jurnal: " + jurnal;
            window.print();
            window.close();
        }, 300);
    })
})
</script>