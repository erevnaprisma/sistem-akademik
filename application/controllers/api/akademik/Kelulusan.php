<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Kelulusan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_kelulusan');
    }

    public function checksiswa() {
        
        $cek =  $this->m_kelulusan->read([
            "id_tahun" => $_POST["id_tahun"],
            "id_jurusan" => $_POST["id_jurusan"],
            "id_kelas" => $_POST["id_kelas"],
            "id_semester" => $_POST["id_semester"],
            "id_siswa" => $_POST["id_siswa"],
        ]);
        if ($cek) {
            $this->form_validation->set_message('id_kelas', 'Sudah Lulus');
            return FALSE;
        }
        return TRUE;
    }

    public function create_post()
    {
        $ready = "";
        $cek =  $this->m_kelulusan->read([
            "id_tahun" => $_POST["id_tahun"],
            "id_jurusan" => $_POST["id_jurusan"],
            "id_kelas" => $_POST["id_kelas"],
            "id_semester" => $_POST["id_semester"],
            "id_siswa" => $_POST["id_siswa"],
        ]);
        if ($cek) {
            $ready = "|is_unique[trx_kelulusan.id_siswa]";
        }


        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required'.$ready);
        $this->form_validation->set_rules('id_tahun', 'tahun', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_kelulusan->create($_POST),
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
            'data' => $this->m_kelulusan->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('id_tahun', 'tahun', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        $user = $this->m_kelulusan->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_kelulusan->update($_POST, $_POST['id']),
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
            'data' => $this->m_kelulusan->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_kelulusan->json()), REST_Controller::HTTP_OK);
    }
}
