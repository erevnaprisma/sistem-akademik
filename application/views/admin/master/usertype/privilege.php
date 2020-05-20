<style>
.menu {
    padding-left: 20px;
}

.labelmenu {
    margin-left: 15px;
    /* width: 100px; */
}
.action {
    padding-left: 30px;
    /* float:left; */
}

#privilegeForm .col-sm-1 {
    width: 125px;
}

#privilegeForm .root {
    border: 1px solid #ccc;
}
</style>
<div class="row" style="padding:20px;">
    <form id="privilegeForm" method="post" action="<?=base_url('api/master/usertype/'.$action); ?>" class="form-horizontal">
        <div class="col-xs-12">
            <input type="hidden" name="id" value="<?=$id; ?>">
            <div class="form-group actionselect">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-saveprivilege">Submit</button>
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {

    var form = '#privilegeForm';


    function getMenu() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/master/menu/read",
                data: {
                    limit: -1
                },
                method: "POST",
                headers: {
                    'Authorization': localStorage.getItem("token")
                },
                beforeSend: function(data) {},
                success: function(data) {
                    var parent = [];
                    var menu = [];
                    var action = [];
                    $.each(data.data, function(i, value) {
                        if (value.parent_id == 0) {
                            parent.push(value);
                        }
                        if (value.parent_id) {
                            menu.push(value);
                        }
                        if (value.menu_id) {
                            action.push(value);
                        }
                    })
                    $.each(parent, function(i, value) {
                        $(form + " .actionselect").append('<div id="parent' + value.id +
                            '" class="root"><input class="parent" type="checkbox" name="action[]" value="' +
                            value.id + '"> <label>' + value.label + '</label></div>')
                    });
                    $.each(menu, function(i, value) {
                        $(form + " #parent" + value.parent_id).append('<div id="menu' +
                            value.id +
                            '" class="menu row"><div class="labelmenu"><input class="children" type="checkbox" name="action[]" value="' +
                            value.id + '"> <label>' +
                            value.label + '</label></div></div>')
                    });
                    $.each(action, function(i, value) {
                        $(form + " #menu" + value.menu_id).append(
                            '<div class="col-sm-1"><div class="action"><input type="checkbox" name="action[]" value="' +
                            value.id + '"> <label>' +
                            value.name + '</label></div></div>')
                    });

                    setTimeout(() => {
                        getDatabyId();
                    }, 3000);
                }
            })
        }
    }

    function getDatabyId() {
        var id = $(form + ' input[name="id"]').val();
        if (id) {
            $.ajax({
                url: __base_url + "api/master/usertype/read",
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
                        if (value.menu_id_detail) {
                            var menu_id = value.menu_id_detail.split(',');
                            console.log(menu_id)
                            $(form + ' input[name="action[]"]').each(function() {
                                if (jQuery.inArray($(this).val(), menu_id) > -1) {
                                    $(this).prop('checked', true);
                                }
                            });
                        }
                    })
                }
            })
        }
    }

    $.when(
        getMenu(),
    ).done(function(usertype) {
        
    })
})