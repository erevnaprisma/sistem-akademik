<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Ekskul_kelas extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kesiswaan/m_ekskul_kelas');
    }

    public function create_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_ekskul_kelas->create($_POST),
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
            'data' => $this->m_ekskul_kelas->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_ekskul_kelas->update($_POST, $_POST['id']),
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
            'data' => $this->m_ekskul_kelas->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post($id_penilaian)
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_ekskul_kelas->json($id_penilaian)), REST_Controller::HTTP_OK);
    }
    public function _rules() 
    {
        $this->form_validation->set_rules('id_penilaian', 'id_penilaian', 'trim|required');
        $this->form_validation->set_rules('id_ekskul', 'id_ekskul', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function readdetail_post()
    {
        $this->set_response([
            'data' => $this->m_ekskul_kelas->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
}
