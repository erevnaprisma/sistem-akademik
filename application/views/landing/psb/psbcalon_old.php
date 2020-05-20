<style>
.widget-user-image i {
    position: absolute;
    left: 20px;
}

.fotosiswa,
.fotoayah,
.fotoibu {
    cursor: pointer;
}

.widget-user-2 .widget-user-image>img {
    width: 65px !important;
    height: 65px !important;
}

.sr-only {
    position: unset;
}
</style>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Status Pengisian</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="progress pdataibu" style="display:none;">
            <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100" style="width: 100%">
                <span class="sr-only">100% Complete (success)</span>
            </div>
        </div>
        <div class="progress pdataayah" style="display:none;">
            <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100" style="width: 75%">
                <span class="sr-only">75% Complete</span>
            </div>
        </div>
        <div class="progress pdatapribadi" style="display:none;">
            <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100" style="width: 50%">
                <span class="sr-only">50% Complete (warning)</span>
            </div>
        </div>
        <div class="progress pdatasiswa" style="display:none;">
            <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100" style="width: 25%">
                <span class="sr-only">25% Complete</span>
            </div>
        </div>
        <div class="progress pnull">
            <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                aria-valuemax="100" style="width: 0%">
                <span class="sr-only">0% Complete</span>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<div class="row hidden">
    <div class="col-md-4">
        <div class="form-group">
            <label class="col-md-3">Foto Siswa</label>
            <div class="col-md-9">
                <form class="form-horizontal" enctype="multipart/form-data">
                    <input type="file" name="telp" class="form-control inputfotosiswa">
                </form>
                <span class="help-block"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="col-md-3">Foto Ayah</label>
            <div class="col-md-9">
                <input type="file" name="telp" class="form-control inputfotoayah">
                <span class="help-block"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="col-md-3">Foto Ibu</label>
            <div class="col-md-9">
                <input type="file" name="telp" class="form-control inputfotoibu">
                <span class="help-block"></span>
            </div>
        </div>
    </div>
</div>


