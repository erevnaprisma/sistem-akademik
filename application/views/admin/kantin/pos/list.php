<h2 class="page-header">Pilih Toko</h2>
<div class="row" id="list">
    
</div>


<script>
$(document).ready(function() {
    var x= localStorage.getItem("currentUser");
    console.log(JSON.parse(x)[0]);
    var form = '#outletForm';

    function getOutlet() {
        $.ajax({
            url: __base_url + "api/kantin/outlet/read",
            data: {
                id_user : JSON.parse(x)[0].id,
                user_type : JSON.parse(x)[0].user_type_name,
                id_skl: JSON.parse(Main.getselectedSchool()).join(','),

            },
            method: "POST",
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            beforeSend: function(data) {},
            success: function(data) {
                //console.log(JSON.parse(data));
                // var data = JSON.parse(data.data)
                $.each(data.data, function(i, value) {
                    var datas = '<div class="col-md-4">'+
          '<div class="box box-widget widget-user">'+
            '<div class="widget-user-header bg-black" style="background: url(\''+__base_url+'assets/img/toko/'+value.foto+'\') center center;">'+
              '<h3 class="widget-user-username">'+value.nama_toko+'</h3>'+
              //'<h5 class="widget-user-desc">Web Designer</h5>
            '</div>'+
            '<div class="box-footer">'+
              '<div class="row">'+
                '<div class="col-sm-4 border-right">'+
                  '<div class="description-block">'+
                    '<h5 class="description-header"></h5>'+
                    '<span class="description-text"><pre>&nbsp;</pre></span>'+
                  '</div>'+
                '</div>'+
                '<div class="col-sm-4 border-right">'+
                  '<div class="description-block">'+
                    '<h5 class="description-header"></h5>'+
                    '<span class="description-text"><a href="'+__base_url+'admin/kantin/pos/listing/'+value.id+'">Belanja Sekarang</a></span>'+
                  '</div>'+
                '</div>'+
                '<div class="col-sm-4">'+
                  '<div class="description-block">'+
                    '<h5 class="description-header"></h5>'+
                    '<span class="description-text"><pre>&nbsp;</pre></span>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>'+
        '</div>';
                    //console.log(value);
                    $("#list").append(datas);
                    //$(form + ' select[name="id_user"]').append($('<option>').text(value
                        //.name).attr('value', value.id));                    
                });
            }
        })
    }

    $.when(
        getOutlet()
    ).done(function(usertype) {
        setTimeout(() => {
            //getDatabyId()
        }, 300);
    })


});
</script>