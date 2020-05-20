<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Keuangan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('keuangan/m_trxkeuangan');
    }

    public function create_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_trxkeuangan->create($_POST),
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
            'data' => $this->m_trxkeuangan->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_trxkeuangan->update($_POST, $_POST['id']),
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
            'data' => $this->m_trxkeuangan->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_trxkeuangan->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('id_tahun', 'tahun', 'trim|required');
        $this->form_validation->set_rules('id_kodegl', 'kode gl', 'trim|required');
        $this->form_validation->set_rules('id_jenistransaksi', 'jenis transaksi', 'trim|required');
        $this->form_validation->set_rules('jurnal', 'jurnal', 'trim|required');
        $this->form_validation->set_rules('qty', 'qty', 'trim|required');
        $this->form_validation->set_rules('nominal', 'nominal', 'trim|required');
        $this->form_validation->set_rules('ket', 'keterangan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    

    public function readdetail_post()
    {
        $this->set_response([
            'data' => $this->m_trxkeuangan->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
    public function getrekapkas_post()
    {
        $this->set_response([
            'data' => $this->m_trxkeuangan->getrekapkas($_POST),
        ], REST_Controller::HTTP_OK);
    }
}
