<style>
.sortable {}

.group-caption {
    background: #D3CAAF;
    width: 400px;
    display: block;
    padding: 5px;
    margin: 0 0 15px 0;
}

.group-item {
    background: #5E5E5E;
    width: 300px;
    /* height: 30px; */
    display: block;
    padding: 3px;
    margin: 5px;
    color: #fff;
    font-size: 10px;
}

.move {
    background: #ff0000;
    width: 30px;
    /* height: 30px; */
    float: right;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    /* line-height: 30px; */
    font-family: Arial;
    cursor: move;
}

.movable-placeholder {
    background: #ccc;
    width: 400px;
    height: 100px;
    display: block;
    padding: 3px;
    margin: 0 0 15px 0;
    border-style: dashed;
    border-width: 2px;
    border-color: #000;
}
</style>

<form id="reorderForm" method="post" action="<?=base_url('api/master/menu/'.$action); ?>" class="form-horizontal" style="text-align: -webkit-center;">
    <div class="row">
        <div class="col-xs-12">
            <div class="sortable">
                <!-- <div class="group-caption">
                    <h4>---</h4>
                    <input type="hidden" name="menu_id[]" value="1">
                    <div class="move">+</div>
                    <div class="group-items ui-sortable">
                        <div class="group-item">
                            <input type="hidden" name="menu_id[]" value="1"> Menu <div class="move">+</div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3"></label>
            <div class="col-md-9">
                <button class="btn btn-primary btn-save">Submit</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    


    $.when(
        $.ajax({
            url: __base_url + "api/data/menuread",
            data: {
                is_active: 1,
                where: ' parent_id is not null ',
                limit: '-1',
                order_by : " order by amn.order ",
            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                
                var root = [];
                var menu = [];
                $.each(data.data, function(i, value) {
                    if (value.parent_id == 0) {
                        root.push(value);
                    } else {
                        menu.push(value);
                    }
                });

                var result = [];
                $.each(root, function(i, valueroot) {
                    var rest = [];
                    $.each(menu, function(j, valuemenu) {
                        if(valueroot.id==valuemenu.parent_id){
                            rest.push(valuemenu);
                        }
                    })
                    result.push({
                        menu_id : valueroot.id,
                        parent_id: valueroot.parent_id,
                        name : valueroot.name,
                        label : valueroot.label,
                        default_url : valueroot.default_url,
                        childrens : rest,
                    })
                })

                
                $.each(result, function(i, value) {
                    // console.log(value);

                    var item = []
                    $.each(value.childrens,function(j,valueitem) {
                        // console.log(valueitem);
                        
                        item.push('\n\
                            <div class="group-item">\n\
                                <input type="hidden" name="menu_id[]" value="'+valueitem.id+'"> '+valueitem.label+' <div class="move">+</div>\n\
                            </div>\n\
                        ');
                    })

                    $('.sortable').append('\n\
                        <div class="group-caption">\n\
                            <h6>'+value.label+'</h6>\n\
                            <input type="hidden" name="menu_id[]" value="'+value.menu_id+'">\n\
                            <div class="move">+</div>\n\
                            <div class="group-items ui-sortable">\n\
                                '+ item.join('') +'\n\
                            </div>\n\
                        </div>\n\
                    ');
                });

                setTimeout(() => {
                    // Sort the parents
                    $(".sortable").sortable({
                        containment: "parent",
                        items: "> div",
                        handle: ".move",
                        tolerance: "pointer",
                        cursor: "move",
                        opacity: 0.7,
                        revert: 300,
                        delay: 150,
                        dropOnEmpty: true,
                        placeholder: "movable-placeholder",
                        start: function(e, ui) {
                            ui.placeholder.height(ui.helper.outerHeight());
                        }
                    });

                    // Sort the children
                    $(".group-items").sortable({
                        containment: "document",
                        items: "> div",
                        connectWith: '.group-items'
                    });
                }, 500);
                
            }
        }),
    ).done(function(root) {
        // console.log(root);

    });



})
</script>