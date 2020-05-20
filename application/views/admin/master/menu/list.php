<table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Parent</th>
            <th>Name</th>
            <th>Label</th>
            <th>Default URL</th>
            <th>Icon</th>
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
    var form = '#menuForm';

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
                b.attr('href', __base_url + 'admin/master/menu/create');
                b.attr('title', 'CREATE');
            },
        },{
            text: "Reorder",
            className: "btn btn-create btn-warning fa fa-plus",
            init: function(a, b, c) {
                b.attr('href', __base_url + 'admin/master/menu/reorder');
                b.attr('title', 'REORDER');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/master/menu/json",
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
                "data": "parent_name"
            },
            {
                "data": "name"
            },
            {
                "data": "label"
            },
            {
                "data": "default_url"
            },
            {
                "data": "icon"
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
                    result += "<button href=\"" + __base_url + "admin/master/menu/read/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                    result += "<button href=\"" + __base_url + "admin/master/menu/action/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-primary btn-update btn-xs\" title=\"Action\"><i class=\"fa fa-conf\"></i> Action</button>";
                    result += "<button href=\"" + __base_url + "admin/master/menu/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    result += "<button href=\"" + __base_url + "admin/master/menu/delete/" +
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


    var actionForm = '#actionForm';
    var menuActionForm = '#menuActionForm';
    var reorderForm = '#reorderForm';
    $(document).on('click', actionForm + ' .btn-saveadd', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(actionForm).serializeArray());
        value.is_active = $(actionForm + ' input[name="is_active"]').val();
        $.ajax({
            url: $(actionForm).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(actionForm).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $(menuActionForm + ' tbody').append($('<tr>')
                    .append($('<td>').append(parseInt($(menuActionForm + ' tbody tr')
                        .length) + 1))
                    .append($('<td>').append('<input name="name" value="' +
                        value.name + '" class="form-control">'))
                    .append($('<td>').append('<input name="default_url" value="' +
                        value.default_url +
                        '" class="form-control">'))
                    .append($('<td>').append(
                        '<input type="checkbox" name="is_active" value="' +
                        value.is_active + '" class="" ' + (value
                            .is_active == 1 ? 'checked' : '') + '> YES'))
                    .append($('<td>').append(
                        '<button data-id="' + data.data +
                        '" class="btn btn-xs btn-warning btn-saveupdate">Submit</button>' +
                        '<button data-id="' + data.data +
                        '" class="btn btn-xs btn-danger btn-savedelete">Delete</button>'
                    ))
                )
            },
            error: function(e) {
                Main.autoSetError(actionForm, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click', menuActionForm + ' .btn-saveupdate', function(e) {
        e.preventDefault();
        var btn = $(this)
        var tr = btn.parents('tr')
        var value = {
            id: btn.attr('data-id'),
            name: tr.find('input[name="name"]').val(),
            default_url: tr.find('input[name="default_url"]').val(),
            is_active: tr.find('input[name="is_active"]').val(),
        }
        $.ajax({
            url: __base_url + 'api/master/menu/updateaction',
            data: {
                data: JSON.stringify([value])
            },
            method: 'POST',
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {

            },
            error: function(e) {
                var value = e.responseJSON.error;
                var tr = btn.parents("tr");
                tr.find('input').each(function() {
                    console.log(value)
                    for (var key in value) {
                        console.log(key, $(this).attr('name'))
                        if (key == $(this).attr('name')) {
                            $(this).parent().addClass('has-error');
                        }
                    }
                    if (!tr.hasClass('has-error')) {
                        tr.addClass('has-success');
                    }
                })
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click', menuActionForm + ' .btn-savedelete', function(e) {
        e.preventDefault();
        var btn = $(this)
        var tr = btn.parents('tr')
        
        tr.remove();

        var value = {
            id: btn.attr('data-id'),
            name: tr.find('input[name="name"]').val(),
            default_url: tr.find('input[name="default_url"]').val(),
            is_active: 9,
        }
        $.ajax({
            url: __base_url + 'api/master/menu/updateaction',
            data: {
                data: JSON.stringify([value])
            },
            method: 'POST',
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {

            },
            error: function(e) {
                var value = e.responseJSON.error;
                var tr = btn.parents("tr");
                tr.find('input').each(function() {
                    console.log(value)
                    for (var key in value) {
                        console.log(key, $(this).attr('name'))
                        if (key == $(this).attr('name')) {
                            $(this).parent().addClass('has-error');
                        }
                    }
                    if (!tr.hasClass('has-error')) {
                        tr.addClass('has-success');
                    }
                })
            },
            complete: function(e) {

            }
        });
    })



    $(document).on('click', reorderForm + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this);
        var menu_id = [];
        $(reorderForm + ' input[name="menu_id[]"]').each(function(){
            menu_id.push($(this).val());
        });
        var value = {
            menu_id:menu_id.join(',')
        };
        console.log(value)
        $.ajax({
            url: __base_url + 'api/master/menu/reorder',
            method: 'POST',
            data: {
                data: JSON.stringify([value])
            },
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
                $('#mytable').DataTable().ajax.reload(null, false);
            },
            error: function(e) {

            },
            complete: function(e) {

            }
        });

    })

});
</script>