<style>
.headertable td {
    border-top: 0 !important;
}
table tr td {
    padding: 3px 5px !important;
}
</style>
<table class="table headertable" style="width:100%;">
    <tr>
        <td style="width:15%;">Sekolah</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="sekolah">-</td>
        <td style="width:15%;">No. Jurnal</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="jurnal">-</td>
        <!-- <td style="width:15%;">Dibuat oleh</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="created_by_name">-</td> -->
    </tr>
    <tr>
        <td style="width:15%;">Tanggal</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="created_dt_name">-</td>
        <td style="width:15%;">Kode GL</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="name_gl">-</td>
        <!-- <td style="width:15%;">Keterangan</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="ket">-</td> -->
    </tr>
    <tr>
        <td style="width:15%;">Tahun Buku</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="tahun">-</td>
        <!-- <td style="width:15%;">Jenis Transaksi</td>
        <td style="width:5%;">:</td>
        <td style="width:30%;" class="jenis_transaksi">-</td> -->
    </tr>
</table>
<h2 class="text-center jenis_transaksi" style="text-transform: uppercase;font-weight: bold;">-</h2>
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

<table class="table table-bordered" style="width:100%;">
    <tr>
        <td style="width:70%;">
            Keterangan:
            <br>
            <div class="ket"></div> 
        </td>
        <td style="width:30%;">
            Dibuat oleh:
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="created_by_name"></div>
        </td>
    </tr>
</table>


<script>
$(document).ready(function() {
    var id = '<?= $id ?>';
    console.log(id);

    function getid(id) {
        if (id) {
            $.ajax({
                url: __base_url + "api/keuangan/keuangan/readdetail",
                data: {
                    id: id
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
                    
                    document.title = "No. jurnal: " + value.jurnal;

                    $.each(data.data, function(i, value) {
                        $(".detail")
                            .append($('<tr>')
                                .append($('<td>').append(i + 1))
                                .append($('<td>').append(value.ket_detail))
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
        getid(id),
    ).done(function(jc, jcdetail, material, activitylog) {
        setTimeout(() => {
            // document.title = "No. jurnal: " + jurnal;
            window.print();
            window.close();
        }, 300);
    })
})
</script>