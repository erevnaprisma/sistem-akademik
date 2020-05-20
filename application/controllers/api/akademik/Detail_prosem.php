<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Detail_prosem extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_detail_prosem');
    }

    public function create_post()
    {
        $this->form_validation->set_rules('detail_bidang', 'detail_bidang', 'trim|required');
        $this->form_validation->set_rules('id_prosem', 'id_prosem', 'trim|required');
        $this->form_validation->set_rules('detail_aw_1', 'detail_aw_1', 'trim|required');
        $this->form_validation->set_rules('detail_aw_2', 'detail_aw_2', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_detail_prosem->create($_POST),
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
            'data' => $this->m_detail_prosem->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('detail_bidang', 'detail_bidang', 'trim|required');
        $this->form_validation->set_rules('detail_aw_1', 'detail_aw_1', 'trim|required');
        $this->form_validation->set_rules('detail_aw_2', 'detail_aw_2', 'trim|required');
        $user = $this->m_detail_prosem->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_detail_prosem->update($_POST, $_POST['id']),
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
            'data' => $this->m_detail_prosem->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post($id)
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_detail_prosem->json($id)), REST_Controller::HTTP_OK);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                