<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Dokumen extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        // authToken($this);
        validPost($this);
        $this->load->model('transaksi/m_dokumen');
    }

    public function create_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . $_POST['hal'] .'/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $_POST['id_trx'] . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['name'] = $name;

            $this->set_response([
                'data' => $this->m_dokumen->create($_POST),
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
            'data' => $this->m_dokumen->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_dokumen->update($_POST, $_POST['id']),
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
            'data' => $this->m_dokumen->delete($id),
        ], REST_Controller::HTTP_OK);
    }
    public function deletefile_post($id)
    {
        $this->set_response([
            'data' => $this->m_dokumen->deletefile($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_dokumen->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('id_trx', 'trx', 'trim|required');
        $this->form_validation->set_rules('flag', 'flag', 'trim|required');
        $this->form_validation->set_rules('hal', 'hal', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
