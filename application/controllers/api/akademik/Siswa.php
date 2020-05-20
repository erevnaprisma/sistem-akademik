<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Siswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_siswa');
        $this->load->model('akademik/m_datapribadi');
        $this->load->model('akademik/m_dataorangtua');
        $this->load->model('master/m_user');
    }

    public function create_post()
    {
        // $this->form_validation->set_rules('name', 'username', 'trim|required');
        $this->form_validation->set_rules('nama_siswa', 'nama', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'is_unique[app_siswa.email]|valid_email|trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('angkatan', 'angkatan', 'trim|required');
        $this->form_validation->set_rules('hp_siswa', 'hp_siswa', 'trim|required');
        // $this->form_validation->set_rules('hp_ortu_1', 'hp ortu ', 'trim|required');
        // $this->form_validation->set_rules('email_ortu_1', 'email ortu', 'trim|required');

        if ($this->form_validation->run() == true) {


            if(!empty($_POST['foto'])){
                $img = $_POST['foto'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto'] = $filename;
            }

            $_POST['name'] = $_POST['nama_siswa'];
            $_POST['user_type_id'] = USER_TYPE_SISWA;
            $_POST['password'] = encriptString("si-edu");

            $id = $this->m_user->create($_POST);
            $_POST['id_user'] = $id;

            $this->set_response([
                'data' => $this->m_siswa->create($_POST),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function read_post()
    {
        $this->set_response([
            'data' => $this->m_siswa->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        // $this->form_validation->set_rules('name', 'username', 'trim|required');
        $this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
        // $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('angkatan', 'angkatan', 'trim|required');
        $this->form_validation->set_rules('hp_siswa', 'hp_siswa', 'trim|required');
        $this->form_validation->set_rules('hp_ortu_1', 'hp ortu ', 'trim|required');
        $this->form_validation->set_rules('email_ortu_1', 'email ortu', 'trim|required');
        $user = $this->m_siswa->read(['id' => $_POST['id']]);
        if (isset($user[0]->email) && $user[0]->email != $_POST['email']) {
            $this->form_validation->set_rules('email', 'email', 'is_unique[app_siswa.email]|valid_email|trim|required');
        }
        if ($this->form_validation->run() == true) {

            if(!empty($_POST['foto'])){
                $img = $_POST['foto'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto'] = $filename;
            }

            $this->m_user->update([
                'name'=>$_POST['nama_siswa'],
                'email'=>$_POST['email']
            ],$_POST['id_user']);
            $this->set_response([
                'data' => $this->m_siswa->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function delete_post($id)
    {
        $this->set_response([
            'data' => $this->m_siswa->update($_POST,$id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_siswa->json()), REST_Controller::HTTP_OK);
    }


    public function import_post()
    {
        $this->form_validation->set_rules('name', 'username', 'trim|required');
        $this->form_validation->set_rules('nama_siswa', 'nama_siswa', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        // $this->form_validation->set_rules('email', 'email', 'valid_email|trim|required');
        $this->form_validation->set_rules('email', 'email', 'is_unique[app_siswa.email]|valid_email|trim|required');
        $this->form_validation->set_rules('no_induk', 'no induk', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('angkatan', 'angkatan', 'trim|required');
        $this->form_validation->set_rules('hp_siswa', 'hp_siswa', 'trim|required');
        $this->form_validation->set_rules('hp_ortu_1', 'hp ortu ', 'trim|required');
        $this->form_validation->set_rules('email_ortu_1', 'email ortu', 'trim|required');
        if ($this->form_validation->run() == true) {

            if($_POST['jk']=='Laki-Laki'){
                $_POST['jk'] = 1;
            }

            if($_POST['jk']=='Perempuan'){
                $_POST['jk'] = 2;
            }

            $_POST['user_type_id'] = USER_TYPE_SISWA;
            $_POST['password'] = encriptString("si-edu");
            $id = $this->m_user->create($_POST);
            $_POST['id_user'] = $id;
            $this->set_response([
                'data' => $this->m_siswa->create($_POST),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function datapribadi_post()
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
        // $user = $this->m_siswa->read(['id' => $_POST['id']]);
        // $this->form_validation->set_rules('email', 'email', 'valid_email|trim|required');
        // if (isset($user[0]->email) && $user[0]->email != $_POST['email']) {
            // $this->form_validation->set_rules('email', 'email', 'is_unique[app_siswa.email]|valid_email|trim|required');
        // }
        if ($this->form_validation->run() == true) {
            if(empty($_POST['id'])){
                $result = $this->m_datapribadi->create($_POST);
            } else {
                $result = $this->m_datapribadi->update($_POST, $_POST['id']);
            }
            $this->set_response([
                'data' => $result,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function dataorangtua_post()
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
        // $this->form_validation->set_rules('jbt_ayah', 'jabatan', 'trim|required');
        $this->form_validation->set_rules('gaji_ayah', 'gaji', 'trim|required');
        $this->form_validation->set_rules('almt_knt_ayah', 'alamat kantor', 'trim|required');
        $this->form_validation->set_rules('almt_rmh_ayah', 'alamat', 'trim|required');
        $this->form_validation->set_rules('telp', 'telpon', 'trim|required');


        

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
            
        // $this->form_validation->set_rules('jbt_ibu', 'jabatan', 'trim|required');
        $this->form_validation->set_rules('gaji_ibu', 'gaji', 'trim|required');
        $this->form_validation->set_rules('almt_knt_ibu', 'alamat kantor', 'trim|required');
        $this->form_validation->set_rules('almt_rmh_ibu', 'alamat', 'trim|required');
        $this->form_validation->set_rules('telp_ibu', 'telpon', 'trim|required');

        if ($this->form_validation->run() == true) {
            if(!empty($_POST['foto_ayah'])){
                $img = $_POST['foto_ayah'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto_ayah'] = $filename;
            }
            if(!empty($_POST['foto_ibu'])){
                $img = $_POST['foto_ibu'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto_ibu'] = $filename;
            }
            if(empty($_POST['id'])){
                $result = $this->m_dataorangtua->create($_POST);
            } else {
                $result = $this->m_dataorangtua->update($_POST, $_POST['id']);
            }
            $this->set_response([
                'data' => $result,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
