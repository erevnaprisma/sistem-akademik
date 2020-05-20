<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
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
    var form = '#usertypeForm';

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
        // responsive: true,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
        dom: "lBfrtip",
        buttons: [{
            text: "Create",
            className: "btn btn-create btn-success fa fa-plus",
            init: function(a, b, c) {
                b.attr('href', __base_url + 'admin/master/usertype/create');
                b.attr('title', 'CREATE');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/master/usertype/json",
            "type": "POST",
            "headers": {
                'Authorization': localStorage.getItem("token")
            },
            "data": function(d) {

                $.extend(d, {
                    date: '',
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
            {
                "data": "name"
            },
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
                    result += "<button href=\"" + __base_url + "admin/master/usertype/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                    result += "<button href=\"" + __base_url +
                        "admin/master/usertype/privilege/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-primary btn-update btn-xs\" title=\"Privilege\"><i class=\"fa fa-gear\"></i> Privilege</button>";
                    result += "<button href=\"" + __base_url +
                        "admin/master/usertype/menumobile/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Menu Mobile\"><i class=\"fa fa-gear\"></i> Menu Mobile</button>";
                    result += "<button href=\"" + __base_url + "admin/master/usertype/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    result += "<button href=\"" + __base_url + "admin/master/usertype/delete/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-danger btn-delete btn-xs\" title=\"Delete\"><i class=\"fa fa-minus\"></i> Delete</button>";
                    return result;
                }
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


    var privilegeForm = '#privilegeForm';
    $(document).on('click', privilegeForm + ' .btn-saveprivilege', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(privilegeForm).serializeArray());
        var btn = $(this)
        var menu_id = [];
        $(privilegeForm + ' input[name="action[]"]').each(function() {
            if($(this).is(':checked')){
                menu_id.push($(this).val());
            }
        });

        value.menu_id_detail = menu_id.join(',');

        $.ajax({
            url: $(privilegeForm).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(privilegeForm).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
            },
            error: function(e) {
                Main.autoSetError(form, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click', '.parent', function(e) {
        if ($(this).is(':checked')) {
            $(this).parents('.root').find('input[name="action[]"]').prop('checked', true);
        } else {
            $(this).parents('.root').find('input[name="action[]"]').prop('checked', false);
        }
    })

    $(document).on('click', '.children', function(e) {
            if ($(this).is(':checked')) {
                $(this).parents('.menu').find('input[name="action[]"]').prop('checked', true);
            } else {
                $(this).parents('.menu').find('input[name="action[]"]').prop('checked', false);
            }
    })



    var formmenumobile = '.menumobile';
    $(document).on('click', formmenumobile + ' .btn-save', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(formmenumobile).serializeArray());

        var menu_mobile = [];
        $('input[name="menu_mobile"]:checked').each(function () {
            menu_mobile.push($(this).val());
        })
        value.menu_mobile = menu_mobile.join(',');
        $.ajax({
            url: $(formmenumobile).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(formmenumobile).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(formmenumobile, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

});
</script>