<style>
.panel {
    background-color: unset;
}
.calendar .month-container {
    height: unset;
}
</style>

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <!-- <div class="small-box bg-info">
            <div class="inner">
                <h3 class="count_skl">0</h3>
                <p>Jumlah Sekolah</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="https://adminlte.io/themes/dev/AdminLTE/index.html#" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div> -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3 class="count_jurusan">0</h3>
                <p>Jumlah Jurusan</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="<?= base_url('admin/akademik/jurusan/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3 class="count_kelas">
                    0
                    <!-- <sup style="font-size: 20px">%</sup> -->
                </h3>
                <p>Jumlah Kelas</p>
            </div>
            <div class="icon">
                <i class="fa fa-building-o"></i>
            </div>
            <a href="<?= base_url('admin/akademik/kelas/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 class="count_guru">0</h3>
                <p>Jumlah Guru</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/akademik/guru/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 class="count_siswa">0</h3>
                <p>Jumlah Siswa</p>
            </div>
            <div class="icon">
                <i class="fa fa-child"></i>
            </div>
            <a href="<?= base_url('admin/akademik/siswa/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->






    
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 class="count_absensi_karyawan">0</h3>
                <p>Absensi Karyawan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/akademik/siswa/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 class="count_absensi_siswa">0</h3>
                <p>Absensi Siswa Hari Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/akademik/siswa/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3 class="count_prestasi_siswa">0</h3>
                <p>Prestasi Siswa</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/kesiswaan/prestasi_siswa/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3 class="count_pelanggaran_siswa">0</h3>
                <p>Pelanggaran Siswa</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/kesiswaan/pelanggaran_siswa/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->




    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 class="count_kata_motivasi">0</h3>
                <p>Kata Mutiara</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/forum/katamotivasi/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 class="count_forum_guru">0</h3>
                <p>Forum Guru</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/forum/guru/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3 class="count_forum_siswa">0</h3>
                <p>Forum Siswa</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/forum/siswa/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3 class="count_forum_orangtua">0</h3>
                <p>Forum Orangtua</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= base_url('admin/forum/orangtua/index')?>" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    
</div>
<!-- /.row -->

<!-- <div class="row">
    <section class="col-xs-12 connectedSortable ui-sortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">List Forum</h3>
            </div>
            <div class="box-body">
                <table id="mytableTodo" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Todo</th>
                            <th>Is Active</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div> -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-xs-12 connectedSortable ui-sortable">
        <!-- Calendar -->
        <div class="box box-solid bg-blue-gradient">
            <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Kalendar Pendidikan</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse"><i
                            class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove"><i
                            class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <?php /* <div class="box-footer text-black">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Progress bars -->
                        <div class="clearfix">
                            <span class="pull-left">Task #1</span>
                            <small class="pull-right">90%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Task #2</span>
                            <small class="pull-right">70%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="clearfix">
                            <span class="pull-left">Task #3</span>
                            <small class="pull-right">60%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Task #4</span>
                            <small class="pull-right">40%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            */ ?>
        </div>
    </section>
    <!-- /.box -->
    
</div>
<!-- /.row (main row) -->
</div>

