<form id="infogambarForm" method="post" action="<?=base_url('api/anjungan/info/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <input type="hidden" name="attach" value="<?=$attach?>">
    <div class="dropzone">
        <div class="dz-message needsclick">
            Drop files here or click to upload.<br>
            <span class="dz-note needsclick">
                <!--(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)-->
            </span>
        </div>
    </div>
    <label class="text-danger"><b>Note: File uploaded limited to pdf and image only, with maximum capacity is 2
            MB.</b></label>
    </div>
</form>

<script>
$(document).ready(function() {

            Dropzone.autoDiscover = false;
            var foto_upload = new Dropzone(".dropzone", {
                    url: '<?= base_url('api/transaksi/dokumen/create/'.$id) ?>',
                    params: JSON.parse('<?= '{"id_skl":'. $detail->id_skl .',"id_trx":'.$id.',"flag":'.DOKUMEN_VID.',"hal":"info"}' ?>'),
                        method: 'POST',
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        maxFilesize: 30,
                        acceptedFiles: "video/*",
                        paramName: "attach",
                        dictInvalidFileType: "Type file ini tidak dizinkan",
                        addRemoveLinks: true,
                        //            thumbnailWidth: 300,
                        //            thumbnailHeight: 300,
                        init: function() {

                            thisDropzone = this;

                            var attach = $('input[name="attach"]').val();
                            var arr_new = [];
                            attach = attach.split(',').filter(Boolean);
                            attach.forEach(function(a, b) {
                                var src = '<?= base_url(PATH_PUBLIC_ATTACH . 'info/') ?>' + a;
                                console.log(src)
                                if (Main.imageExists(src)) {
                                    arr_new.push(a)
                                    var mockFile = {
                                        name: a,
                                        size: 12345
                                    };
                                    thisDropzone.emit("addedfile", mockFile);

                                    thisDropzone.createThumbnailFromUrl(mockFile, src);

                                    // Make sure that there is no progress bar, etc...
                                    thisDropzone.emit("complete", mockFile);
                                    //                    console.log(thisDropzone.removeFile)
                                    setTimeout(() => {
                    $('.dropzone .dz-details').attr('path','<?= base_url(PATH_PUBLIC_ATTACH . 'info/') ?>')
                }, 300);
                                }
                            })
                            $('input[name="attach"]').val(arr_new)

                            setTimeout(function() {
                                $('.dz-preview').each(function(a, b) {
                                    var alt = $(this).find('.dz-filename span').text();
                                    console.log(alt)
                                    $(this).find('.dz-remove').attr('id', alt)
                                    if (!true) {
                                        $(this).find('.dz-remove').hide();
                                        //                                    .addClass('btn-dz-preview')
                                        //                                    .attr({
                                        //                                        title:'PREVIEW',
                                        //                                        href:'',
                                        //                                        src:zone.read + alt,
                                        //                                    })
                                        //                                    .text('preview')
                                        //                                    .removeClass('dz-remove');
                                    }

                                })
                            }, 1000);



                            // attach callback to the `success` event
                            this.on("success", function(file, result) {
                                // result = JSON.parse(result);
                                // if (result.status == 1) {
                                //     var attach = $(zone.input).val();
                                //     var nn = attach.split(',');
                                //     console.log(result.data.action)
                                //     if (result.data.action == 'create') {
                                //         nn.push(result.data.name);
                                //         file._removeLink.id = result.data.name;
                                //     }
                                //     $(zone.input).val(nn.filter(Boolean).join());
                                // }

                            });

                            this.on("complete", function(file, result) {
                                //                    console.log($(this).find('a.dz-remove').html())
                                //                    console.log(result)
                                //                    console.log(this.getUploadingFiles())
                                //
                                //                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                                //                        doSomething();
                                //                    }
                            });

                            //Event ketika Memulai mengupload
                            this.on("sending", function(a, b, c) {
                                a.token = Math.random();
                                c.append("token_foto", a
                                .token); //Menmpersiapkan token untuk masing masing foto
                            });

                            //Event ketika Memulai mengupload
                            this.on("uploadprogress", function(a, b, c) {

                                console.log(a.upload.progress)
                                console.log(b)
                                console.log(c)
                            });

                            //Event ketika foto dihapus
                            this.on("removedfile", function(a) {

                                var token = a.token;
                                $.ajax({
                                    type: "post",
                                    data: {
                                        token: token,
                                        id: a._removeLink.id
                                    },
                                    url: '<?= base_url('api/transaksi/dokumen/deletefile/') ?>' + a._removeLink.id,
                                    cache: false,
                                    //                        dataType: 'json',
                                    success: function(result) {
                                            var attach = $('input[name="attach"]').val();
                                            var nn = attach.split(',').filter(Boolean);
                                            var index = nn.indexOf(result.data.name);
                                            if (index > -1) {
                                                nn.splice(index, 1);
                                            }
                                            $('input[name="attach"]').val(nn.filter(Boolean)
                                                .join());
                                    },
                                    error: function() {
                                        console.log("Error");

                                    }
                                });
                            });

                        }
                    });

            })