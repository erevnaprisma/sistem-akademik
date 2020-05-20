<form id="infogambarForm" method="post" action="<?=base_url('api/anjungan/info/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="attach" value="<?=$attach?>">
    <div class="dropzone" 
        data-data="<?=
            htmlspecialchars(json_encode([
                'acceptedFiles' => ($flag == DOKUMEN_IMG ? "image/*" :"application/pdf"),
                'removefile' => true,
                'create' => base_url('api/transaksi/dokumen/create/'.$id),
                'delete' => base_url('api/transaksi/dokumen/delete/'.$id),
                'read' => base_url(PATH_PUBLIC_ATTACH . 'info/'),
                'input' => 'input[name="attach"]',
                'dropzone' => '.dropzone',
                'params' => '{"id_skl":'. $detail->id_skl .',"id_trx":'.$id.',"flag":'.$flag.',"hal":"info"}',
                    ]), ENT_QUOTES, 'UTF-8')
            ?>">
                <div class="dz-message needsclick">
                    Drop files here or click to upload.<br>
                    <span class="dz-note needsclick">
                        <!--(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)-->
                    </span>
                </div>
            </div>
            <label class="text-danger"><b>Note: File uploaded limited to pdf and image only, with maximum capacity is 2 MB.</b></label>
    </div>
</form>

<script>
$(document).ready(function() {

    Main.dropzoneInit($('.dropzone').attr('data-data'));
    var form = '#infogambarForm';
    
})