<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Data Siswa</a></li>
        <li><a href="#tab_2" data-toggle="tab">Data Pribadi</a></li>
        <li><a href="#tab_3" data-toggle="tab">Data Ayah</a></li>
        <li><a href="#tab_4" data-toggle="tab">Data Ibu</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-red">
                    <div class="widget-user-image">
                        <img class="img-circle fotosiswa" src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar5.png')?>"
                            alt="User Avatar">
                        <i class="fa fa-camera"></i>
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Nama Siswa</h3>
                    <h5 class="widget-user-desc">Pelajar</h5>
                </div>
                <div class="box-footer no-padding">
                    <form class="form-horizontal datasiswa" enctype="multipart/form-data"
                        action="<?= base_url('api/data/siswa_create'); ?>" method="post" style="padding:5px;">
                        <input type="hidden" name="id" value="<?= $id?>">
                        <input type="hidden" name="id_skl" value="<?= $sekolah->id_skl ?>">

                        <div class="form-group">
                            <label class="col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama_siswa" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">No Induk</label>
                            <div class="col-md-9">
                                <input name="no_induk" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">NISN</label>
                            <div class="col-md-9">
                                <input name="nisn" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Kelamin</label>
                            <div class="col-md-9">
                                <select name="jk" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Angkatan</label>
                            <div class="col-md-9">
                                <input name="angkatan" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">No HP</label>
                            <div class="col-md-9">
                                <input name="hp_siswa" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">No HP Ortu</label>
                            <div class="col-md-9">
                                <input name="hp_ortu_1" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">No HP Ortu 2</label>
                            <div class="col-md-9">
                                <input name="hp_ortu_2" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Email Ortu</label>
                            <div class="col-md-9">
                                <input name="email_ortu_1" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Email Ortu 2</label>
                            <div class="col-md-9">
                                <input name="email_ortu_2" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3"></label>
                            <div class="col-md-9">
                                <button class="btn btn-primary btn-save">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                        <img class="img-circle fotosiswa" src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar5.png')?>"
                            alt="User Avatar">
                        <i class="fa fa-camera"></i>
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Nama Siswa</h3>
                    <h5 class="widget-user-desc">Pelajar</h5>
                </div>
                <div class="box-footer no-padding">
                    <form class="form-horizontal datapribadi" enctype="multipart/form-data"
                        action="<?= base_url('api/data/datapribadi_create'); ?>" method="post" style="padding:5px;">
                        <input type="hidden" name="id" value="">

                        <div class="form-group">
                            <label class="col-md-3">Nama Panggilan</label>
                            <div class="col-md-9">
                                <input name="nm_panggilan" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tempat Lahir</label>
                            <div class="col-md-9">
                                <input name="tmp_lahir" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <div class="input-group date onlydatepicker">
                                    <input name="tgl_lhr" class="form-control">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Agama</label>
                            <div class="col-md-9">
                                <select name="id_agm" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Kewarganegaraan</label>
                            <div class="col-md-9">
                                <input name="wrg" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Suku</label>
                            <div class="col-md-9">
                                <input name="suku" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Golongan Darah</label>
                            <div class="col-md-9">
                                <select name="id_goldar" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tinggi</label>
                            <div class="col-md-9">
                                <input name="tinggi" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Berat</label>
                            <div class="col-md-9">
                                <input name="berat" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">UK. Baju</label>
                            <div class="col-md-9">
                                <input name="uk_baju" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">UK. Sepatu</label>
                            <div class="col-md-9">
                                <input name="uk_spt" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="alamat" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3">Telpon</label>
                            <div class="col-md-9">
                                <input name="telp" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tinggal Dengan</label>
                            <div class="col-md-9">
                                <select name="id_sta_t_dgn" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3">Tinggal Dengan Lainnya</label>
                            <div class="col-md-9">
                                <input name="sta_t_dgn_lain" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Status Rumah</label>
                            <div class="col-md-9">
                                <select name="id_tem_t_dgn" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3">Status Rumah Lainnya</label>
                            <div class="col-md-9">
                                <input name="tem_t_dgn_lain" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Jarak Rumah</label>
                            <div class="col-md-9">
                                <select name="id_jrk_rmh" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3">Jarak Rumah Lainnya</label>
                            <div class="col-md-9">
                                <input name="jrk_rmh_lain" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Transportasi</label>
                            <div class="col-md-9">
                                <select name="id_trn_rmh" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3">Transportasi Lainnya</label>
                            <div class="col-md-9">
                                <input name="trn_rmh_lain" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Status Anak</label>
                            <div class="col-md-9">
                                <input name="status_anak" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Anak ke </label>
                            <div class="col-md-9">
                                <input name="ank_ke" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Dari</label>
                            <div class="col-md-9">
                                <input name="dari" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Jumlah Saudara Kandung</label>
                            <div class="col-md-9">
                                <input name="jml_sdr_kan" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Jumlah Saudara Tiri</label>
                            <div class="col-md-9">
                                <input name="jml_sdr_tir" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Jumlah Saudara Angkat</label>
                            <div class="col-md-9">
                                <input name="sdr_ang" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Pendidikan Dibiayai Oleh</label>
                            <div class="col-md-9">
                                <select name="pendidikan_oleh" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <!-- <input name="pendidikan_oleh" class="form-control"> -->
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Dibeasiswakan Oleh</label>
                            <div class="col-md-9">
                                <input name="beasiswa_oleh" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3"></label>
                            <div class="col-md-9">
                                <button class="btn btn-primary btn-save">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua">
                    <div class="widget-user-image">
                        <img class="img-circle fotoayah" src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar4.png')?>"
                            alt="User Avatar">
                        <i class="fa fa-camera"></i>
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Nama Ayah</h3>
                    <h5 class="widget-user-desc">Pekerjaan</h5>
                </div>
                <div class="box-footer no-padding">


                    <form class="form-horizontal dataayah" enctype="multipart/form-data"
                        action="<?= base_url('api/data/dataayah_create'); ?>" method="post" style="padding:5px;">
                        <input type="hidden" name="id" value="">

                        <div class="form-group">
                            <label class="col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nm_ayah" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Nama Panggilan</label>
                            <div class="col-md-9">
                                <input name="pg_ayah" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tempat Lahir</label>
                            <div class="col-md-9">
                                <input name="tmp_lhr_ayah" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <div class="input-group date onlydatepicker">
                                    <input name="tgl_lhr_ayah" class="form-control">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Agama</label>
                            <div class="col-md-9">
                                <select name="agm_ayah" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Kewarganegaraan</label>
                            <div class="col-md-9">
                                <input name="wrg_ayah" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Pendidikan Terakhir</label>
                            <div class="col-md-9">
                                <select name="id_pndd_ayah" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Sekolah Pendidikan Terakhir</label>
                            <div class="col-md-9">
                                <input name="pnddk_ayah" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Pekerjaan</label>
                            <div class="col-md-9">
                                <select name="id_pek_ayah" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3">Pekerjaan Lainnya</label>
                            <div class="col-md-9">
                                <input name="pek_ayah_lain" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <input name="jbt_ayah" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Gaji</label>
                            <div class="col-md-9">
                                <input name="gaji_ayah" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Alamat Kantor</label>
                            <div class="col-md-9">
                                <textarea name="almt_knt_ayah" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Alamat Rumah</label>
                            <div class="col-md-9">
                                <textarea name="almt_rmh_ayah" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Telpon</label>
                            <div class="col-md-9">
                                <input name="telp" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <textarea name="ket" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3"></label>
                            <div class="col-md-9">
                                <button class="btn btn-primary btn-save">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_4">

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-green">
                    <div class="widget-user-image">
                        <img class="img-circle fotoibu" src="<?= base_url('AdminLTE-2.4.10/dist/img/avatar2.png')?>"
                            alt="User Avatar">
                        <i class="fa fa-camera"></i>
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Nama Ibu</h3>
                    <h5 class="widget-user-desc">Pekerjaan</h5>
                </div>
                <div class="box-footer no-padding">
                    <form class="form-horizontal dataibu" enctype="multipart/form-data"
                        action="<?= base_url('api/data/dataibu_create'); ?>" method="post" style="padding:5px;">
                        <input type="hidden" name="id" value="">

                        <div class="form-group">
                            <label class="col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nm_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Nama Panggilan</label>
                            <div class="col-md-9">
                                <input name="pg_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tempat Lahir</label>
                            <div class="col-md-9">
                                <input name="tmp_lhr_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <div class="input-group date onlydatepicker">
                                    <input name="tgl_lhr_ibu" class="form-control">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Agama</label>
                            <div class="col-md-9">
                                <select name="agm_ibu" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Kewarganegaraan</label>
                            <div class="col-md-9">
                                <input name="wrg_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Pendidikan Terakhir</label>
                            <div class="col-md-9">
                                <select name="id_pndd_ibu" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Sekolah Pendidikan Terakhir</label>
                            <div class="col-md-9">
                                <input name="pndd_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Pekerjaan</label>
                            <div class="col-md-9">
                                <select name="id_pek_ibu" class="form-control chosen">
                                    <option value="">Select</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3">Pekerjaan Lainnya</label>
                            <div class="col-md-9">
                                <input name="pek_ibu_lain" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <input name="jbt_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Gaji</label>
                            <div class="col-md-9">
                                <input name="gaji_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Alamat Kantor Ayah</label>
                            <div class="col-md-9">
                                <textarea name="almt_knt_ibu" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Alamat Rumah Ayah</label>
                            <div class="col-md-9">
                                <textarea name="almt_rmh_ibu" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Telpon</label>
                            <div class="col-md-9">
                                <input name="telp_ibu" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <textarea name="ket_ibu" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3"></label>
                            <div class="col-md-9">
                                <button class="btn btn-primary btn-save">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<script>
