var Data = {
    init: function () {
        // Main.getSekolah();
        // Main.getTahun();
        // Main.getKelas();
        // Main.getSemester();
        // Main.getJurusan();
        // Main.getSiswa();

    },


    kenaikanKelas: async function (form, attribute, params = { is_active: 1 }) {
        await $.post(__base_url + 'api/data/kenaikankelasread',params,function (data) {
              return data;
        })
    },
    
    transkip: async function (form, attribute, params = { is_active: 1 }) {
        await $.post(__base_url + 'api/data/transkipread',params,function (data) {
              return data;
        })
    },



    getMenuParent: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/menuread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .label).attr('value', value.id));
                });
            }
        })
    },
    getUser: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/userread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                        $(form + attribute).append($('<option>').text(value.name).attr('value', value.id));
                });
            }
        })
    },
    getUsertype: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/master/usertype/read",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    var usertype = Main.getCurrentUser().user_type_id;
                    if (usertype == 1) {
                        $(form + attribute).append($('<option>').text(value
                            .name).attr('value', value.id));
                    } else if (usertype != 1 && value.id != 1) {
                        $(form + attribute).append($('<option>').text(value
                            .name).attr('value', value.id));
                    }
                });
            }
        })
    },
    getTipeUjian: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/tipeujianread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                        $(form + attribute).append($('<option>').text(value
                            .tipe).attr('value', value.id));
                });
            }
        })
    },

    getStatusKawin: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/statuskawinread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                        $(form + attribute).append($('<option>').text(value
                            .name).attr('value', value.id));
                });
            }
        })
    },
    getTahun: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/tahun_ajaranread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .tahun).attr('value', value.id));
                });
            }
        })
    },
    getEkskul: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/ekskulread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .ekskul).attr('value', value.id));
                });
            }
        })
    },
    getSekolah: function (form, attribute, params = { 
        is_active: 1, where: "mst.id in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/sekolahread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .nm_skl).attr('value', value.id));
                        if(Main.getCurrentUser().user_type_id!=1){
                            $(form + attribute).val(value.id);
                            $(form + attribute).parents('.form-group').hide();
                        }
                });
            }
        })
    },
    getJenisBuku: function (form, attribute, params = { 
        is_active: 1,
    }) {
        $.ajax({
            url: __base_url + "api/data/jenisbukuread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .jenis).attr('value', value.id));
                });
            }
        })
    },
    getTahunAjaran: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/tahun_ajaranread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .tahun).attr('value', value.id));
                });
            }
        })
    },
    getKelas: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/kelasread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .nama_kelas).attr('value', value.id));
                });
            }
        })
    },
    getSemester: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/semesterread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .semester).attr('value', value.id));
                });
            }
        })
    },
    getJurusan: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/jurusanread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .jurusan).attr('value', value.id));
                });
            }
        })
    },
    getMapel: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/mapelread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .name).attr('value', value.id));
                });
            }
        })
    },
    getRPP: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/rppread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text('Semester '+ value.semester +' || Mapel '+ value.mapel_name).attr('value', value.id));
                });
            }
        })
    },
    getSiswaNative: function (form, attribute, params = {}) {
        $.ajax({
            url: __base_url + "api/data/siswanativeread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .nama_siswa).attr('value', value.id_user));
                });
            }
        })
    },
    getSiswa: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/siswaread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .nama_siswa).attr('value', value.id));
                });
            }
        })
    },
    getJK: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/jkread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .name).attr('value', value.id));
                });
            }
        })
    },
    getAgama: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/agamaread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .agama).attr('value', value.id));
                });
            }
        })
    },
    getGoldar: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/goldarread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .goldar).attr('value', value.id));
                });
            }
        })
    },
    getKodeGL: function (form, attribute, params = { 
        is_active: 1, 
        // where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/kodeglread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .name).attr('value', value.id));
                });
            }
        })
    },
    getTahunBuku: function (form, attribute, params = { 
        is_active: 1, 
        // where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/tahunbukuread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .tahun).attr('value', value.id));
                });
            }
        })
    },
    getJenisTransaksi: function (form, attribute, params = { 
        is_active: 1, 
        // where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/jenistransaksiread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value.kode + " - " + value.jenis).attr('value', value.id));
                });
            }
        })
    },
    getItemTransaksi: function (form, attribute, params = { 
        is_active: 1, 
        where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/itemtransaksiread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value.pembayaran).attr('value', value.id));
                });
            }
        })
    },
    getTempattinggal: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/tempattinggalread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .dengan).attr('value', value.id));
                });
            }
        })
    },
    getStatustinggal: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/statustinggalread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .dengan).attr('value', value.id));
                });
            }
        })
    },
    getTransportasirumah: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/transportasirumahread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .trn).attr('value', value.id));
                });
            }
        })
    },
    getJarakrumah: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/jarakrumahread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .jarak).attr('value', value.id));
                });
            }
        })
    },
    getDibiayaioleh: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/dibiayaiolehread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .pendidikan).attr('value', value.id));
                });
            }
        })
    },
    getPendidikanterakhir: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/pendidikanterakhirread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .pendd).attr('value', value.id));
                });
            }
        })
    },
    getPekerjaan: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/pekerjaanread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .pek).attr('value', value.id));
                });
            }
        })
    },
    getTrans: function (form, attribute, params = { is_active: 1 }) {
        $.ajax({
            url: __base_url + "api/data/transread",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .name).attr('value', value.id));
                });
            }
        })
    },


    // kanton
    getCategoryProduct: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
     }) {
        $.ajax({
            url: __base_url + "api/data/categoryproduct",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value
                        .name).attr('value', value.id));
                });
            }
        })
    },
    getCustomer: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/customer",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value.fullname).attr('value', value.id).attr('data', JSON.stringify(value)));
                });
            }
        })
    },
    getOutlet: function (form, attribute, params = { 
        is_active: 1, where: "mst.id_skl in(" + JSON.parse(Main.getselectedSchool()).join(',') + ")" 
    }) {
        $.ajax({
            url: __base_url + "api/data/outlet",
            data: params,
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function (data) { },
            success: function (data) {
                $.each(data.data, function (i, value) {
                    $(form + attribute).append($('<option>').text(value.nama_toko).attr('value', value.id));
                });
            }
        })
    },

    getDetailTransaksiTotal: function () {
        var nominal = 0;
        $('#mytableform .nominal').each(function () {
            nominal += parseInt(Main.numberLostChar($(this).text()));
        })

        if (!$('#mytableform tfoot').length) {
            $('#mytableform').append(
                "<tfoot><tr><td colspan=\"2\"><b class=\"pull-right\">Total</b><td class=\"pull-right\"><b class=\"total\">" + Main.numberWithCommas(nominal) + "</b></td>\"></td><td></td></tr></tfoot>"
                // $('<tfoot>').append($('tr').append($('td')).attr('colspan',3).attr('style','float:right').text("total")
                // .append('tr').append('td').attr('colspan',2).text("0")
            )
        } else {
            $('#mytableform tfoot .total').text(Main.numberWithCommas(nominal));
        }
    },
    getDetailTransaksi: function () {
        if ($.fn.dataTable.isDataTable("#mytableform")) {
            $('#mytableform').DataTable().ajax.reload(null, false);

        } else {
            $('#mytableform').DataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": false,
                "orderCellsTop": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": __base_url + "api/keuangan/transaksikeuangan/json",
                    "type": "POST",
                    "headers": {
                        'Authorization': localStorage.getItem("token")
                    },
                    "data": function (d) {

                        $.extend(d, {
                            jurnal: $('input[name="jurnal"]').val(),
                            date: '',
                            id_skl: JSON.parse(Main.getselectedSchool()).join(','),
                        });
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
                // {
                //     "data": "jenis"
                // },
                {
                    "data": "ket"
                },
                {
                    "data": "nominal",
                    render: function (row, data, iDisplayIndex) {
                        var result = "";
                        result += "<b class=\"nominal pull-right\">" + Main.numberWithCommas(iDisplayIndex.nominal) + "</b>";
                        return result;
                    }
                },
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "render": function (row, data, iDisplayIndex) {
                        var result = "";
                        result += "<button data='" + JSON.stringify(iDisplayIndex) + "'" +
                            "admin/keuangan/transaksikeuangan/update/" +
                            iDisplayIndex.id +
                            "\" class=\"btn btn-warning btn-updateform btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                        result += "<button href=\"" + __base_url +
                            "api/keuangan/transaksikeuangan/delete/" +
                            iDisplayIndex.id +
                            "\" class=\"btn btn-danger btn-delete btn-deleteform btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                        return result;
                    }
                },
                ],
                "order": [
                    [0, 'desc']
                ],
                rowCallback: function (row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);


                },
                initComplete: function () {
                    Data.getDetailTransaksiTotal();
                },
                drawCallback: function () {
                    Data.getDetailTransaksiTotal();

                }
            });

        }
    },

};
$(document).ready(function () {
    Data.init();
});