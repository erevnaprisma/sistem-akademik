<form id="actionForm" method="post" action="<?=base_url('api/master/menu/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3"> Name</label>
        <div class="col-md-9">
            <input type="text" name="name" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Default URL</label>
        <div class="col-md-9">
            <input type="text" name="default_url" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3">Is Active</label>
        <div class="col-md-9">
            <input type="checkbox" name="is_active">
            Yes
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-saveadd">Submit</button>
        </div>
    </div>
</form>
<table id="menuActionForm" class="table table-bordered">
    <thead>
        <tr>
            <th width="50px">No</th>
            <th>Action</th>
            <th>Default URL</th>
            <th>Is Active</th>
            <th width="50px">Action</th>
        </tr>
    </thead>
    <tbody>

        <script>
        $(document).ready(function() {
            var form = '#menuActionForm';

            function getDatabyId() {
                var id = '<?=$id; ?>';
                if (id) {
                    $.ajax({
                        url: __base_url + "api/master/menu/read",
                        data: {
                            menu_id: id,
                        },
                        method: "POST",
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        beforeSend: function(data) {},
                        success: function(data) {

                            $.each(data.data, function(i, value) {
                                if (value.is_active != 9) {
                                    $(form + ' tbody').append($('<tr>')
                                        .append($('<td>').append(i + 1))
                                        .append($('<td>').append(
                                            '<input name="name" value="' +
                                            value.name + '" class="form-control">'))
                                        .append($('<td>').append(
                                            '<input name="default_url" value="' +
                                            value.default_url +
                                            '" class="form-control">'))
                                        .append($('<td>').append(
                                            '<input type="checkbox" name="is_active" value="' +
                                            value.is_active + '" class="" ' + (value
                                                .is_active == 1 ? 'checked' : '') +
                                            '> YES'))
                                        .append($('<td>').append(
                                            '<button data-id="' + value.id +
                                            '" class="btn btn-xs btn-warning btn-saveupdate">Submit</button>' +
                                            '<button data-id="' + value.id +
                                            '" class="btn btn-xs btn-danger btn-savedelete">Delete</button>'
                                        ))
                                    )
                                }

                            })

                        }
                    })
                }
            }
            getDatabyId();

        })