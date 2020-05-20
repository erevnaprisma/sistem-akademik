<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Mapel extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_mapel');
    }

    public function create_post()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_mapel->create($_POST),
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
            'data' => $this->m_mapel->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        //$this->form_validation->set_rules('user_type_id', 'user type', 'trim|required');

        $user = $this->m_mapel->read(['id' => $_POST['id']]);
        // if ($user[0]->email != $_POST['email']) {
        //     $this->form_validation->set_rules('email', 'email', 'is_unique[m_mapel.email]|valid_email|trim|required');
        // }
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_mapel->update($_POST, $_POST['id']),
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
            'data' => $this->m_mapel->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_mapel->json()), REST_Controller::HTTP_OK);
    }
}
