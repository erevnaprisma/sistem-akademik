<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class Data extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        validPost($this);
        $this->load->model('master/m_informasi');

        $this->load->model('master/m_banner');
        $this->load->model('master/m_user');
        $this->load->model('master/m_tipeujian');
        $this->load->model('master/m_usertype');
        $this->load->model('master/m_sekolah');
        $this->load->model('akademik/m_kelas');
        $this->load->model('akademik/m_tahun_ajaran');
        $this->load->model('akademik/m_semester');
        $this->load->model('akademik/m_jurusan');
        $this->load->model('akademik/m_mapel');
        $this->load->model('akademik/m_siswa');
        $this->load->model('akademik/m_datapribadi');
        $this->load->model('akademik/m_dataortu');
        $this->load->model('akademik/m_raport');
        $this->load->model('akademik/m_karaktersiswa');
        $this->load->model('master/m_menu');
        $this->load->model('master/m_ekskul');
        $this->load->model('master/m_jk');
        $this->load->model('master/m_agama');
        $this->load->model('master/m_goldar');
        $this->load->model('master/m_tempattinggal');
        $this->load->model('master/m_statustinggal');
        $this->load->model('master/m_transportasirumah');
        $this->load->model('master/m_jarakrumah');
        $this->load->model('master/m_dibiayaioleh');
        $this->load->model('master/m_pendidikanterakhir');
        $this->load->model('master/m_pekerjaan');
        
        $this->load->model('master/m_status_kwn');

        $this->load->model('akademik/m_jadwalpelajaran');
        $this->load->model('akademik/m_rpp');
        $this->load->model('akademik/m_kenaikan_kelas');
        $this->load->model('akademik/m_nilai_siswa');
        $this->load->model('akademik/m_penilaian');

        $this->load->model('anjungan/m_psb');
        $this->load->model('anjungan/m_info');
        
        $this->load->model('anjungan/m_video');

        $this->load->model('keuangan/m_kodegl');
        $this->load->model('keuangan/m_jenistransaksi');
        $this->load->model('keuangan/m_tahunbuku');
        $this->load->model('keuangan/m_cashlesspayment');
        $this->load->model('keuangan/m_trxkeuangan');
        $this->load->model('keuangan/m_itemtransaksi');

        $this->load->model('akademik/m_kalendar_pendidikan');
        $this->load->model('kesiswaan/m_kalender_kegiatan');
        $this->load->model('kesiswaan/m_prestasi_siswa');
        $this->load->model('kesiswaan/m_pelanggaran_siswa');
        $this->load->model('kesiswaan/m_osis');
        $this->load->model('kesiswaan/m_kegiatanekskul');

        // kantin
        $this->load->model('kantin/m_category');
        $this->load->model('kantin/m_customer');
        $this->load->model('kantin/m_suspenditem');
        $this->load->model('kantin/m_outlet');
        $this->load->model('kantin/m_product');
        $this->load->model('kantin/m_order');

        $this->load->model('absensi/m_absensi_siswa');
        $this->load->model('absensi/m_absensi_siswa_main');

        $this->load->model('transaksi/m_notip');


        $this->load->model('forum/m_forum');

        // elibrary
        $this->load->model('elibrary/m_jenisbuku');
        $this->load->model('elibrary/m_buku');
        $this->load->model('elibrary/m_pustaka');

        $this->load->model('elearning/m_materi');
        $this->load->model('elearning/m_soalujian');
        $this->load->model('elearning/m_ujian');
    }

    public function notipread_post()
    {
        $this->set_response([
            'data' => $this->m_notip->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function notipdetailread_post()
    {
        $this->set_response([
            'data' => $this->m_notip->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function menuread_post()
    {
        $this->set_response([
            'data' => $this->m_menu->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function bannerread_post()
    {
        $this->set_response([
            'data' => $this->m_banner->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function informasiread_post()
    {
        $this->set_response([
            'data' => $this->m_informasi->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function tipeujianread_post()
    {
        $this->set_response([
            'data' => $this->m_tipeujian->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function usertyperead_post()
    {
        $this->set_response([
            'data' => $this->m_usertype->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function userread_post()
    {
        $this->set_response([
            'data' => $this->m_user->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function statuskawinread_post()
    {
        $this->set_response([
            'data' => $this->m_status_kwn->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function tahun_ajaranread_post()
    {
        $this->set_response([
            'data' => $this->m_tahun_ajaran->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function sekolahread_post()
    {
        $this->set_response([
            'data' => $this->m_sekolah->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function ekskulread_post()
    {
        $this->set_response([
            'data' => $this->m_ekskul->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function kelasread_post()
    {
        $this->set_response([
            'data' => $this->m_kelas->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function semesterread_post()
    {
        $this->set_response([
            'data' => $this->m_semester->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function jurusanread_post()
    {
        $this->set_response([
            'data' => $this->m_jurusan->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function mapelread_post()
    {
        $this->set_response([
            'data' => $this->m_mapel->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function rppread_post()
    {
        $this->set_response([
            'data' => $this->m_rpp->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function siswaread_post()
    {
        $this->set_response([
            'data' => $this->m_siswa->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function siswanativeread_post()
    {
        $this->set_response([
            'data' => $this->m_siswa->getsiswanative($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function jkread_post()
    {
        $this->set_response([
            'data' => $this->m_jk->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function agamaread_post()
    {
        $this->set_response([
            'data' => $this->m_agama->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function jenisbukuread_post()
    {
        $this->set_response([
            'data' => $this->m_jenisbuku->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function kodeglread_post()
    {
        $this->set_response([
            'data' => $this->m_kodegl->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function jenistransaksiread_post()
    {
        $this->set_response([
            'data' => $this->m_jenistransaksi->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function itemtransaksiread_post()
    {
        $this->set_response([
            'data' => $this->m_itemtransaksi->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function keuanganread_post()
    {
        $this->set_response([
            'data' => $this->m_trxkeuangan->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function keuanganitemread_post()
    {
        $this->set_response([
            'data' => $this->m_trxkeuangan->readitemdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function tahunbukuread_post()
    {
        $this->set_response([
            'data' => $this->m_tahunbuku->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function goldarread_post()
    {
        $this->set_response([
            'data' => $this->m_goldar->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function tempattinggalread_post()
    {
        $this->set_response([
            'data' => $this->m_tempattinggal->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function statustinggalread_post()
    {
        $this->set_response([
            'data' => $this->m_statustinggal->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function transportasirumahread_post()
    {
        $this->set_response([
            'data' => $this->m_transportasirumah->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function jarakrumahread_post()
    {
        $this->set_response([
            'data' => $this->m_jarakrumah->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function dibiayaiolehread_post()
    {
        $this->set_response([
            'data' => $this->m_dibiayaioleh->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function pendidikanterakhirread_post()
    {
        $this->set_response([
            'data' => $this->m_pendidikanterakhir->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function pekerjaanread_post()
    {
        $this->set_response([
            'data' => $this->m_pekerjaan->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function kenaikankelasread_post()
    {
        $this->set_response([
            'data' => $this->m_kenaikan_kelas->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function absensisiswaread_post()
    {
        $this->set_response([
            'data' => $this->m_absensi_siswa->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function absensisiswamainread_post()
    {
        $this->set_response([
            'data' => $this->m_absensi_siswa_main->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function lapabsensimapel_post()
    {
        $this->set_response([
            'data' => $this->m_absensi_siswa->lapabsensimapel($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function absensisiswamaindetailread_post()
    {
        $this->set_response([
            'data' => $this->m_absensi_siswa_main->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function absensisiswamaincountread_post()
    {
        $this->set_response([
            'data' => $this->m_absensi_siswa_main->count($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function lapabsensisiswa_post()
    {
        $this->set_response([
            'data' => $this->m_absensi_siswa_main->lapabsensisiswa($_POST),
        ], REST_Controller::HTTP_OK);
    }
    
    public function nilaisiswaread_post()
    {
        $this->set_response([
            'data' => $this->m_nilai_siswa->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function nilaisiswadetailread_post()
    {
        $this->set_response([
            'data' => $this->m_nilai_siswa->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function transread_post()
    {
        $this->set_response([
            'data' => $this->m_cashlesspayment->trans,
        ], REST_Controller::HTTP_OK);
    }

    public function transkipread_post()
    {
        $this->set_response([
            'data' => $this->m_raport->findTranskip($_POST),
        ], REST_Controller::HTTP_OK);
    }





    public function categoryproduct_post(){
        $this->set_response([
            'data' => $this->m_category->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function customer_post(){
        $this->set_response([
            'data' => $this->m_customer->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function outletorder_post(){
        $this->set_response([
            'data' => $this->m_suspenditem->outletorder($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function outlet_post(){
        $this->set_response([
            'data' => $this->m_outlet->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function orderdetailread_post(){
        $this->set_response([
            'data' => $this->m_order->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }


    public function jadwalpelajarandetailread_post(){
        $this->set_response([
            'data' => $this->m_jadwalpelajaran->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function kalendar_pendidikandetailread_post(){
        $this->set_response([
            'data' => $this->m_kalendar_pendidikan->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function karaktersiswadetailread_post(){
        $this->set_response([
            'data' => $this->m_karaktersiswa->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function prestasi_siswadetailread_post(){
        $this->set_response([
            'data' => $this->m_prestasi_siswa->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function pelanggaran_siswadetailread_post(){
        $this->set_response([
            'data' => $this->m_pelanggaran_siswa->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function osisdetailread_post(){
        $this->set_response([
            'data' => $this->m_osis->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function kegiatanekskuldetailread_post(){
        $this->set_response([
            'data' => $this->m_kegiatanekskul->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }




    public function getprofil_post(){
        $this->set_response([
            'data' => $this->m_user->getprofil($_POST),
        ], REST_Controller::HTTP_OK);
    }


    public function lappenilaian_post(){
        $this->set_response([
            'data' => $this->m_penilaian->lappenilaian($_POST),
        ], REST_Controller::HTTP_OK);
    }




    public function forumdetailread_post()
    {
        $this->set_response([
            'data' => $this->m_forum->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }

    
    public function productdetailread_post()
    {
        $this->set_response([
            'data' => $this->m_product->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }

    
    public function suspenditemdetailread_post()
    {
        $this->set_response([
            'data' => $this->m_suspenditem->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function elibraryread_post()
    {
        $this->set_response([
            'data' => $this->m_buku->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function materiread_post()
    {
        $this->set_response([
            'data' => $this->m_materi->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function soalujianread_post()
    {
        $this->set_response([
            'data' => $this->m_soalujian->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function ujianread_post()
    {
        $this->set_response([
            'data' => $this->m_ujian->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function hasilujianread_post()
    {
        $this->set_response([
            'data' => $this->m_ujian->hasilreaddetail($_POST),
        ], REST_Controller::HTTP_OK);
    }

    



    // frontend jadual
    public function jadualgururead_post()
    {
        $this->form_validation->set_rules('id_tahun', 'tahun', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'jurusan', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'semester', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'kelas', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');


        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_jadwalpelajaran->read($_POST),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }













    // PSOB
    public function siswa_create_post()
    {
     $this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
    //  $this->form_validation->set_rules('no_induk', 'no induk', 'trim|required');
     $this->form_validation->set_rules('nisn', 'nisn', 'trim|required');
     $this->form_validation->set_rules('jk', 'kelamin', 'trim|required');
     $this->form_validation->set_rules('angkatan', 'angkatan', 'trim|required');
    //  $this->form_validation->set_rules('hp_siswa', 'hp_siswa', 'trim|required');
     $this->form_validation->set_rules('email', 'email', 'trim|required');
     $this->form_validation->set_rules('hp_ortu_1', 'hp ortu 1', 'trim|required');
    //  $this->form_validation->set_rules('hp_ortu_2', 'hp_ortu_2', 'trim|required');
     $this->form_validation->set_rules('email_ortu_1', 'email ortu 1', 'trim|required');
    //  $this->form_validation->set_rules('email_ortu_2', 'email ortu 2', 'trim|required');

     $this->form_validation->set_rules('id', 'id', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

     $_POST['created_by'] = 1;
     if ($this->form_validation->run() == true) {


        // tanda bahwa ikut PSB
        $_POST['is_psb'] = 1;

        if(!empty($_POST['foto'])){
            $img = $_POST['foto'];
            $path = PUBLIC_IMAGE . 'user/';
            $name = date('YmdHis').generateRandomString();
            $filename = uploadbase64($img,$path,$name);
            $_POST['foto'] = $filename;
        }
        if(!empty($_POST['id'])){
            
            $this->set_response([
                'data' => $this->m_siswa->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'data' => $this->m_siswa->create($_POST),
            ], REST_Controller::HTTP_OK);
        }
     } else {
         $this->set_response([
             'error' => validation_errors_json(),
         ], REST_Controller::HTTP_BAD_REQUEST);
     }
 }

 public function siswa_psb_post()
    {
     $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
     $this->form_validation->set_rules('alergi', 'alergi', 'trim|required');
     $this->form_validation->set_rules('almt_knt_ayah', 'alamat kantor ayah', 'trim|required');
     $this->form_validation->set_rules('almt_knt_ibu', 'alamat kantor ibu', 'trim|required');
     $this->form_validation->set_rules('almt_rmh_ayah', 'alamat rumah ayah', 'trim|required');
     $this->form_validation->set_rules('almt_rmh_ibu', 'alamat rumah ibu', 'trim|required');
     $this->form_validation->set_rules('ank_ke', 'anak ke', 'trim|required');
     $this->form_validation->set_rules('berat', 'berat', 'trim|required');
     $this->form_validation->set_rules('bahasa', 'bahasa', 'trim|required');
     $this->form_validation->set_rules('cita', 'cita', 'trim|required');
     $this->form_validation->set_rules('dari', 'dari', 'trim|required');
     $this->form_validation->set_rules('gaji_ayah', 'gaji ayah', 'trim|required');
     $this->form_validation->set_rules('gaji_ibu', 'gaji ibu', 'trim|required');
     $this->form_validation->set_rules('hp_ortu_1', 'hp ortu 1', 'trim|required');
     $this->form_validation->set_rules('hp_ortu_2', 'hp ortu 2', 'trim|required');
     $this->form_validation->set_rules('hp_siswa', 'hp siswa', 'trim|required');
     $this->form_validation->set_rules('id_agm', 'agama', 'trim|required');
     $this->form_validation->set_rules('id_goldar', 'golongan darah', 'trim|required');
     $this->form_validation->set_rules('id_pek_ayah', 'pekerjaan ayah', 'trim|required');
     $this->form_validation->set_rules('id_pek_ibu', 'pekerjaan ibu', 'trim|required');
     $this->form_validation->set_rules('id_pndd_ayah', 'pendidikan ayah', 'trim|required');
     $this->form_validation->set_rules('id_pndd_ibu', 'pendidikan ibu', 'trim|required');
     $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
     $this->form_validation->set_rules('instansi_ayah', 'instansi ayah', 'trim|required');
     $this->form_validation->set_rules('instansi_ibu', 'instansi ibu', 'trim|required');
     $this->form_validation->set_rules('jabatan_ayah', 'jabatan ayah', 'trim|required');
     $this->form_validation->set_rules('jabatan_ibu', 'jabatan ibu', 'trim|required');
     $this->form_validation->set_rules('jk', 'jenis kelamin', 'trim|required');
     $this->form_validation->set_rules('jml_sdr_kan', 'jml sdr kandung', 'trim|required');
     $this->form_validation->set_rules('jml_sdr_tir', 'jml sdr tiri', 'trim|required');
     $this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
     $this->form_validation->set_rules('nm_ayah', 'nama ayah', 'trim|required');
     $this->form_validation->set_rules('nm_ibu', 'nama ibu', 'trim|required');
     $this->form_validation->set_rules('nm_panggilan', 'nama panggilan', 'trim|required');
     $this->form_validation->set_rules('nomor', 'nomor', 'trim|required|min_length[6]');
     $this->form_validation->set_rules('penyakit', 'penyakit', 'trim|required');
     $this->form_validation->set_rules('pnddk_ayah', 'pendidikan ayah', 'trim|required');
     $this->form_validation->set_rules('pnddk_ibu', 'pendidikan ibu', 'trim|required');
     $this->form_validation->set_rules('sdr_ang', 'sdr angkat', 'trim|required');
     $this->form_validation->set_rules('tanggal_daftar', 'tanggal daftar', 'trim|required');
     $this->form_validation->set_rules('tmp_lhr_ayah', 'temoat lahir ayah', 'trim|required');
     $this->form_validation->set_rules('tmp_lhr_ibu', 'temoat lahir ibu', 'trim|required');
     $this->form_validation->set_rules('tgl_lhr', 'tanggal lahir', 'trim|required');
     $this->form_validation->set_rules('tgl_lhr_ayah', 'tanggal lahir ayah', 'trim|required');
     $this->form_validation->set_rules('tgl_lhr_ibu', 'tanggal lahir ibu', 'trim|required');
     $this->form_validation->set_rules('tinggi', 'tinggi', 'trim|required');
     $this->form_validation->set_rules('tmp_lahir', 'tmp_lahir', 'trim|required');
     $this->form_validation->set_rules('wrg', 'warga negara', 'trim|required');
     $this->form_validation->set_rules('wrg_ayah', 'warga negara ayah', 'trim|required');
     $this->form_validation->set_rules('wrg_ibu', 'warga negara ibu', 'trim|required');

     $this->form_validation->set_rules('id', 'id', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

     $_POST['created_by'] = 1;
     if ($this->form_validation->run() == true) {


        if(!empty($_POST['foto'])){
            $img = $_POST['foto'];
            $path = PUBLIC_IMAGE . 'psb/';
            $name = date('YmdHis').generateRandomString();
            $filename = uploadbase64($img,$path,$name);
            $_POST['foto'] = $filename;
        }


        if(!empty($_POST['id'])){
            
            $this->set_response([
                'data' => $this->m_psb->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'data' => $this->m_psb->create($_POST),
            ], REST_Controller::HTTP_OK);
        }
     } else {
         $this->set_response([
             'error' => validation_errors_json(),
         ], REST_Controller::HTTP_BAD_REQUEST);
     }
 }

 public function datapribadi_create_post()
 {
  $this->form_validation->set_rules('nm_panggilan', 'nama panggilan', 'trim|required');
  $this->form_validation->set_rules('tmp_lahir', 'tempat lahir', 'trim|required');
  $this->form_validation->set_rules('tgl_lhr', 'tanggal lahir', 'trim|required');
  $this->form_validation->set_rules('id_agm', 'agama', 'trim|required');
  $this->form_validation->set_rules('wrg', 'kewarganegaraan', 'trim|required');
//   $this->form_validation->set_rules('suku', 'suku', 'trim|required');
  $this->form_validation->set_rules('id_goldar', 'golongan darah', 'trim|required');
  $this->form_validation->set_rules('tinggi', 'tinggi', 'trim|required');
  $this->form_validation->set_rules('berat', 'berat', 'trim|required');
//   $this->form_validation->set_rules('uk_baju', 'ukuran baju', 'trim|required');
//   $this->form_validation->set_rules('uk_spt', 'ukuran sepatu', 'trim|required');
  $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
  $this->form_validation->set_rules('telp', 'telpon', 'trim|required');
  $this->form_validation->set_rules('id_sta_t_dgn', 'status tinggal', 'trim|required');
  if($_POST['id_sta_t_dgn']==0){
        $this->form_validation->set_rules('sta_t_dgn_lain', 'status tinggal', 'trim|required');
  }
  $this->form_validation->set_rules('id_tem_t_dgn', 'status tempat tinggal', 'trim|required');
  if($_POST['id_tem_t_dgn']==0){
        $this->form_validation->set_rules('tem_t_dgn_lain', 'status tempat tinggal', 'trim|required');
  }
  $this->form_validation->set_rules('id_jrk_rmh', 'jarak rumah', 'trim|required');
  if($_POST['id_jrk_rmh']==0){
        $this->form_validation->set_rules('jrk_rmh_lain', 'jarak rumah lain', 'trim|required');

  }
  $this->form_validation->set_rules('id_trn_rmh', 'transportasi rumah', 'trim|required');
  if($_POST['id_trn_rmh']==0){
        $this->form_validation->set_rules('trn_rmh_lain', 'transportasi rumah lain', 'trim|required');
  }


  $this->form_validation->set_rules('id', 'id', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

  $_POST['created_by'] = 1;
  if ($this->form_validation->run() == true) {

     if(!empty($_POST['id'])){
         $this->set_response([
             'data' => $this->m_datapribadi->update($_POST, $_POST['id']),
         ], REST_Controller::HTTP_OK);
     } else {
         $this->set_response([
             'data' => $this->m_datapribadi->create($_POST),
         ], REST_Controller::HTTP_OK);
     }
  } else {
      $this->set_response([
          'error' => validation_errors_json(),
      ], REST_Controller::HTTP_BAD_REQUEST);
  }
}

public function dataayah_create_post()
 {
  $this->form_validation->set_rules('nm_ayah', 'nama ayah', 'trim|required');
  $this->form_validation->set_rules('pg_ayah', 'nama panggilan', 'trim|required');
  $this->form_validation->set_rules('tmp_lhr_ayah', 'tempat lahir', 'trim|required');
  $this->form_validation->set_rules('tgl_lhr_ayah', 'tanggal lahir', 'trim|required');
  $this->form_validation->set_rules('agm_ayah', 'agama', 'trim|required');
  $this->form_validation->set_rules('wrg_ayah', 'kewarganegaraan', 'trim|required');
  $this->form_validation->set_rules('id_pndd_ayah', 'pendidikan', 'trim|required');
//   $this->form_validation->set_rules('pnddk_ayah', 'pendidikan lain', 'trim|required');
  $this->form_validation->set_rules('id_pek_ayah', 'pekerjaan', 'trim|required');
  if($_POST['id_pek_ayah']==0){
        $this->form_validation->set_rules('pek_ayah_lain', 'pekerjaan lain', 'trim|required');

  }
//   $this->form_validation->set_rules('jbt_ayah', 'jabatan', 'trim|required');
  $this->form_validation->set_rules('gaji_ayah', 'gaji', 'trim|required');
  $this->form_validation->set_rules('almt_knt_ayah', 'alamat kantor', 'trim|required');
  $this->form_validation->set_rules('almt_rmh_ayah', 'alamat', 'trim|required');
  $this->form_validation->set_rules('telp', 'telpon', 'trim|required');
//   $this->form_validation->set_rules('ket', 'nama', 'trim|required');

  $this->form_validation->set_rules('id', 'id', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

  $_POST['created_by'] = 1;
  if ($this->form_validation->run() == true) {
    if(!empty($_POST['foto_ayah'])){
        $img = $_POST['foto_ayah'];
        $path = PUBLIC_IMAGE . 'user/';
        $name = date('YmdHis').generateRandomString();
        $filename = uploadbase64($img,$path,$name);
        $_POST['foto_ayah'] = $filename;
    }
     if(!empty($_POST['id'])){
         $this->set_response([
             'data' => $this->m_dataortu->update($_POST, $_POST['id']),
         ], REST_Controller::HTTP_OK);
     } else {
         $this->set_response([
             'data' => $this->m_dataortu->create($_POST),
         ], REST_Controller::HTTP_OK);
     }
  } else {
      $this->set_response([
          'error' => validation_errors_json(),
      ], REST_Controller::HTTP_BAD_REQUEST);
  }
}

public function dataibu_create_post()
 {
  $this->form_validation->set_rules('nm_ibu', 'nama ibu', 'trim|required');
  $this->form_validation->set_rules('pg_ibu', 'nama panggilan', 'trim|required');
  $this->form_validation->set_rules('tmp_lhr_ibu', 'tempat lahir', 'trim|required');
  $this->form_validation->set_rules('tgl_lhr_ibu', 'tanggal lahir', 'trim|required');
  $this->form_validation->set_rules('agm_ibu', 'agama', 'trim|required');
  $this->form_validation->set_rules('wrg_ibu', 'kewarganegaraan', 'trim|required');
  $this->form_validation->set_rules('id_pndd_ibu', 'pendidikan', 'trim|required');
    //   $this->form_validation->set_rules('pndd_ibu', 'pendidikan lain', 'trim|required');
    $this->form_validation->set_rules('id_pek_ibu', 'pekerjaan', 'trim|required');
    if($_POST['id_pek_ibu']==0){
        $this->form_validation->set_rules('pek_ibu_lain', 'pekerjaan lain', 'trim|required');
    }
    
//   $this->form_validation->set_rules('jbt_ibu', 'jabatan', 'trim|required');
  $this->form_validation->set_rules('gaji_ibu', 'gaji', 'trim|required');
  $this->form_validation->set_rules('almt_knt_ibu', 'alamat kantor', 'trim|required');
  $this->form_validation->set_rules('almt_rmh_ibu', 'alamat', 'trim|required');
  $this->form_validation->set_rules('telp_ibu', 'telpon', 'trim|required');
//   $this->form_validation->set_rules('ket_ibu', 'nama', 'trim|required');

  $this->form_validation->set_rules('id', 'id', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

  $_POST['created_by'] = 1;
  if ($this->form_validation->run() == true) {
    if(!empty($_POST['foto_ibu'])){
        $img = $_POST['foto_ibu'];
        $path = PUBLIC_IMAGE . 'user/';
        $name = date('YmdHis').generateRandomString();
        $filename = uploadbase64($img,$path,$name);
        $_POST['foto_ibu'] = $filename;
    }
     if(!empty($_POST['id'])){
         $this->set_response([
             'data' => $this->m_dataortu->update($_POST, $_POST['id']),
         ], REST_Controller::HTTP_OK);
     } else {
         $this->set_response([
             'data' => $this->m_dataortu->create($_POST),
         ], REST_Controller::HTTP_OK);
     }
  } else {
      $this->set_response([
          'error' => validation_errors_json(),
      ], REST_Controller::HTTP_BAD_REQUEST);
  }
}

public function siswadetailread_post()
    {
        $this->set_response([
            'data' => $this->m_siswa->read($_POST),
        ], REST_Controller::HTTP_OK);
    }


 public function datapribadidetailread_post()
    {
        $this->set_response([
            'data' => $this->m_datapribadi->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function dataayahibudetailread_post()
    {
        $this->set_response([
            'data' => $this->m_dataortu->read($_POST),
        ], REST_Controller::HTTP_OK);
    }
    
    public function psoblistjson_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_psb->json()), REST_Controller::HTTP_OK);
    }

    public function siswapsbdetailread_post()
    {
        $this->set_response([
            'data' => isset($_POST['nomor']) && !empty($_POST['nomor']) ? $this->m_psb->read($_POST) : [],
        ], REST_Controller::HTTP_OK);
    }

    public function userjson_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_user->json()), REST_Controller::HTTP_OK);
    }



    public function anjunganinfojson_post()
    {
        header('Content-Type: application/json');
        echo $this->m_info->json();
    }
    public function kalenderjson_post($year)
    {
        header('Content-Type: application/json');
        echo json_encode($this->m_kalendar_pendidikan->read(['tahun'=>$year]));
    }

    public function kalendereventjson_post($year)
    {
        header('Content-Type: application/json');
        echo json_encode($this->m_kalender_kegiatan->read(['tahun'=>$year]));
    }
    
    
    public function anjungancountebook_post()
    {
        $this->set_response([
            'data' => $this->m_buku->count($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function anjungancountevideo_post()
    {
        $this->set_response([
            'data' => $this->m_video->count($_POST),
        ], REST_Controller::HTTP_OK);
    }


}