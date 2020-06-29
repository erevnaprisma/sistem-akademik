<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Kartu</th>
            <th>No Induk</th>
            <!-- <th>Username</th> -->
            <th>Email</th>
            <th>Nama Siswa</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>NISN</th>
            <th>Jenis Kelamin</th>
            <th>Angkatan</th>
            <th>HP Siswa</th>
            <!-- <th>HP Ortu 1</th>
            <th>HP Ortu 2</th> -->
            <!-- <th>Email Ortu 1</th>
            <th>Email Ortu 2</th> -->
            <th>Is Active</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Updated By</th>
            <th>Updated Date</th>
            <th>Action</th>
        </tr>
    </thead>
</table>


<script>
$(document).ready(function() {
    var form = '#siswaForm';
    var datapribadiForm = '#datapribadiForm';
    var dataorangtuaForm = '#dataorangtuaForm';

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    $('#mytable').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
        dom: "lBfrtip",
        buttons: [
            {
                text: "Create",
                className: "btn btn-create btn-success fa fa-plus",
                init: function(a, b, c) {
                    b.attr('href', __base_url + 'admin/akademik/siswa/create');
                    b.attr('title', 'CREATE');
                },
            },
            {
                text: "Import",
                className: "btn btn-create btn-warning fa fa-plus",
                init: function(a, b, c) {
                    b.attr('href', __base_url + 'admin/akademik/siswa/import');
                    b.attr('title', 'IMPORT');
                },
            },
            {
                text: "Template",
                className: "btn btn-info fa fa-plus",
                init: function(a, b, c) {
                    // b.attr('href', __base_url + 'assets/public/doc/import_siswa.xls');
                    b.attr('title', 'TEMPLATE');
                },
                action: function ( e, dt, button, config ) {
                    window.open(__base_url + 'assets/public/doc/import_siswa.xls','_blank');
                } 
            },
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/akademik/siswa/json",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {


                var params = {
                    date: '',
                    id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                };

                if(Main.getCurrentUser().user_type_id =='<?= USER_TYPE_SISWA ?>'){
                    params.id_user = Main.getCurrentUser().id;
                }
                $.extend(d, params);
                d.supersearch = $('.my-filter').val();
                // Retrieve dynamic parameters
                var dt_params = $('#mytable').data('dt_params');
                // Add dynamic parameters to the data object sent to the server
                if (dt_params) {
                    $.extend(d, dt_params);
                }
            }
        },
        "columns": [{
                //"class": "details-control",
                "orderable": false,
                "searchable": false,
                "data": 'id',
                "defaultContent": ""
            },
            {
                "data": "id_card"
            },
            {
                "data": "no_induk"
            },
            // {
            //     "data": "username"
            // },
            {
                "data": "emailname"
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "jurusan"
            },
            {
                "data": "nama_kelas"
            },
            {
                "data": "nisn"
            },
            {
                "data": "jenis_kelamin"
            },
            {
                "data": "angkatan"
            },
            {
                "data": "hp_siswa"
            },
            // {
            //     "data": "hp_ortu_1"
            // },
            // {
            //     "data": "hp_ortu_2"
            // },
            
            // {
            //     "data": "email_ortu_1"
            // },
            // {
            //     "data": "email_ortu_2"
            // },
            {
                "data": "is_active_name"
            },
            {
                "data": "created_by_name"
            },
            {
                "data": "created_dt"
            },
            {
                "data": "updated_by_name"
            },
            {
                "data": "updated_dt"
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    result += "<button href=\"" + __base_url + "admin/akademik/siswa/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                    result += "<button href=\"" + __base_url + "admin/akademik/siswa/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    result += "<button href=\"" + __base_url + "admin/akademik/siswa/pribadi/" +
                        iDisplayIndex.id +
                        "\" class=\"btn bg-teal btn-update btn-xs\" title=\"Data Pribadi\"><i class=\"fa fa-pencil\"></i> Pribadi</button>";
                    result += "<button href=\"" + __base_url + "admin/akademik/siswa/orangtua/" +
                        iDisplayIndex.id +
                        "\" class=\"btn bg-purple btn-update btn-xs\" title=\"Data Orang Tua\"><i class=\"fa fa-pencil\"></i> Orang Tua</button>";
                    result += "<button href=\"" + __base_url + "admin/akademik/siswa/delete/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                    return result;
                }//tambah komen, cuma mo cek
            },
        ],
        "order": [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);


        },
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });

        },
    });

    $(document).on('click', form + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();
        value.foto = $('.fotosiswa').attr('src');
        // console.log(value.foto.indexOf(__base_url))
        if (value.foto.indexOf(__base_url) != -1) {
            delete value.foto;
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
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })


    $(document).on('click', form + ' .btn-save-upload', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(form).serializeArray());
        value.is_active = $(form + ' input[name="is_active"]').val();

        $("#dvExcel tbody tr").each(function (index) {
            var thiss = $(this);

            value.nama_siswa = $(this).find('td:nth(3)').text();
            value.email = $(this).find('td:nth(4)').text()+'@'+Main.getCurrentUser().slug+'.id';
            value.name = $(this).find('td:nth(3)').text();
            value.no_induk = $(this).find('td:nth(4)').text();
            value.nisn = $(this).find('td:nth(5)').text();
            value.jk = $(this).find('td:nth(6)').text();
            value.angkatan = $(this).find('td:nth(7)').text();
            value.hp_siswa = $(this).find('td:nth(8)').text();
            value.hp_ortu_1 = $(this).find('td:nth(9)').text();
            value.hp_ortu_2 = $(this).find('td:nth(10)').text();
            value.email_ortu_1 = $(this).find('td:nth(11)').text();
            value.email_ortu_2 = $(this).find('td:nth(12)').text();
            thiss.attr('class', '');
            thiss.find('td:nth(1)').text('');
            console.log(value)
            $.ajax({
                url: __base_url + "api/akademik/siswa/import",
                data: {
                    data: JSON.stringify([value])
                },
                method: $(form).attr('method'),
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function(data) {
                    thiss.addClass('bg bg-green');
                    thiss.find('td:nth(1)').append('import success');
                },
                error: function(e) {
                    thiss.addClass('bg bg-red');
                    var object = e.responseJSON.error;
                    for (var property in object) {
                        if (object.hasOwnProperty(property)) {
                            thiss.find('td:nth(1)').append(object[property]+'<br>');
                        }
                    }
                },
                complete: function(e) {

                }
            });
            

        });
    })

    function checkButton() {
        setTimeout(() => {
            var id_skl = $('#siswaForm select[name="id_skl"]').val();
            if(id_skl && $('#dvExcel tbody tr').length > 0){
                $('.btn-save-upload').parents('.form-group').show()
            } else {
                $('.btn-save-upload').parents('.form-group').hide()
            }
        }, 1000);
    }

    $(document).on('click','.btn-upload', function (e) {
        e.preventDefault();
        checkButton()
    })

    $(document).on('change','#siswaForm select[name="id_skl"]', function (e) {
        e.preventDefault();
        checkButton()
    })

    $(document).on('click','#upload',function (e) {
        e.preventDefault();
        //Reference the FileUpload element.
        var fileUpload = document.getElementById("fileUpload");

        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof(FileReader) != "undefined") {
                var reader = new FileReader();

                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function(e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function(e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }
    });

    function ProcessExcel(data) {

        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });

        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];
        // var firstSheet = workbook.SheetNames[1];

        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

        var addemail = []
        $.each(excelRows,function (i, value) {
            value.EMAIL = value['NO INDUK']+'@'+Main.getCurrentUser().slug+'.id'
            addemail.push(value);
        })

        $('#dvExcel').html("");
        $('#dvExcel').html(Main.tableCreateMulti(excelRows));
    };



    function showhide() {
        if ($('select[name="id_sta_t_dgn"]').val()) {
            $('input[name="sta_t_dgn_lain"]').parents('.form-group').hide()
        } else {
            $('input[name="sta_t_dgn_lain"]').parents('.form-group').show()
        }
        if ($('select[name="id_tem_t_dgn"]').val()) {
            $('input[name="tem_t_dgn_lain"]').parents('.form-group').hide()
        } else {
            $('input[name="tem_t_dgn_lain"]').parents('.form-group').show()
        }
        if ($('select[name="id_jrk_rmh"]').val()) {
            $('input[name="jrk_rmh_lain"]').parents('.form-group').hide()
        } else {
            $('input[name="jrk_rmh_lain"]').parents('.form-group').show()
        }
        if ($('select[name="id_trn_rmh"]').val()) {
            $('input[name="trn_rmh_lain"]').parents('.form-group').hide()
        } else {
            $('input[name="trn_rmh_lain"]').parents('.form-group').show()
        }
        if ($('select[name="id_pek_ayah"]').val()) {
            $('input[name="pek_ayah_lain"]').parents('.form-group').hide()
        } else {
            $('input[name="pek_ayah_lain"]').parents('.form-group').show()
        }
        if ($('select[name="id_pek_ibu"]').val()) {
            $('input[name="pek_ibu_lain"]').parents('.form-group').hide()
        } else {
            $('input[name="pek_ibu_lain"]').parents('.form-group').show()
        }
    }



    // siswa
    $(document).on('keyup', 'input[name="nama_siswa"]', function(e) {
        e.preventDefault()
        $('.widget-user-2 .bg-red .widget-user-username').text($(this).val())
    })

    $(document).on('change', 'select[name="id_sta_t_dgn"]', function(e) {
        showhide()
    })
    $(document).on('change', 'select[name="id_tem_t_dgn"]', function(e) {
        showhide()
    })
    $(document).on('change', 'select[name="id_jrk_rmh"]', function(e) {
        showhide()
    })
    $(document).on('change', 'select[name="id_trn_rmh"]', function(e) {
        showhide()
    })

    $(document).on('change', '.inputfotosiswa', function(event) {
        Main.previewimage(this, $('.fotosiswa'));
    });
    $(document).on('change', '.inputfotoayah', function(event) {
        Main.previewimage(this, $('.fotoayah'));
    });
    $(document).on('change', '.inputfotoibu', function(event) {
        Main.previewimage(this, $('.fotoibu'));
    });



    $(document).on('click', datapribadiForm + ' .btn-save', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(datapribadiForm).serializeArray());
        value.is_active = $(datapribadiForm + ' input[name="is_active"]').val();
        if(value.tgl_lhr){
            value.tgl_lhr = moment(value.tgl_lhr, "DD/MM/YYYY").format("YYYY/MM/DD");
        }
        $.ajax({
            url:  __base_url + "api/akademik/siswa/datapribadi",
            data: {
                data: JSON.stringify([value])
            },
            method: $(datapribadiForm).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                Main.autoSetError(datapribadiForm, {});
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(datapribadiForm, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click', dataorangtuaForm + ' .btn-save', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(dataorangtuaForm).serializeArray());
        value.is_active = $(dataorangtuaForm + ' input[name="is_active"]').val();
        value.foto_ayah = $('.fotoayah').attr('src');
        if (value.foto_ayah.indexOf(__base_url) != -1) {
            delete value.foto_ayah;
        }
        value.foto_ibu = $('.fotoibu').attr('src');
        if (value.foto_ibu.indexOf(__base_url) != -1) {
            delete value.foto_ibu;
        }
        if(value.tgl_lhr_ayah){
            value.tgl_lhr_ayah = moment(value.tgl_lhr_ayah, "DD/MM/YYYY").format("YYYY/MM/DD");
        }
        if(value.tgl_lhr_ibu){
            value.tgl_lhr_ibu = moment(value.tgl_lhr_ibu, "DD/MM/YYYY").format("YYYY/MM/DD");
        }
        $.ajax({
            url:  __base_url + "api/akademik/siswa/dataorangtua",
            data: {
                data: JSON.stringify([value])
            },
            method: $(dataorangtuaForm).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                Main.autoSetError(dataorangtuaForm, {});
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(dataorangtuaForm, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('change',form + ' select[name="id_jurusan"]',function () {
        $(form + ' select[name="id_kls"] option').not(':first').remove();
        var params = {
            is_active: 1, 
            where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
        };
        if($(this).val()){
            params.id_jurusan = $(this).val();
        }
        Data.getKelas(form, ' select[name="id_kls"]' , params);
    })

    $(document).on('keyup',form + ' input[name="no_induk"]',function () {
        $(form + ' input[name="email"]').val($(this).val()+'@'+Main.getCurrentUser().slug+'.id');
    })
});
</script>