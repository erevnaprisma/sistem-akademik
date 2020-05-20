<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Absensi_karyawan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('absensi/m_absensi_karyawan');
    }

    public function create_post()
    {
        $this->form_validation->set_rules('date_of_entry', 'date_of_entry', 'trim|required');
        $this->form_validation->set_rules('date_of_out', 'date_of_out', 'trim|required');
        $this->form_validation->set_rules('come_late', 'come_late', 'trim|required');
        $this->form_validation->set_rules('id_user', 'id_user', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'id_skl', 'trim|required');

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_absensi_karyawan->create($_POST),
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
            'data' => $this->m_absensi_karyawan->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id_user', 'id_user', 'trim|required');
        $this->form_validation->set_rules('date_of_entry', 'date_of_entry', 'trim|required');
        $this->form_validation->set_rules('date_of_out', 'date_of_out', 'trim|required');
        $this->form_validation->set_rules('come_late', 'come_late', 'trim|required');
        $this->form_validation->set_rules('id_user', 'id_user', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'id_skl', 'trim|required');
        $user = $this->m_absensi_karyawan->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_absensi_karyawan->update($_POST, $_POST['id']),
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
            'data' => $this->m_absensi_karyawan->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_absensi_karyawan->json()), REST_Controller::HTTP_OK);
    }
}
