<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Dataorangtua extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_dataorangtua');
    }

    public function create_post()
    {
        if ($this->form_validation->run() == true) {
            if(!empty($_POST['foto_ayah'])){
                $img = $_POST['foto_ayah'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto_ayah'] = $filename;
            }
            if(!empty($_POST['foto_ibu'])){
                $img = $_POST['foto_ibu'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto_ibu'] = $filename;
            }
            $this->set_response([
                'data' => $this->m_dataorangtua->create($_POST),
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
            'data' => $this->m_dataorangtua->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $user = $this->m_dataorangtua->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            if(!empty($_POST['foto_ayah'])){
                $img = $_POST['foto_ayah'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto_ayah'] = $filename;
            }
            if(!empty($_POST['foto_ibu'])){
                $img = $_POST['foto_ibu'];
                $path = PUBLIC_IMAGE . 'user/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['foto_ibu'] = $filename;
            }
            $this->set_response([
                'data' => $this->m_dataorangtua->update($_POST, $_POST['id']),
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
            'data' => $this->m_dataorangtua->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_dataorangtua->json()), REST_Controller::HTTP_OK);
    }
}
