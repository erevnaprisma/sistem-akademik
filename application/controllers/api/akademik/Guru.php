<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Guru extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_guru');
        $this->load->model('master/m_user');
    }

    public function create_post()
    {
        // inject user type ID
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $_POST['user_type_id'] = USER_TYPE_GURU;
            $_POST['password'] = encriptString("si-edu");


            $id = $this->m_user->create($_POST);
            $_POST['id_user'] = $id;


            $this->set_response([
                'data' => $this->m_guru->create($_POST),
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
            'data' => $this->m_guru->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_guru->update($_POST, $_POST['id']),
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
            'data' => $this->m_guru->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_guru->json()), REST_Controller::HTTP_OK);
    }


    public function _rules() 
    {
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
