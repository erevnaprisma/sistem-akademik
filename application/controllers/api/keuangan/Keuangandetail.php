<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Keuangandetail extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('keuangan/m_trxkeuangandetail');
    }

    public function create_post()
    {
        $_POST['nominal'] = $_POST['kredit'];

        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_trxkeuangandetail->create($_POST),
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
            'data' => $this->m_trxkeuangandetail->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_trxkeuangandetail->update($_POST, $_POST['id']),
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
            'data' => $this->m_trxkeuangandetail->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_trxkeuangandetail->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_keuangan', 'id keuangan', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('ket', 'keterangan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
