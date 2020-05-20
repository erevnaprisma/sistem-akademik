<style>
.help-block{
    color:red;
}
</style>
<div class="box box-default">
    <form id="soalPilihanForm" method="post" action="<?=base_url('api/elearning/soalujian/'.$action); ?>"
        class="form-horizontal" style="padding: 10px;">
        <input type="hidden" name="id_soalujian" value="<?= $id?>">
        <input type="hidden" name="id" value="">
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
                    <div class="pilihanGanda">
                        <div class="soal">
                            <table class="table" style="margin-bottom:0">
                                <tr>
                                    <td style="width:120px;">Pertanyaan</td>
                                    <td><textarea name="pertanyaan" class="form-control"></textarea><span
                                            class="err-pertanyaan help-block"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="file" name="file"></td>
                                    <td><img src="" alt="" class="imgPreview" style="width:200px;"></td>
                                </tr>
                            </table>
                            <table class="table tablePilihan">
                                <thead>
                                    <tr>
                                        <th style="width:50px;">No</th>
                                        <th style="width:70px;">Benar</th>
                                        <th>Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A</td>
                                        <td><input type="checkbox" name="jawaban" value="a" id=""></td>
                                        <td><input name="pilihan" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td><input type="checkbox" name="jawaban" value="b" id=""></td>
                                        <td><input name="pilihan" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td><input type="checkbox" name="jawaban" value="c" id=""></td>
                                        <td><input name="pilihan" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>D</td>
                                        <td><input type="checkbox" name="jawaban" value="d" id=""></td>
                                        <td><input name="pilihan" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>E</td>
                                        <td><input type="checkbox" name="jawaban" value="e" id=""></td>
                                        <td><input name="pilihan" class="form-control"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">
                                            <span class="err-jawaban help-block"></span>
                                            <span class="err-pilihan help-block"></span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <table class="table">
                                <tr>
                                    <td style="width:120px;">Nilai</td>
                                    <td><input type="number" name="nilai" class="form-control" style=""><span class="err-nilai help-block"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary  btn-save">Simpan</button>
                </div>
            </div>
        </div>
        <div class="panel box box-danger">
            <table class="table tableLoadSoal">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width:200px;">Image</th>
                        <th>Pertanyaan</th>
                        <th>Pilihan</th>
                        <th>Jawaban</th>
                        <th>Nilai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary btn-urut">Urutkan</button>
        <!-- input states -->
    </form>
</div>

