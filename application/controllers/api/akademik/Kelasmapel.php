<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Kelasmapel extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_kelasmapel');
    }

    public function create_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_kelasmapel->create($_POST),
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
            'data' => $this->m_kelasmapel->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_kelasmapel->update($_POST, $_POST['id']),
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
            'data' => $this->m_kelasmapel->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_kelasmapel->json()), REST_Controller::HTTP_OK);
    }

    public function _rules(){
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_mapel', 'id_mapel', 'trim|required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'tahun ajaran', 'trim|required');
        $this->form_validation->set_rules('id_kls', 'kelas', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'jurusan', 'trim|required');
        // $this->form_validation->set_rules('tingkat', 'tingkat', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
