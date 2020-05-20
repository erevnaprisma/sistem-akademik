<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Nilai_harian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_nilai_harian');
    }

    public function create_post()
    {
        $this->form_validation->set_rules('id_nilai_siswa', 'id_nilai_siswa', 'trim|required');
        $this->form_validation->set_rules('nilai_harian', 'nilai_harian', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_nilai_harian->create($_POST),
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
            'data' => $this->m_nilai_harian->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('id_nilai_siswa', 'id_nilai_siswa', 'trim|required');
        $this->form_validation->set_rules('nilai_harian', 'nilai_harian', 'trim|required');
        $user = $this->m_nilai_harian->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_nilai_harian->update($_POST, $_POST['id']),
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
            'data' => $this->m_nilai_harian->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_nilai_harian->json()), REST_Controller::HTTP_OK);
    }
}
