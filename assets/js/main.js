var Main = {
    init: function () {

        // this.getCurrentUser();
        this.indikatorConnection();
        this.statusConnection();
        this.loaderAjax();
        //this.removeObjectEmpty();
        //this.objectifyForm();
        this.modalDialog();
        this.modalSiswa();
        this.modalGuru();
        this.modalPegawai();
        this.modalUser();
        this.autoSetValue();
        this.checkboxIsActive();
        // this.getDataNavBar();
        // this.setNavBar();
        this.getNavBar();
        this.changepassword();
        // this.datepicker();
        this.datetimepicker();
        this.onlymonthyearpicker();
        this.onlyyearpicker();
        this.onlydatepicker();
        this.onlytimepicker();
        this.setCurrentUserAdmin();

        this.selectedSchool();
        this.setMultiSchool();
        this.downloadFileDZ()

        // this.timerlogout();
    },

    iconIcon: function () {
        if(Main.getCurrentUser().iconskl){
            $('.main-header .logo-lg img').attr('src', __base_url + 'assets/public/attach/sekolah/' +Main.getCurrentUser().iconskl);
        }
    },

    terbilang: function(a){
            var bilangan = ['','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas'];
        
            // 1 - 11
            if(a < 12){
                var kalimat = bilangan[a];
            }
            // 12 - 19
            else if(a < 20){
                var kalimat = bilangan[a-10]+' Belas';
            }
            // 20 - 99
            else if(a < 100){
                var utama = a/10;
                var depan = parseInt(String(utama).substr(0,1));
                var belakang = a%10;
                var kalimat = bilangan[depan]+' Puluh '+bilangan[belakang];
            }
            // 100 - 199
            else if(a < 200){
                var kalimat = 'Seratus '+ terbilang(a - 100);
            }
            // 200 - 999
            else if(a < 1000){
                var utama = a/100;
                var depan = parseInt(String(utama).substr(0,1));
                var belakang = a%100;
                var kalimat = bilangan[depan] + ' Ratus '+ terbilang(belakang);
            }
            // 1,000 - 1,999
            else if(a < 2000){
                var kalimat = 'Seribu '+ terbilang(a - 1000);
            }
            // 2,000 - 9,999
            else if(a < 10000){
                var utama = a/1000;
                var depan = parseInt(String(utama).substr(0,1));
                var belakang = a%1000;
                var kalimat = bilangan[depan] + ' Ribu '+ terbilang(belakang);
            }
            // 10,000 - 99,999
            else if(a < 100000){
                var utama = a/100;
                var depan = parseInt(String(utama).substr(0,2));
                var belakang = a%1000;
                var kalimat = terbilang(depan) + ' Ribu '+ terbilang(belakang);
            }
            // 100,000 - 999,999
            else if(a < 1000000){
                var utama = a/1000;
                var depan = parseInt(String(utama).substr(0,3));
                var belakang = a%1000;
                var kalimat = terbilang(depan) + ' Ribu '+ terbilang(belakang);
            }
            // 1,000,000 - 	99,999,999
            else if(a < 100000000){
                var utama = a/1000000;
                var depan = parseInt(String(utama).substr(0,4));
                var belakang = a%1000000;
                var kalimat = terbilang(depan) + ' Juta '+ terbilang(belakang);
            }
            else if(a < 1000000000){
                var utama = a/1000000;
                var depan = parseInt(String(utama).substr(0,4));
                var belakang = a%1000000;
                var kalimat = terbilang(depan) + ' Juta '+ terbilang(belakang);
            }
            else if(a < 10000000000){
                var utama = a/1000000000;
                var depan = parseInt(String(utama).substr(0,1));
                var belakang = a%1000000000;
                var kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
            }
            else if(a < 100000000000){
                var utama = a/1000000000;
                var depan = parseInt(String(utama).substr(0,2));
                var belakang = a%1000000000;
                var kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
            }
            else if(a < 1000000000000){
                var utama = a/1000000000;
                var depan = parseInt(String(utama).substr(0,3));
                var belakang = a%1000000000;
                var kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
            }
            else if(a < 10000000000000){
                var utama = a/10000000000;
                var depan = parseInt(String(utama).substr(0,1));
                var belakang = a%10000000000;
                var kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
            }
            else if(a < 100000000000000){
                var utama = a/1000000000000;
                var depan = parseInt(String(utama).substr(0,2));
                var belakang = a%1000000000000;
                var kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
            }
        
            else if(a < 1000000000000000){
                var utama = a/1000000000000;
                var depan = parseInt(String(utama).substr(0,3));
                var belakang = a%1000000000000;
                var kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
            }
        
          else if(a < 10000000000000000){
                var utama = a/1000000000000000;
                var depan = parseInt(String(utama).substr(0,1));
                var belakang = a%1000000000000000;
                var kalimat = terbilang(depan) + ' Kuadriliun '+ terbilang(belakang);
            }
        
            var pisah = kalimat.split(' ');
            var full = [];
            for(var i=0;i<pisah.length;i++){
             if(pisah[i] != ""){full.push(pisah[i]);}
            }
            return full.join(' ');
    },
    downloadFileDZ: function(){
        $(document).on('click','.dropzone .dz-details', function () {
            if($(this).attr('path')){
                window.open($(this).attr('path') + $(this).find('.dz-filename span').text(), '_blank');
            }
        })
    },
    timerlogout: function () {

        if ($('#logoutin').length) {


            // Set the date we're counting down to
            var countDownDate = new Date(localStorage.getItem("startapp")).getTime();

            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get todays date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                // Output the result in an element with id="demo"
                document.getElementById("logoutin").innerHTML = ("0" + minutes).slice(-2) + ":" + ("0" + seconds).slice(-2) + "";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    window.location.href = __base_url + "admin";
                }
            }, 1000);
        }
    },
    selectedSchool: function () {
        $(document).on('change', '.sidebar-form select[name="id_skl[]"]', function () {
            
            $.when(localStorage.setItem("selectedSchool", JSON.stringify($(this).val()))).done(function () {
                location.reload();
            })
        });
        $(document).on('click', '#pilih_sekolah', function () {
            location.reload();
        })
    },
    getselectedSchool: function () {
        return localStorage.getItem("selectedSchool");
    },
    getData: function (data) {
        var datasekolah = JSON.parse(data.sekolah.replace(/(['"])?([a-z0-9A-Z_]+)(['"])?:/g, '"$2": '));
        var skl = [];
        $.each(datasekolah, function (i, value) {
            skl.push('<option value="' + value.id + '">' + value.nm_skl + '</option>');
        });

        if (skl.length > 1) {
            $('.sidebar-form').show();
        }

        $('.sidebar-form select[name="id_skl[]"]').append(skl.join("")).trigger("chosen:updated");
        if (localStorage.getItem("selectedSchool")) {
            setTimeout(() => {
                JSON.parse(localStorage.getItem("selectedSchool")).forEach(function (value) {
                    // console.log(value)
                    $('.sidebar-form select[name="id_skl[]"] option[value="' + value + '"]').prop("selected", true);
                })
            }, 1000);

        } else {
            localStorage.setItem("selectedSchool", '[' + Main.getCurrentUser().multi_sekolah + ']');
        }
    },
    setMultiSchool: function () {
        if (!localStorage.getItem("setMultiSchool") && localStorage.getItem("currentUser")) {
            $.ajax({
                url: __base_url + 'admin/home/getsekolah',
                data: {
                    data: JSON.stringify([{
                        id_skl: Main.getCurrentUser().multi_sekolah
                    }])
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function (data) {
                    Main.getData(data);
                    localStorage.setItem("setMultiSchool", JSON.stringify(data));
                },
                error: function (e) {

                },
                complete: function (e) {

                }
            });
        } else {
            Main.getData(JSON.parse(localStorage.getItem("setMultiSchool")))
        }
    },
    getCurrentUser: function () {
        return JSON.parse(localStorage.getItem('currentUser'))[0];
    },
    setCurrentUserAdmin: function () {
        $('.user-panel .name').text(Main.getCurrentUser().name);
        $('.user-panel .usertype').text(Main.getCurrentUser().user_type_name);
    },
    datepicker: function () {
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });
    },
    onlydatepicker: function () {
        if ($('.onlydatepicker').length) {
            //$(".onlydatepicker").datetimepicker({ format: 'dd/mm/yyyy hh:ii' });
            $('.onlydatepicker').datetimepicker({
                format: 'DD/MM/YYYY',
                useCurrent: false
                //useCurrent: 'day',
                //autoclose: true
            }).attr("tabindex", 0).find("input").css("pointer-events", "none");
        }
    },
    onlymonthyearpicker: function () {
        if ($('.onlymonthyearpicker').length) {
            //$(".onlydatepicker").datetimepicker({ format: 'dd/mm/yyyy hh:ii' });
            $('.onlymonthyearpicker').datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY',
                useCurrent: false
                //useCurrent: 'day',
                //autoclose: true
            }).attr("tabindex", 0).find("input").css("pointer-events", "none");

            $(".onlymonthyearpicker").on("dp.show", function (e) {
                $(e.target).data("DateTimePicker").viewMode("months");
            })
        }
    },
    onlyyearpicker: function () {
        if ($('.onlyyearpicker').length) {
            $('.onlyyearpicker').datetimepicker({
                viewMode: 'years',
                format: 'YYYY',
                useCurrent: false
                //useCurrent: 'day',
                //autoclose: true
            }).attr("tabindex", 0).find("input").css("pointer-events", "none");

            $(".onlyyearpicker").on("dp.show", function (e) {
                $(e.target).data("DateTimePicker").viewMode("years");
            })
        }
    },
    onlytimepicker: function () {
        if ($('.onlytimepicker').length) {
            $('.onlytimepicker').datetimepicker({
                format: 'HH:mm',
                //useCurrent: 'day',
                useCurrent: false
            }).attr("tabindex", 0).find("input").css("pointer-events", "none");
        }
    },
    datetimepicker: function () {
        if ($('.datetimepicker').length) {
            $('.datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY HH:mm:00',
                //useCurrent: 'day',
                useCurrent: false,
            }).attr("tabindex", 0).find("input").css("pointer-events", "none");
        }
    },
    changepassword: function () {
        var changePasswordForm = '#changePasswordForm';
        $(document).on('click', changePasswordForm + ' .btn-save', function (e) {
            e.preventDefault();
            var btn = $(this)
            var value = Main.objectifyForm($(changePasswordForm).serializeArray());

            $.ajax({
                url: $(changePasswordForm).attr('action'),
                data: {
                    data: JSON.stringify([value])
                },
                method: $(changePasswordForm).attr('method'),
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                success: function (data) {
                    $('#myModal button.close').trigger('click');
                },
                error: function (e) {
                    Main.autoSetError(changePasswordForm, e.responseJSON.error)
                },
                complete: function (e) {

                }
            });
        })
    },
    getNavBar: function () {
        if (localStorage.getItem("treeview")) {
            // alert(localStorage.getItem("treeview"))
            $('.sidebar-menu').html(localStorage.getItem("treeview"))
            setTimeout(() => {
                $('.treeview-menu li a').each(function () {
                    if (window.location.href == $(this).attr('href')) {
                        $(this).parents('.treeview').addClass('menu-open');
                        $(this).parents('.treeview-menu').show();
                        $(this).parent().addClass('active');
                    }
                });
            }, 1000);
        } else {
            Main.getDataNavBar()
        }

        Main.iconIcon();
    },
    setNavBar: async function () {
        // if (localStorage.getItem("navigationBar")) {
        var parent = [];
        var menu = [];
        var menuid = [];
        var action = [];
        $.each(JSON.parse(localStorage.getItem("navigationBar")), function (i, value) {

            if (value.parent_id == 0) {
                parent.push(value);
            }
            if (value.parent_id) {
                menu.push(value);
            }
            if (value.menu_id) {
                menuid.push(value);
            }

            action.push(value.default_url);

        })

        var treeview = '';
        $.each(parent, function (i, value) {

            var menuview = '';
            menuview += '<ul class="treeview-menu">';
            $.each(menu, function (i, tree) {

                // console.log(tree);

                if (tree.parent_id == value.id) {
                    menuview += '<li><a href="' + (__base_url + 'admin/' + tree.default_url) + '"><i class="fa '+ tree.icon +'"></i> ' + tree.label + '</a></li>';
                }
            });
            // return false;
            menuview += '</ul>';

            treeview += '\n\
                    <li class="treeview">\n\
                        <a href="#">\n\
                            <i class="fa '+value.icon+'"></i> <span>'+ value.label + '</span>\n\
                            <span class="pull-right-container">\n\
                                <i class="fa fa-angle-left pull-right"></i>\n\
                            </span>\n\
                        </a>\n\
                        '+ menuview + '\n\
                    </li>\n\
            ';
        });
        treeview += '\n\
            <li class="header">LABELS</li>\n\
            <li><a href="'+ __base_url + 'admin/login/changepassword/' + JSON.parse(localStorage.getItem('currentUser'))[0].id + '" class="btn-update" title="Change Password"><i class="fa fa-circle-o text-yellow"></i> <span>Change Password</span></a></li>\n\
            <li><a href="'+ __base_url + 'welcome/logout' + '"><i class="fa fa-circle-o text-aqua"></i> <span>Logout</span></a></li>\n\
        ';
        await localStorage.setItem("treeview", treeview);
        // await localStorage.setItem("validatePage", action.join(','));
        Main.getNavBar()


        $.post(__base_url + 'admin/login/session',
            {
                token: localStorage.getItem("token"),
                action: action.join(','),
            }, function () {

                // Main.getDataDashboard();


            });

        // }
    },
    getDataNavBar: function () {
        if (!localStorage.getItem("navigationBar")) {
            $.ajax({
                url: __base_url + 'api/auth/getMultiMenuById',
                method: 'POST',
                headers: { 'Authorization': localStorage.getItem("token") },
                data: {
                    id_multi: JSON.parse(localStorage.getItem('currentUser'))[0].menu_id_detail
                },
                success: async function (data) {
                    await localStorage.setItem("navigationBar", JSON.stringify(data.data));
                    Main.setNavBar();
                },
                error: function (e) {
                },
                complete: function (e) {

                }
            });
        }
    },
    autoSetTableHeader: function (attr, value, show) {
        $.each(value, function (i, val) {
            var td = "<td>" + (i + 1) + "</td>";
            show.forEach(function (key) {
                if (val[key]) {
                    td += '<td>' + val[key] + '</td>';
                }
            })
            $(attr + ' tbody').append('<tr>' + td + '</tr>')
        })
    },
    autoSetTableRead: function (attr, value, show) {

        show.forEach(function (key) {
            if (value[key]) {
                $(attr + ' tbody').append('<tr><td>' + key.replace(/_/g, ' ').toLocaleUpperCase() + '</td><td>: ' + value[key] + '</td></tr>')
            }
        })
    },
    checkboxIsActive: function () {
        if ($('input.checkbox_check').is(':checked')) {

        }
        $(document).on('click', 'input[name="is_active"]', function () {
            $(this).val($(this).is(':checked') ? 1 : 0)
        })
    },
    removeObjectEmpty: function (obj) {
        for (var propName in obj) {
            if (!obj[propName]) {
                delete obj[propName];
            }
        }
        return obj;
    },
    objectifyForm: function (formArray) {
        console.log('objectifyForm invoked')
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++) {
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    },
    autoSetValue: function (attributes, value) {
        $(attributes + ' input,' + attributes + ' textarea,' + attributes + ' select').each(function () {
            for (var key in value) {
                if (value.hasOwnProperty(key)) {
                    if ($(this).attr("name") && key.toLowerCase() == $(this).attr("name").toLowerCase()) {
                        $(this).val(value[key]);
                        // if ($(this)[0].localName == 'select') {
                        //     $(this).trigger('change');
                        // }
                        if ($(this).attr("type") == 'checkbox') {
                            if (value[key] == 0) {
                                $(this).prop("checked", false)
                            } else {
                                $(this).prop("checked", true)
                            }
                        }
                    }
                }
            }

        })
    },
    autoSetError: function (attributes, value) {
        console.log('autoSetError')
        console.log('attributes=>', attributes)
        console.log('value=>', value)
        $(attributes + ' input,' + attributes + ' textarea,' + attributes + ' select').each(function () {
            var form_group = $(this).parents(".form-group");

            // kosongkan datanya
            form_group.removeClass('has-error');
            form_group.find('.help-block').text('');

            for (var key in value) {
                if (key == $(this).attr('name')) {
                    form_group.addClass('has-error');
                    form_group.find('.help-block').text(value[key])
                }
            }

            if (!form_group.hasClass('has-error')) {
                form_group.addClass('has-success');
            }
        })
    },
    modalSiswa: function () {
        $(document).on('click', '.btn-carisiswa', function (e) {
            var modal = $('#myModalsiswa');
            modal.modal('show');
            modal.find('.alert').addClass('alert-success');
            modal.find('.modal-title').html('Cari Siswa');
            modal.find('.modal-dialog').addClass('modal-lg');
            modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
            $.get(__base_url + 'admin/page/carisiswa')
                .done(function (data) {
                    modal.find('.modal-body').html(data);
                });
        });
    },
    modalGuru: function () {
        $(document).on('click', '.btn-cariguru', function (e) {
            var modal = $('#myModalguru');
            modal.modal('show');
            modal.find('.alert').addClass('alert-success');
            modal.find('.modal-title').html('Cari Guru');
            modal.find('.modal-dialog').addClass('modal-lg');
            modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
            $.get(__base_url + 'admin/page/cariguru')
                .done(function (data) {
                    modal.find('.modal-body').html(data);
                });
        });
    },
    modalPegawai: function () {
        $(document).on('click', '.btn-caripegawai', function (e) {
            var modal = $('#myModalpegawai');
            modal.modal('show');
            modal.find('.alert').addClass('alert-success');
            modal.find('.modal-title').html('Cari Pegawai');
            modal.find('.modal-dialog').addClass('modal-lg');
            modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
            $.get(__base_url + 'admin/page/caripegawai')
                .done(function (data) {
                    modal.find('.modal-body').html(data);
                });
        });
    },
    modalUser: function () {
        $(document).on('click', '.btn-cariuser', function (e) {
            var modal = $('#myModaluser');
            modal.modal('show');
            modal.find('.alert').addClass('alert-success');
            modal.find('.modal-title').html('Cari Pegawai');
            modal.find('.modal-dialog').addClass('modal-lg');
            modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
            $.get(__base_url + 'admin/page/cariuser')
                .done(function (data) {
                    modal.find('.modal-body').html(data);
                });
        });
    },
    modalDialog: function () {
        $(document).on('click', '.modal button.close, .modal button.btn-danger, .modal', function () {
            setTimeout(function () {
                if ($('.modal').is(':visible')) {
                    $('body').addClass('modal-open');
                    $('body').css('padding-right', '17px');
                }
            }, 500)
        });
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                //                            text: "You won't be able to revert this!",
                type: 'warning',
                // timer: 5000,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                showLoaderOnConfirm: true,
                preConfirm: function (email) {
                    return new Promise(function (resolve, reject) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            headers: { 'Authorization': localStorage.getItem("token") },
                            beforeSend: function (data) {
                            },
                            success: function (e) {
                                if (e.hasOwnProperty('data')) {
                                    resolve(e);
                                    $('#mytable').DataTable().ajax.reload(null, false);
                                    if ($('#mytableform').length) {
                                        Data.getDetailTransaksi();
                                    }
                                    if ($('#mytableTodo').length) {
                                        $('#mytableTodo').DataTable().ajax.reload(null, false);
                                    }
                                } else {
                                    $('.swal2-title').hide();
                                    $('#swal2-content').html(e);
                                    $('#swal2-content').show();
                                    $('.swal2-confirm').hide();
                                    $('.swal2-cancel').attr('disabled',false);
                                    // return false;
                                }
                                
                            }, error: function (e) {
                            }, complete: function (e) {

                            }
                        });

                    })
                },
            }).then(function (data) {
                if (data.dismiss != "cancel" && data.dismiss != "timer") {
                    swal(
                        'Deleted!',
                        data.message,
                        'success'
                    );
                }

            }, function (dismiss) {
            });
        })

        $(document).on('click', '.btn-create, .btn-update, .btn-read', function (e) {
            e.preventDefault();
            var alert;
            if ($(this).hasClass('btn-create')) {
                alert = 'alert-success';
            } else if ($(this).hasClass('btn-update')) {
                alert = 'alert-warning';
            } else if ($(this).hasClass('btn-read')) {
                alert = 'alert-info';
            } else {
                alert = 'alert-danger';
            }


            var url = $(this).attr('href');
            var title = $(this).attr('title');
            var zoom = $(this).attr('data-zoom') != undefined ? $(this).attr('data-zoom') : 'modal-lg';
            var modal = $('#myModal');
            modal.modal('show');
            modal.find('.alert').removeClass('alert-success alert-danger alert-info alert-warning');
            modal.find('.alert').addClass(alert);
            modal.find('.modal-title').html(title);
            modal.find('.modal-dialog').removeClass('modal-xl modal-lg modal-md modal-sm modal-xs');
            modal.find('.modal-dialog').addClass(zoom);
            modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
            $.get(url)
                .done(function (data) {
                    modal.find('.modal-body').html(data);

                });




        });
    },
    statusConnection: function () {
        window.addEventListener("online", function () {
            Main.indikatorConnection();
        })
        window.addEventListener("offline", function () {
            Main.indikatorConnection();
        })
    },
    indikatorConnection() {
        if (navigator.onLine) {
            $('#indikatorConnection').html('<i class="fa fa-circle text-success"></i> Online');
        } else {
            $('#indikatorConnection').html('<i class="fa fa-circle text-danger"></i> Offline');
        }
    },
    loaderAjax: function () {
        $(document).ajaxStart(function () {
            $('#page-loader').show();
            $('body').addClass('page-loader-body');
        }).ajaxStop(function () {
            $('body').removeClass('page-loader-body');
            $('#page-loader').hide();
        }).ajaxError(function () {
            $('body').removeClass('page-loader-body');
            $('#page-loader').hide();
        });
        $(document).ready(function () {
            $('body').removeClass('page-loader-body');
            $('#page-loader').hide();
        });
    },
    tableCreateMulti: function (data) {

        var tableBody = "";

        var columns = [];
        // Create the header record.
        tableBody += '<thead>';
        tableBody += "<tr>";
        for (var prop in data[0]) {
            if (data[0].hasOwnProperty(prop)) {
                // Append properties such as email, fname, lname etc.
                tableBody = tableBody + ("<th>" + prop + "</th>");

                // Also keep a list of columns, that can be used later to get column values from the 'data' object.
                columns.push(prop);
            }
        }
        tableBody += "</tr>";
        tableBody += '</thead>';
        // Create the data rows.
        tableBody += '<tbody>';
        data.forEach(function (row) {
            // Create a new row in the table for every element in the data array.
            tableBody = tableBody + "<tr>";

            columns.forEach(function (cell) {
                // Cell is the property name of every column.
                // row[cell] gives us the value of that cell.
                tableBody = tableBody + "<td>" + row[cell] + "</td>";
            });

            tableBody = tableBody + "</tr>";
        });
        tableBody += '</tbody>';
        return tableBody;
    },
    convertToSlug: function (Text) {
        return Text
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '')
            ;
    },
    dropzoneInit: function (data) {

        $(function () {


            var zone = JSON.parse(data);
            console.log(JSON.parse(data))

            //        {create: "http://localhost/pms/welcome/attach/standartjob/create/SJ-180514112343", 
            //                    delete: "http://localhost/pms/welcome/attach/standartjob/delete/SJ-180514112343", 
            //                    read: "http://localhost/pms/public/attach/standartjob/", 
            //                    input: "input[name="attach"]", 
            //                    class_dropzone: ".dropzone"}


            Dropzone.autoDiscover = false;
            var foto_upload = new Dropzone(zone.dropzone, {
                url: zone.create,
                params: JSON.parse(zone.params),
                method: 'POST',
                headers: { 'Authorization': localStorage.getItem("token") },
                maxFilesize: 2,
                acceptedFiles: zone.acceptedFiles,
                paramName: "attach",
                dictInvalidFileType: "Type file ini tidak dizinkan",
                addRemoveLinks: true,
                //            thumbnailWidth: 300,
                //            thumbnailHeight: 300,
                init: function () {

                    thisDropzone = this;

                    var attach = $(zone.input).val();
                    var arr_new = [];
                    attach = attach.split(',').filter(Boolean);
                    attach.forEach(function (a, b) {
                        var src = zone.read + a;
                        console.log(src)
                        if (Main.imageExists(src)) {
                            arr_new.push(a)
                            var mockFile = { name: a, size: 12345 };
                            thisDropzone.emit("addedfile", mockFile);

                            thisDropzone.createThumbnailFromUrl(mockFile, src);

                            // Make sure that there is no progress bar, etc...
                            thisDropzone.emit("complete", mockFile);
                            //                    console.log(thisDropzone.removeFile)
                        }
                    })
                    $(zone.input).val(arr_new)

                    setTimeout(function () {
                        $('.dz-preview').each(function (a, b) {
                            var alt = $(this).find('.dz-filename span').text();
                            console.log(alt)
                            $(this).find('.dz-remove').attr('id', alt)
                            if (!zone.removefile) {
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
                    this.on("success", function (file, result) {
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

                    this.on("complete", function (file, result) {
                        //                    console.log($(this).find('a.dz-remove').html())
                        //                    console.log(result)
                        //                    console.log(this.getUploadingFiles())
                        //
                        //                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        //                        doSomething();
                        //                    }
                    });

                    //Event ketika Memulai mengupload
                    this.on("sending", function (a, b, c) {
                        a.token = Math.random();
                        c.append("token_foto", a.token); //Menmpersiapkan token untuk masing masing foto
                    });

                    //Event ketika Memulai mengupload
                    this.on("uploadprogress", function (a, b, c) {

                        console.log(a.upload.progress)
                        console.log(b)
                        console.log(c)
                    });

                    //Event ketika foto dihapus
                    this.on("removedfile", function (a) {

                        var token = a.token;
                        $.ajax({
                            type: "post",
                            data: { token: token, id: a._removeLink.id },
                            url: zone.delete,
                            cache: false,
                            //                        dataType: 'json',
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status == 1) {
                                    var attach = $(zone.input).val();
                                    var nn = attach.split(',').filter(Boolean);
                                    var index = nn.indexOf(result.data.name);
                                    if (index > -1) {
                                        nn.splice(index, 1);
                                    }
                                    $(zone.input).val(nn.filter(Boolean).join());
                                }

                                if ($('.dz-image-preview').html() == undefined) {
                                    $('.dz-message').show();
                                } else {
                                    $('.dz-message').hide();
                                }
                            },
                            error: function () {
                                console.log("Error");

                            }
                        });
                    });

                }
            });
        });
    },
    imageExists: function (image_url) {

        //    $.ajax({url:'somefile.dat',type:'HEAD',error:do_something});
        var http = new XMLHttpRequest();

        http.open('HEAD', image_url, false);
        http.send();

        return http.status != 404;

    },
    chosen: function (att = {}) {
        var attr = {
            width: "100%",
            search_contains: true,
        };
        var newAttr = $.extend({}, attr, att);

        $('.chosen').chosen(newAttr);
    },
    previewimage: function (img, attr) {
        if (img.files && img.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                attr.attr('src', e.target.result);
            }

            reader.readAsDataURL(img.files[0]);
        }
    },
    getBase64Image: function (imgUrl, callback) {

        var img = new Image();

        // onload fires when the image is fully loadded, and has width and height

        img.onload = function () {

            var canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);
            var dataURL = canvas.toDataURL("image/png");
            //   ,
            //       dataURL = dataURL.replace(/^data:image\/(png|jpg);base64,/, "");

            callback(dataURL); // the base64 string

        };

        // set attributes and src 
        img.setAttribute('crossOrigin', 'anonymous'); //
        img.src = imgUrl;
    },
    exportToExcel: function (data) {

        var title = '<b>' + data.title + '<b> <br> <b>Periode : ' + data.periode + '<b> <br> <b>' + data.header + '<b> <br>';

        var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
        tab_text = tab_text + '<x:Name>Sheet1</x:Name>';
        tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
        tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

        tab_text = tab_text + title;

        tab_text = tab_text + "<table border='1px'>";

        var exportTable = $('#' + data.table).clone();
        exportTable.find('.mark').each(function (index, elem) { $(elem).remove(); });

        tab_text = tab_text + exportTable.html();
        tab_text = tab_text + '</table></body></html>';
        var data_type = 'data:application/vnd.ms-excel';
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        var fileName = data.name + '.xls';
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            if (window.navigator.msSaveBlob) {
                var blob = new Blob([tab_text], {
                    type: "application/csv;charset=utf-8;"
                });
                navigator.msSaveBlob(blob, fileName);
            }
        } else {
            var blob2 = new Blob([tab_text], {
                type: "application/csv;charset=utf-8;"
            });
            var filename = fileName;
            var elem = window.document.createElement('a');
            elem.href = window.URL.createObjectURL(blob2);
            elem.download = filename;
            document.body.appendChild(elem);
            elem.click();
            document.body.removeChild(elem);
        }
    },
    exportToWord: function (data) {

        var head = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
            "xmlns:w='urn:schemas-microsoft-com:office:word' " +
            "xmlns='http://www.w3.org/TR/REC-html40'>" +
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
        var footer = "</body></html>";

        var title = '';
        // if(data.title){
        //     title += '<b>'+ data.title +'<b> ';
        // }
        if (data.header) {
            title += '<br><b>' + data.header + '<b> ';
        }
        if (data.periode) {
            title += '<br><b>Periode : ' + data.periode + ' <b> ';
        }

        mydiv = document.createElement('div');
        mydiv.innerHTML = document.getElementById(data.table).innerHTML;
        $(mydiv).find(data.table).attr('cellspacing', 0);
        $(mydiv).find(data.table).attr('cellpadding', 0);

        $(mydiv).find(data.table + ' th').attr('style', "border: 1px solid #dddddd;");
        $(mydiv).find(data.table + ' td').attr('style', "border: 1px solid #dddddd;");


        console.log($(mydiv).html())


        var sourceHTML = head + title + $(mydiv).html() + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;
        fileDownload.download = data.name + '.doc';
        fileDownload.click();
        document.body.removeChild(fileDownload);
    },
    exportToPdf: function (data) {
        // header, table, name, pageOrientation = 'portrait', periode = ''
        var body = [];
        var widths = [];
        $("#" + data.table + " tr").each(function (i) {
            if ($(this).parent()[0].localName == 'thead') {
                var th = [];
                $(this).children().each(function () {
                    th.push($(this).text());
                });
                body.push(th);
            } else {
                var td = [];
                $(this).children().each(function () {
                    td.push($(this).text());
                });
                body.push(td);
            }
        });

        $.each(body[0], function () {
            widths.push('*');
        });

        var docDefinition = {
            content: [
                // { text: data.title, style: 'header'},
                { text: data.header, style: 'header' },
                { text: "Periode : " + data.periode, style: 'header' },
                {
                    style: 'tableExample',
                    widths: widths,
                    table: {
                        headerRows: 1,
                        body: body
                    },
                    layout: {
                        hLineWidth: function (i, node) {
                            return (i === 0 || i === node.table.body.length) ? 0.1 : 0.1;
                        },
                        vLineWidth: function (i, node) {
                            return (i === 0 || i === node.table.widths.length) ? 0.1 : 0.1;
                        }
                    }
                },
            ],
            styles: {
                header: {
                    fontSize: 8,
                    bold: true,
                    //margin: [0, 0, 0, 10]
                },
                tableExample: {
                    margin: [0, 5, 0, 15],
                    fontSize: 5
                },
            },
            pageOrientation: (data.pageOrientation ? data.pageOrientation : 'portrait'),
        };

        //pdfMake.createPdf(docDefinition).open();
        pdfMake.createPdf(docDefinition).download(data.name + '.pdf');
    },
    UrlExists: function (url) {
        var http = new XMLHttpRequest();
        http.open('HEAD', url, false);
        http.send();
        return http.status != 404;
    },
    numberWithCommas: function (x,tofix=0) {
        var parts = parseFloat(x).toFixed(tofix).toString().split(",");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(",");
    },
    numberLostCommas: function (x) {
        var parts = x.toString().split(",");
        parts[0] = parts[0].replace(/[^\d,]/g, '');
        return parts.join(",");
    },
    numberLostChar: function (x) {
        return x.replace(/[^0-9]/g, '');
    },
    removequotes: function (string) {
        return string.
            replace(/'/g, '');
    },
    addslashes: function (string) {
        return string.replace(/\\/g, '\\\\').
            replace(/\u0008/g, '\\b').
            replace(/\t/g, '\\t').
            replace(/\n/g, '\\n').
            replace(/\f/g, '\\f').
            replace(/\r/g, '\\r').
            replace(/'/g, '\\\'').
            replace(/"/g, '\\"');
    },
    monthNameIndo: function (int) {
        const monthNames = [
            "Januari", "Februari", "Maret", "April", "May", "Juni",
            "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"
        ];
        return monthNames[int-1];
    },
    resizeImage: function(img, width, height) {
        // create an off-screen canvas
        var canvas = document.createElement('canvas'),
        ctx = canvas.getContext('2d');

        // set its dimension to target size
        canvas.width = width;
        canvas.height = height;

        // draw source image into the off-screen canvas:
        ctx.drawImage(img, 0, 0, width, height);

        // encode image to data-uri with base64 version of compressed image
        return canvas.toDataURL();
    }
};
$(document).ready(function () {
    Main.init();
});