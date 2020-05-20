<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Psb extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('anjungan/m_psb');
    }

    public function create_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_psb->create($_POST),
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
            'data' => $this->m_psb->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_psb->update($_POST, $_POST['id']),
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
            'data' => $this->m_psb->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_psb->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('id_tahun', 'tahun ajaran', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
        $this->form_validation->set_rules('nm_panggilan', 'nnama panggilan', 'trim|required');
        $this->form_validation->set_rules('jk', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('hp_siswa', 'ho siswa', 'trim|required');
        $this->form_validation->set_rules('hp_ortu_1', 'hp orang tua', 'trim|required');
        $this->form_validation->set_rules('hp_ortu_2', 'hp orang tua 2', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
