<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Pembayaran Jatuh Tempo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form id="settingForm" method="POST" action="">
                    
                    <div class="form-group">
                        <label for="">Title</label>
                        <input class="form-control" name="pn_title" placeholder="default: Penagihan Pembayaran">
                    </div>
                    <div class="form-group">
                        <label for="">Konten</label>
                        <textarea class="form-control" rows="5" name="pn_content" placeholder="default: Mohon segera melakukan pembayaran [item_transaksi] sebesar Rp. [nominal] karena akan jatuh tempo pada tanggal [tgl_jatuh_tempo]. Terimakasih."></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-warning btn-save">Submit</button>
                    </div>
                </form>
            </div>
            <dl style="padding:10px">
                <dt>Title</dt>
                <dd>Penagihan Pembayaran</dd>
                <dt>Konten</dt>
                <dd>Mohon segera melakukan pembayaran [item_transaksi] sebesar Rp. [nominal] karena akan jatuh tempo pada tanggal [tgl_jatuh_tempo]. Terimakasih.</dd>
            </dl>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var form = '#settingForm';

        function getDatabyId() {
            var id = Main.getCurrentUser().id_skl;
            console.log(id);
            
            if (id) {
                $.ajax({
                    url: __base_url + "api/master/sekolah/read",
                    data: {
                        id: id
                    },
                    method: "POST",
                    headers: {
                        'Authorization': localStorage.getItem("token")
                    },
                    beforeSend: function(data) {},
                    success: function(data) {
                        $.each(data.data, function(i, value) {
                            Main.autoSetValue(form, value)
                        });

                    }
                })
            } else {
                $(form + ' .btn-save').remove();
            }
        }
        getDatabyId();


        $(document).on('click', form + ' .btn-save', function(e) {
            e.preventDefault();
            var btn = $(this)
            var value = Main.objectifyForm($(form).serializeArray());
            value.id = Main.getCurrentUser().id_skl;
            $.ajax({
                url: __base_url + "api/pengaturan/notifikasi/update",
                data: {
                    data: JSON.stringify([value])
                },
                method: $(form).attr('method'),
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function(data) {
                    swal(
                        'Submited',
                        'Pengaturan Berhasil',
                        'success'
                    );
                },
                error: function(e) {
                    Main.autoSetError(form, e.responseJSON.error)
                },
                complete: function(e) {

                }
            });
        })
    })
</script>