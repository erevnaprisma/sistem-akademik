
<?php 
// echo '<pre>';
// var_dump($data); die;
?>

<form id="siswaBaruForm" data='<?= json_encode($data); ?>' method="post" action="<?=base_url('api/akademik/penilaian/siswa/'.$id); ?>"
    class="form-horizontal">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-group">
        <table id="dvExcel1" class="table table-bordered nowrap responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Induk</th>
                    <th>Nama Siswa</th>
                    <th>SMS</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-save-upload">Submit</button>
        </div>
    </div>

</form>

<script>
$(document).ready(function() {

    var form = '#siswaBaruForm';
    $.when(
        getSiswa(),
        // Data.getSiswa(form, ' select[name="id_siswa"]')
    ).done(function(usertype) {
        // setTimeout(() => {
        //     getDatabyId()
        // }, 300);
    });

    function getSiswa() {
        var id = $(form+' input[name="id"]').val();
        var nilai = JSON.parse($('#siswaBaruForm').attr('data'));
        $.each(nilai,function (i,value) {
            $.post(__base_url + 'api/data/kenaikankelasread',{
                id_jurusan: value.id_jurusan,
                id_kelas: value.id_kelas,
                id_semester: value.id_semester,
                id_skl:value.id_skl,
                id_tahun:value.id_tahun_ajaran,
            },function (data) {
                $.each(data.data,function (i,value) {

                    // $.post(__base_url + 'api/data/nilaisiswaread',{
                    //     id_penilaian: id,
                    //     id_user:value.id_siswa,
                    // },function (siswa) {
                    //     console.log(siswa)
                        $('#dvExcel1 tbody')
                            .append($('<tr>')
                                .append($('<td>').append(i + 1 +'<input type="hidden" name="id_nilai">')
                                    .attr('data',JSON.stringify(value)))
                                .append($('<td>').append(value.no_induk))
                                .append($('<td>').append(value.nama_siswa))
                                .append($('<td>').append('<input type="checkbox" name="sms" class="">'))
                                .append($('<td>').append('<input name="nilai" class="form-control">'))
                                .append($('<td>').append('<input name="keterangan" class="form-control">'))
                            )
                    // })


                    
                })

                $('#dvExcel1 tbody tr').each(function () {

                    var thiss = $(this);

                    var id = $(form+' input[name="id"]').val();
                    var value = JSON.parse(thiss.find('td:nth(0)').attr('data'));
                    $.post(__base_url + 'api/data/nilaisiswaread',{
                        id_penilaian: id,
                        id_user:value.id_siswa,
                    },function (data) {
                        $.each(data.data,function (i,value) {
                            thiss.find('input[name="id_nilai"]').val(value.id);
                            thiss.find('input[name="nilai"]').val(value.nilai);
                            thiss.find('input[name="keterangan"]').val(value.keterangan);
                        })
                    })
                })
            })
        })
    }

})
</script>