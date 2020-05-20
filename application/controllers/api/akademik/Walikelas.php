<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Walikelas extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_walikelas');
        $this->load->model('master/m_user');
    }

    public function create_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_walikelas->create($_POST),
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
            'data' => $this->m_walikelas->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
       
$this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_walikelas->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_walikelas->json()), REST_Controller::HTTP_OK);
    }
    
    public function _rules(){
        // $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('id_user', 'wali kelas', 'trim|required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'tahun', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'semester', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
