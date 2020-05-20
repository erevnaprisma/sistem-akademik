<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Pegawai extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kepegawaian/m_pegawai');
    }

    public function create_post()
    {
        
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_pegawai->create($_POST),
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
            'data' => $this->m_pegawai->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_pegawai->update($_POST, $_POST['id']),
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
            'data' => $this->m_pegawai->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_pegawai->json()), REST_Controller::HTTP_OK);
    }

    public function _rules(){
        // $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('tmp_lhr', 'tmp_lhr', 'trim|required');
        $this->form_validation->set_rules('tgl_lhr', 'tgl_lhr', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('id_agama', 'id_agama', 'trim|required');
        $this->form_validation->set_rules('suku', 'suku', 'trim|required');
        $this->form_validation->set_rules('status_kwn', 'status_kwn', 'trim|required');
        $this->form_validation->set_rules('id_goldar', 'id_goldar', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('hp', 'hp', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('no_induk', 'no_induk', 'trim|required');
        $this->form_validation->set_rules('bagian', 'bagian', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
        $this->form_validation->set_rules('id_goldar', 'id_goldar', 'trim|required');
        $this->form_validation->set_rules('uk_baju', 'uk_baju', 'trim|required');
        $this->form_validation->set_rules('uk_spt', 'uk_spt', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
