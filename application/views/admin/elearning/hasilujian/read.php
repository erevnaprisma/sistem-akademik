<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Dikerjakan?</th>
            <th>Nilai</th>
            <th>Total</th>
            <th>Dinilai?</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
<button class="btn btn-info btn-exportprint hilang">Print</button>
<button class="btn btn-primary btn-exportexcel hilang">Save to Excel</button>
<script>
$(document).ready(function() {
    var form = '#ujianForm';

    function getDatabyId() {
        var id_soalujian = '<?= $id ?>';
        if (id_soalujian) {
            $.ajax({
                url: __base_url + "api/elearning/nilaiujian/siswaread",
                data: {
                    id_soalujian: id_soalujian,
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    $.each(data.data, function(i, value) {
                        $dikerjakan = 'Tidak';
                        $dinilai = '';

                        $action = "";
                        
                        if(value.sum_nilai){
                            $dikerjakan = 'Ya';
                            $action = `<a href=`+__base_url +`admin/elearning/hasilujian/update/`+value.id+`?id_siswa=`+value.id_siswa+` class="btn btn-warning hilang">Nilai</a>`;
                        }
                        if(value.sum_nilai){
                            $dinilai = 'Ya';
                        }
                        $('#mytable tbody').append(`
                            <tr>
                                <td>`+(i+1)+`</td>
                                <td>`+value.no_induk+`</td>
                                <td>`+value.nama_siswa+`</td>
                                <td>`+$dikerjakan+`</td>
                                <td>`+(value.sum_hasil ? value.sum_hasil : "")+`</td>
                                <td>`+(value.sum_nilai ? value.sum_nilai : "")+`</td>
                                <td>`+$dinilai+`</td>
                                <td>`+$action+`</td>
                            </tr>
                        `)
                    })

                }
            })
        }
    }

    getDatabyId();

    $(".btn-exportprint").click(function() {

        $('.hilang').hide();

        document.title = "Laporan Transaksi";
        window.print();

        $('.hilang').show();
    })
    $(".btn-exportexcel").click(function() {
        Main.exportToExcel({
            table: "mytable",
            title: "Link School",
            header: "Laporan Ujian",
            name: "Laporan Ujian",
            periode: ""
        });
    })
});
</script>