$(document).ready(function() {
    Main.onlydatepicker();
    var form = 'form';
    var datasiswa = '.datasiswa';
    var datapribadi = '.datapribadi';
    var dataayah = '.dataayah';
    var dataibu = '.dataibu';

    $.when(
        Data.getJK(form, ' select[name="jk"]'),
        Data.getAgama(form, ' select[name="id_agm"]'),
        Data.getAgama(form, ' select[name="agm_ayah"]'),
        Data.getAgama(form, ' select[name="agm_ibu"]'),
        Data.getGoldar(form, ' select[name="id_goldar"]'),
        Data.getTempattinggal(form, ' select[name="id_tem_t_dgn"]'),
        Data.getStatustinggal(form, ' select[name="id_sta_t_dgn"]'),
        Data.getTransportasirumah(form, ' select[name="id_trn_rmh"]'),
        Data.getJarakrumah(form, ' select[name="id_jrk_rmh"]'),
        Data.getDibiayaioleh(form, ' select[name="pendidikan_oleh"]'),
        Data.getPendidikanterakhir(form, ' select[name="id_pndd_ayah"]'),
        Data.getPendidikanterakhir(form, ' select[name="id_pndd_ibu"]'),
        Data.getPekerjaan(form, ' select[name="id_pek_ayah"]'),
        Data.getPekerjaan(form, ' select[name="id_pek_ibu"]'),
    ).done(function(usertype) {
        setTimeout(() => {
            // Main.chosen();


            $('select[name="id_sta_t_dgn"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_tem_t_dgn"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_jrk_rmh"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_trn_rmh"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_pek_ayah"]').append($('<option>').text('Lainnya').attr('value',
                0));
            $('select[name="id_pek_ibu"]').append($('<option>').text('Lainnya').attr('value',
                0));

            getDatabyId();
        }, 1000);
    })

    function getDatabyId() {
        var id = $(datasiswa + ' input[name="id"]').val();
        if (id) {
            // untuk data siswa
            $.ajax({
                url: __base_url + "api/data/siswadetailread",
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
                        Main.autoSetValue(datasiswa, value)
                        $('.widget-user-2 .bg-red .widget-user-username').text(value
                            .nama_siswa);

                        if (value.foto) {
                            $('.fotosiswa').attr('src', __base_url + __path_image +
                                'user/' + value.foto);
                        }

                    });
                    progressbar()
                    showhide()

                    // untuk data pribadi
                    $.ajax({
                        url: __base_url + "api/data/datapribadidetailread",
                        data: {
                            id_siswa: id
                        },
                        method: "POST",
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        beforeSend: function(data) {},
                        success: function(data) {
                            $.each(data.data, function(i, value) {
                                Main.autoSetValue(datapribadi, value)
                                $('.widget-user-2 .bg-yellow .widget-user-username')
                                    .text(value
                                        .nama_siswa);

                                if (value.tgl_lhr != "0000-00-00") {
                                    setTimeout(() => {
                                        $('input[name="tgl_lhr"]').val(
                                            value.tgl_lhr_name);
                                    }, 500);
                                }
                            });
                            progressbar()
                            showhide()
                        }
                    })

                    // untuk data orangtua
                    $.ajax({
                        url: __base_url + "api/data/dataayahibudetailread",
                        data: {
                            id_siswa: id
                        },
                        method: "POST",
                        headers: {
                            'Authorization': localStorage.getItem("token")
                        },
                        beforeSend: function(data) {},
                        success: function(data) {
                            $.each(data.data, function(i, value) {
                                Main.autoSetValue(dataayah, value)
                                Main.autoSetValue(dataibu, value)

                                if (value.foto_ayah) {
                                    $('.fotoayah').attr('src', __base_url +
                                        __path_image + 'user/' + value
                                        .foto_ayah);
                                }
                                if (value.foto_ibu) {
                                    $('.fotoibu').attr('src', __base_url +
                                        __path_image + 'user/' + value
                                        .foto_ibu);
                                }
                                setTimeout(() => {
                                    if (value.nm_ayah) {
                                        $('.widget-user-2 .bg-aqua .widget-user-username')
                                            .text(value
                                                .nm_ayah);
                                        $('.widget-user-2 .bg-aqua .widget-user-desc')
                                            .text($(
                                                    'select[name="id_pek_ayah"] option:selected'
                                                )
                                                .text());
                                    }
                                    if (value.nm_ibu) {
                                        $('.widget-user-2 .bg-green .widget-user-username')
                                            .text(value
                                                .nm_ibu);
                                        $('.widget-user-2 .bg-green .widget-user-desc')
                                            .text($(
                                                    'select[name="id_pek_ibu"] option:selected'
                                                )
                                                .text());
                                        $('.progress').hide()
                                        $('.pdataibu').show()
                                    }

                                    if (value.tgl_lhr_ayah != "0000-00-00") {
                                            $('input[name="tgl_lhr_ayah"]')
                                                .val(
                                                    value
                                                    .tgl_lhr_ayah_name
                                                    );
                                    }
                                    if (value.tgl_lhr_ibu != "0000-00-00") {
                                            $('input[name="tgl_lhr_ibu"]')
                                                .val(
                                                    value
                                                    .tgl_lhr_ibu_name
                                                    );
                                    }
                                }, 500);
                            });
                            progressbar()
                            showhide();
                        }
                    })
                }
            })


        }
    }


    $(document).on('click', '.fotosiswa', function(e) {
        e.preventDefault();
        $('.inputfotosiswa').trigger('click')
    })
    $(document).on('change', '.inputfotosiswa', function(event) {
        Main.previewimage(this, $('.fotosiswa'));
    });

    $(document).on('click', '.fotoayah', function(e) {
        e.preventDefault();
        $('.inputfotoayah').trigger('click')
    })
    $(document).on('change', '.inputfotoayah', function(event) {
        Main.previewimage(this, $('.fotoayah'));
    });

    $(document).on('click', '.fotoibu', function(e) {
        e.preventDefault();
        $('.inputfotoibu').trigger('click')
    })
    $(document).on('change', '.inputfotoibu', function(event) {
        Main.previewimage(this, $('.fotoibu'));
    });


    function progressbar() {
        $('.progress').hide()
        if ($('input[name="nm_ibu"]').val()) {
            $('.pdataibu').show();
        } else if ($('input[name="nm_ayah"]').val()) {
            $('.pdataayah').show();
        } else if ($('input[name="nm_panggilan"]').val()) {
            $('.pdatapribadi').show();
        } else if ($('input[name="nm_siswa"]').val()) {
            $('.pdatasiswa').show();
        } else {
            $('.pnull').show();
        }
    }

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





    // ayah
    $(document).on('keyup', 'input[name="nm_ayah"]', function(e) {
        e.preventDefault()
        $('.widget-user-2 .bg-aqua .widget-user-username').text($(this).val())
    })
    $(document).on('keyup', 'input[name="pek_ayah_lain"]', function(e) {
        e.preventDefault()
        $('.widget-user-2 .bg-aqua .widget-user-desc').text($(this).val())
    })
    $(document).on('change', 'select[name="id_pek_ayah"]', function(e) {
        $('.widget-user-2 .bg-aqua .widget-user-desc').text($(
            'select[name="id_pek_ayah"] option:selected').text())
        if ($(this).val() == 0) {
            $('input[name="pek_ayah_lain"]').parents('.form-group').show()
        } else {
            $('input[name="pek_ayah_lain"]').parents('.form-group').hide()
        }
    })

    // ibu
    $(document).on('keyup', 'input[name="nm_ibu"]', function(e) {
        e.preventDefault()
        $('.widget-user-2 .bg-green .widget-user-username').text($(this).val())
    })
    $(document).on('keyup', 'input[name="pek_ayah_lain"]', function(e) {
        e.preventDefault()
        $('.widget-user-2 .bg-green .widget-user-desc').text($(this).val())
    });
    $(document).on('change', 'select[name="id_pek_ibu"]', function(e) {
        $('.widget-user-2 .bg-green .widget-user-desc').text($(
            'select[name="id_pek_ibu"] option:selected').text())
        if ($(this).val() == 0) {
            $('input[name="pek_ibu_lain"]').parents('.form-group').show()
        } else {
            $('input[name="pek_ibu_lain"]').parents('.form-group').hide()
        }
    })


    $(document).on('click', '.datasiswa .btn-save', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(datasiswa).serializeArray());
        value.is_active = $(datasiswa + ' input[name="is_active"]').val();
        value.foto = $('.fotosiswa').attr('src');
        // console.log(value.foto.indexOf(__base_url))
        if (value.foto.indexOf(__base_url) != -1) {
            delete value.foto;
        }
        $.ajax({
            url: $(datasiswa).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(datasiswa).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                progressbar()
                $('.nav-tabs-custom li:nth(1) a').trigger('click')
                $(datasiswa + ' input[name="id"]').val(data.data);
                Main.autoSetError(datasiswa, [])
            },
            error: function(e) {
                Main.autoSetError(datasiswa, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

    $(document).on('click', '.datapribadi .btn-save', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(datapribadi).serializeArray());
        value.is_active = $(datapribadi + ' input[name="is_active"]').val();
        value.id_siswa = $(datasiswa + ' input[name="id"]').val();
        if (value.tgl_lhr) {
            value.tgl_lhr = moment(value.tgl_lhr, "DD/MM/YYYY").format("YYYY/MM/DD")
        }
        $.ajax({
            url: $(datapribadi).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(datapribadi).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                progressbar()
                $('.nav-tabs-custom li:nth(2) a').trigger('click')
                $(datapribadi + ' input[name="id"]').val(data.data);
                Main.autoSetError(datasiswa, [])
            },
            error: function(e) {
                Main.autoSetError(datapribadi, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })
    $(document).on('click', '.dataayah .btn-save', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(dataayah).serializeArray());
        value.is_active = $(dataayah + ' input[name="is_active"]').val();
        value.id_siswa = $(datasiswa + ' input[name="id"]').val();
        value.foto_ayah = $('.fotoayah').attr('src');
        if (value.foto_ayah.indexOf(__base_url) != -1) {
            delete value.foto_ayah;
        }
        if (value.tgl_lhr_ayah) {
            value.tgl_lhr_ayah = moment(value.tgl_lhr_ayah, "DD/MM/YYYY").format("YYYY/MM/DD")
        }
        $.ajax({
            url: $(dataayah).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(dataayah).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                progressbar()
                $('.nav-tabs-custom li:nth(3) a').trigger('click')
                $(dataayah + ' input[name="id"]').val(data.data);
                $(dataibu + ' input[name="id"]').val(data.data);
                Main.autoSetError(datasiswa, [])
            },
            error: function(e) {
                Main.autoSetError(dataayah, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })
    $(document).on('click', '.dataibu .btn-save', function(e) {
        e.preventDefault();
        var value = Main.objectifyForm($(dataibu).serializeArray());
        value.is_active = $(dataibu + ' input[name="is_active"]').val();
        value.id_siswa = $(datasiswa + ' input[name="id"]').val();
        value.foto_ibu = $('.fotoibu').attr('src');
        if (value.foto_ibu.indexOf(__base_url) != -1) {
            delete value.foto_ibu;
        }
        if (value.tgl_lhr_ibu) {
            value.tgl_lhr_ibu = moment(value.tgl_lhr_ibu, "DD/MM/YYYY").format("YYYY/MM/DD")
        }
        $.ajax({
            url: $(dataibu).attr('action'),
            data: {
                data: JSON.stringify([value])
            },
            method: $(dataibu).attr('method'),
            headers: {
                'Authorization': localStorage.getItem("token")
            },
            success: function(data) {
                progressbar()
                $('.nav-tabs-custom li:nth(4) a').trigger('click')
                $(dataayah + ' input[name="id"]').val(data.data);
                $(dataibu + ' input[name="id"]').val(data.data);
                Main.autoSetError(datasiswa, [])
            },
            error: function(e) {
                Main.autoSetError(dataibu, e.responseJSON.error)
            },
            complete: function(e) {

            }
        });
    })

})
</script>