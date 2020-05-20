<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Kenaikan_kelas extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_kenaikan_kelas');
        $this->load->model('master/m_user');
        $this->load->model('akademik/m_siswa');
    }

    public function create_post()
    {
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');
        if ($this->form_validation->run() == true) {

            // $arr = [];
            $this->m_user->update([
                "id_jurusan" => isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : 0,
                "id_kelas" => $_POST['id_kelas'],
                "id_tahun" => $_POST['id_tahun'],
                "id_semester" => $_POST['id_semester'],
                // "tingkat" => $_POST['id_kelas'],
            ], $_POST['id_siswa']);

            // { ["id"]=> string(0) "" ["id_skl"]=> string(1) "1" ["id_tahun"]=> string(1) "6" ["id_semester"]=> string(1) "7" ["id_jurusan"]=> string(1) "4" ["id_kelas"]=> string(2) "23" ["nama_siswa"]=> string(7) "setiadi" ["id_siswa"]=> string(2) "25" ["is_active"]=> string(1) "1" }

            // var_dump($_POST); die;

            
            $this->set_response([
                'data' => $this->m_kenaikan_kelas->create($_POST),
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
            'data' => $this->m_kenaikan_kelas->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');
        if ($this->form_validation->run() == true) {
            
            $this->m_user->update([
                "id_jurusan" => isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : 0,
                "id_kelas" => $_POST['id_kelas'],
                "id_tahun" => $_POST['id_tahun'],
                "id_semester" => $_POST['id_semester'],
            ], $_POST['id_siswa']);

            $this->set_response([
                'data' => $this->m_kenaikan_kelas->update($_POST, $_POST['id']),
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
            'data' => $this->m_kenaikan_kelas->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_kenaikan_kelas->json()), REST_Controller::HTTP_OK);
    }
    
    public function getsiswabaru_post()
    {
        $_POST['user_type_id'] = USER_TYPE_SISWA;
        $_POST['is_kelas'] = STATUS_IS_NO_ACTIVE;
        $_POST['is_active'] = STATUS_IS_ACTIVE;
        $this->set_response([
            'data' => $this->m_user->read([
                "user_type_id" => USER_TYPE_SISWA,
                "is_kelas" => STATUS_IS_NO_ACTIVE,
                "is_active" => STATUS_IS_ACTIVE,
                "limit" => isset($_POST['limit']) ? $_POST['limit'] : "-1",
                "id_skl" => $_POST['id_skl']
            ]),
        ], REST_Controller::HTTP_OK);
    }
    public function simpansiswabaru_post()
    {
        $this->form_validation->set_rules('id_tahun', 'tahun', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->m_kenaikan_kelas->siswakelas($_POST['id_siswa']);
            $this->set_response([
                'data' => $this->m_kenaikan_kelas->create($_POST),
            ], REST_Controller::HTTP_OK);

            $this->m_user->update([
                "id_jurusan" => isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : 0,
                "id_kelas" => $_POST['id_kelas'],
            ], $_POST['id_siswa']);
            
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