<script>
$(function() {

    

    var pil = ["a","b","c","d","e"];
    var form = '#soalPilihanForm';

    function getDatabyId() {
        var id_soalujian = $(form + ' input[name="id_soalujian"]').val();
        if (id_soalujian) {
            $.ajax({
                url: __base_url + "api/elearning/soalujian/pilihanread",
                data: {
                    id_soalujian: id_soalujian,
                    flag:'ganda',
                    order_by : " order by mst.urut ",
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    $.each(data.data, function(i, value) {

                        var jawaban = [];
                        if(value.jawaban){
                            JSON.parse(value.pilihan).forEach(function(value,i) {
                                jawaban.push(pil[i]+". " + value);
                            });
                        }
                        $('.tableLoadSoal tbody').append(`
                            <tr class="ui-state-default soal-`+value.id+`" data-id="`+value.id+`">
                                <td>`+(i+1)+`</td>
                                <td>`+(value.file ? '<img src="'+__base_url+'assets/public/attach/soalujian/'+value.file+'" style="width:200px;">' : "")+`</td>
                                <td>`+value.pertanyaan+`</td>
                                <td>`+jawaban.join('<br/>')+`</td>
                                <td>`+value.jawaban+`</td>
                                <td>`+value.nilai+`</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-upd">Update</button>
                                    <button type="button" class="btn btn-danger btn-del">Delete</button>
                                </td>
                            </tr>
                        `)
                    });

                    reindex()

                }
            })
        }
    }
    getDatabyId();


    function reindex() {
        $('.tableLoadSoal tbody tr').each(function (i) {
            $(this).find('td').eq(0).text(i+1);
        })
        $( ".tableLoadSoal tbody" ).sortable();
        $( ".tableLoadSoal tbody" ).disableSelection();
    }

    $('input[name="file"]').change(function() {
        Main.previewimage(this, $('.imgPreview'));
    })

    $('.pilihanGanda input[name="jawaban"]').click(function() {
        $('.pilihanGanda input[name="jawaban"]').prop('checked', false);
        $(this).prop('checked', true);
    })

    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        var pilihan = []
        $('.tablePilihan tbody tr').each(function() {
            pilihan.push($(this).find('input[name="pilihan"]').val())
        })
        value.pilihan = pilihan;

        value.file = $('.imgPreview').attr('src');

        var imgold = $('.imgPreview').attr('src');
        if (value.file.indexOf(__base_url) != -1) {
            delete value.file;
        }

        $.ajax({
            url: $(form).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(form).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('.help-block').text('');
                $('.imgPreview').attr('src',"");
                $(form).trigger('reset');

                $(form+' input[name="id"]').val("");

                var jawaban = [];
                if(value.jawaban){
                    pilihan.forEach(function(value,i) {
                        jawaban.push(pil[i]+". " + value);
                    });
                }

                
                
                if(!value.id){

                    $('.tableLoadSoal tbody').append(`
                        <tr class="ui-state-default soal-`+data.data+`" data-id="`+data.data+`">
                            <td>1</td>
                            <td>`+(value.file ? '<img src="'+value.file+'" style="width:200px;">' : "")+`</td>
                            <td>`+value.pertanyaan+`</td>
                            <td>`+jawaban.join('<br/>')+`</td>
                            <td>`+value.jawaban+`</td>
                            <td>`+value.nilai+`</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-upd">Update</button>
                                <button type="button" class="btn btn-danger btn-del">Delete</button>
                            </td>
                        </tr>
                    `);
                    reindex();
                } else {

                    value.file = imgold;

                    var tr = $('.tableLoadSoal tbody tr.soal-'+value.id);
                    tr.find('td:nth(1)').html(value.file ? '<img src="'+value.file+'" style="width:200px;">' : "");
                    tr.find('td:nth(2)').text(value.pertanyaan)
                    tr.find('td:nth(3)').html(jawaban.join('<br/>'))
                    tr.find('td:nth(4)').text(value.jawaban)
                    tr.find('td:nth(5)').text(value.nilai)
                }
                // $('#myModal button.close').trigger('click');
                // $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                var err = e.responseJSON.error;
                $('.help-block').text('')
                for (var ob in err) {
                    if (err[ob]) {
                        $('.err-'+ob).text(err[ob]);
                    }
                }
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click', ' .btn-upd', function(e) {
        var id = $(this).parents('tr').attr('data-id');
        $.ajax({
            url: __base_url + "api/elearning/soalujian/pilihanread",
            data: {
                id: id,
                flag:'ganda'
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                $(form + ' input[name="jawaban"]').prop("checked",false);
                $.each(data.data, function(i, value) {
                    $(form + ' input[name="id"]').val(value.id);
                    $(form + ' textarea[name="pertanyaan"]').val(value.pertanyaan);
                    $(form + ' input[name="jawaban"][value="'+value.jawaban+'"]').prop("checked",true);
                    $(form + ' input[name="nilai"]').val(value.nilai);
                    if(value.pilihan){
                        JSON.parse(value.pilihan).forEach(function(value,i) {
                            var tr = $('.tablePilihan tbody tr:nth('+i+')');
                            tr.find('input[name="pilihan"]').val(value);
                        });
                    }

                    if(value.file){
                        $(form).find('.imgPreview').attr('src',__base_url+'assets/public/attach/soalujian/'+value.file);
                    }

                    
                });
            }
        })
    })



    $(document).on('click', ' .btn-del', function(e) {
        var tr = $(this).parents('tr');
        var id = $(this).parents('tr').attr('data-id');

        swal({
                title: 'Are you sure?',
                //                            text: "You won't be able to revert this!",
                type: 'warning',
                // timer: 5000,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
                showLoaderOnConfirm: true,
                preConfirm: function (email) {
                    console.log(email)
                    return new Promise(function (resolve, reject) {
                        $.ajax({
                            url: __base_url + 'api/elearning/soalujian/pilihandelete/'+id,
                            method: 'POST',
                            headers: {
                                'Authorization': localStorage.getItem("token")
                            },
                            success: function(data) {
                                resolve(e);
                                tr.remove();
                                reindex()
                            },
                            error: function(e) {
                            },
                            complete: function(e) {
                            }
                        });
                    });
                },
            }).then(function (data) {}, function (dismiss) {
                console.log('cancel');
                
            });


    })



    $(document).on('click', ' .btn-urut', function(e) {


        $('.tableLoadSoal tbody tr').each(function (i) {
            var thiss = $(this);
            $.ajax({
                url: __base_url + 'api/elearning/soalujian/pilihanurut',
                data: {
                    data: JSON.stringify([{
                        id: thiss.attr('data-id'),
                        urut: i,
                    }])
                },
                method: $(form).attr('method'),
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function(data) {

                }
            })
        })
    })

})
</script>