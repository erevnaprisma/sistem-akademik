<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Transkip extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_transkip');
    }

    public function create_post()
    {
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        $this->form_validation->set_rules('sks', 'sks', 'trim|required');
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('bobot', 'bobot', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_transkip->create($_POST),
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
            'data' => $this->m_transkip->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
       // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        $this->form_validation->set_rules('sks', 'sks', 'trim|required');
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('bobot', 'bobot', 'trim|required');
        $user = $this->m_transkip->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_transkip->update($_POST, $_POST['id']),
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
            'data' => $this->m_transkip->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_transkip->json()), REST_Controller::HTTP_OK);
    }
}