<script>
$(document).ready(function() {

    // $('#calendar').fullCalendar({
    //     locale: 'id'
    // });

    $(document).ready(function() {
        var currentYear = new Date().getFullYear();
        var calendar = $('#calendar').calendar({
            language: 'id',
            style: 'custom',
            customDataSourceRenderer: function(element, date, event) {
                // This will override the background-color to the event's color
                $(element).css('background-color', 'red');
                // $(element).css('border-radius', '15px');
            },
            mouseOnDay: function(e) {
                if (e.events.length > 0) {
                    var content = '';

                    for (var i in e.events) {
                        content += '<div class="event-tooltip-content">' +
                            '<div class="event-name" style="color:' + e.events[i].color +
                            '">' + e
                            .events[i].name + '</div>' +
                            // '<div class="event-location">' + e.events[i].location + '</div>' +
                            '</div>';
                    }

                    $(e.element).popover({
                        trigger: 'manual',
                        container: 'body',
                        html: true,
                        content: content
                    });

                    $(e.element).popover('show');
                }
            },
            mouseOutDay: function(e) {
                if (e.events.length > 0) {
                    $(e.element).popover('hide');
                }
            },
        });

        $(document).on('click', '.calendar-header', function() {
            // setTimeout(() => {
            getyear($('#calendar').data('calendar').getYear());
            // }, 300);
        })


        // var currentYear = new Date().getFullYear();

        function getyear(year) {
            $.ajax({
                url: __base_url + "api/data/kalenderjson/" + year,
                method: 'POST',
                success: function(data) {
                    var kalender = [];
                    $.each(data, function(i, value) {
                        kalender.push({
                            id: i,
                            name: value.keterangan,
                            location: value.keterangan,
                            startDate: moment(value.tanggal),
                            endDate: moment(value.tanggal),
                        })
                    })
                    console.log(kalender);


                    $('#calendar').data('calendar').setDataSource(kalender);
                }
            });
        }

        getyear(new Date().getFullYear());


    })

    $.ajax({
        url: __base_url + 'admin/home/getdashboard',
        data: {
            data: JSON.stringify([{
                id_skl: JSON.parse(Main.getselectedSchool()).join(','),
            }])
        },
        method: "POST",
        headers: {
            'Authorization': localStorage.getItem("token")
        },
        success: function(data) {
            $('.count_skl').text(data.count_skl)
            $('.count_jurusan').text(data.count_jurusan)
            $('.count_kelas').text(data.count_kelas)
            $('.count_guru').text(data.count_guru)
            $('.count_siswa').text(data.count_siswa)

            $('.count_absensi_karyawan').text(data.count_absensi_karyawan)
            $('.count_absensi_siswa').text(data.count_absensi_siswa)
            $('.count_prestasi_siswa').text(data.count_prestasi_siswa)
            $('.count_pelanggaran_siswa').text(data.count_pelanggaran_siswa)
            
            $('.count_forum_guru').text(data.count_forum_guru)
            $('.count_forum_siswa').text(data.count_forum_siswa)
            $('.count_forum_orangtua').text(data.count_forum_orangtua)
            $('.count_kata_motivasi').text(data.count_kata_motivasi)
        },
        error: function(e) {

        },
        complete: function(e) {

        }
    });



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
    $('#mytableTodo').DataTable({
        dom: "lBfrtip",
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
        buttons: [{
            text: "Create",
            className: "btn btn-create btn-success fa fa-plus",
            init: function(a, b, c) {
                b.attr('href', __base_url + 'admin/dashboard/todo/create');
                b.attr('title', 'CREATE');
            },
        }, ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": __base_url + "api/dashboard/todo/json",
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
                var dt_params = $('#mytableTodo').data('dt_params');
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
                "data": "todo"
            },
            // {
            //     "data": "status"
            // },
            {
                "data": "is_active_name"
            },
            {
                "data": "created_dt"
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row, data, iDisplayIndex) {
                    var result = "";
                    // result += "<button href=\"" + __base_url + "admin/dashboard/todo/read/" +
                    //     iDisplayIndex.id +
                    //     "\" class=\"btn btn-info btn-read btn-xs\" title=\"Read\"><i class=\"fa fa-eye\"></i> Read</button>";
                    result += "<button href=\"" + __base_url + "admin/dashboard/todo/update/" +
                        iDisplayIndex.id +
                        "\" class=\"btn btn-warning btn-update btn-xs\" title=\"Update\"><i class=\"fa fa-pencil\"></i> Update</button>";
                    result += "<button href=\"" + __base_url + "admin/dashboard/todo/delete/" +
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
            $('#mytableTodo_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });

        },
    });
    var todoform = '#todoForm';
    $(document).on('click', todoform + ' .btn-save', function(e) {
        e.preventDefault();
        var btn = $(this)
        var value = Main.objectifyForm($(todoform).serializeArray());
        value.is_active = $(todoform + ' input[name="is_active"]').val();
        $.ajax({
            url: $(todoform).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(todoform).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                $('#myModal button.close').trigger('click');
                $('#mytableTodo').DataTable().ajax.reload(null, false);
            },
            error: function(e) {
                Main.autoSetError(todoform, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })
})
</script>