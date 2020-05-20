<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Transaksikeuangan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('keuangan/m_transaksikeuangan');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $_POST['sub_transaksi'] = $_POST['id_kode_gl'];
            if(empty($_POST['jurnal'])){
                $_POST['kode_reg'] = $this->m_transaksikeuangan->generateNumber($_POST['id_skl']);
                $_POST['jurnal'] = date('dmy') . $_POST['kode_reg'];
            } else {
                $_POST['kode_reg'] = $this->m_transaksikeuangan->generateNumber($_POST['id_skl']) - 1;
            }
            $_POST['tgl'] = date('Y-m-d H:i:s');

            if($_POST['id_kode_gl'] == CODE_KREDIT || $_POST['id_kode_gl'] == CODE_KAS){
                $_POST['kredit'] = $_POST['nominal'];
                $_POST['debet'] = 0;
            } else {
                $_POST['debet'] = $_POST['nominal'];
                $_POST['kredit'] = 0;
            }

            $this->set_response([
                'data' => $this->m_transaksikeuangan->create($_POST),
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
            'data' => $this->m_transaksikeuangan->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $_POST['sub_transaksi'] = $_POST['id_kode_gl'];
            if($_POST['id_kode_gl'] == CODE_KREDIT || $_POST['id_kode_gl'] == CODE_KAS){
                $_POST['kredit'] = $_POST['nominal'];
                $_POST['debet'] = 0;
            } else {
                $_POST['debet'] = $_POST['nominal'];
                $_POST['kredit'] = 0;
            }
            $this->set_response([
                'data' => $this->m_transaksikeuangan->update($_POST, $_POST['id']),
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
            'data' => $this->m_transaksikeuangan->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_transaksikeuangan->json()), REST_Controller::HTTP_OK);
    }
    public function jurnaljson_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_transaksikeuangan->jurnaljson()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        // $this->form_validation->set_rules('id_aka', 'jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kls', 'kelas', 'trim|required');
        $this->form_validation->set_rules('id_kode_gl', 'group', 'trim|required');
        $this->form_validation->set_rules('id_a_thn', 'tahun buku', 'trim|required');
        $this->form_validation->set_rules('ket', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('jenis_transaksi', 'jenis transaksi', 'trim|required');
        $this->form_validation->set_rules('nominal', 'nominal', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function readdetail_post()
    {
        $this->set_response([
            'data' => $this->m_transaksikeuangan->readdetail($_POST),
        ], REST_Controller::HTTP_OK);
    }
}
