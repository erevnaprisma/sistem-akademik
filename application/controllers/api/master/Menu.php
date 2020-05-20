<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Menu extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('master/m_menu');
    }

    public function create_post()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('label', 'label', 'trim|required');
        $this->form_validation->set_rules('default_url', 'default_url', 'trim|required');
        if ($this->form_validation->run() == true) {
            $id = $this->m_menu->create($_POST);
            unset($_POST['parent_id']);
            unset($_POST['label']);
            $name = $_POST['name'];
            $_POST['menu_id'] = $id;
            foreach ($this->m_menu->action as $action) {
                $_POST['name'] = $action;
                $_POST['default_url'] = "$name/$action";
                $this->m_menu->create($_POST);
            }

            $this->set_response([
                'data' => $id,
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
            'data' => $this->m_menu->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_menu->update($_POST, $_POST['id']),
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
            'data' => $this->m_menu->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function createaction_post()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('default_url', 'default_url', 'trim|required');
        if ($this->form_validation->run() == true) {
            $_POST['menu_id'] = $_POST['id'];
            unset($_POST['id']);
            $this->set_response([
                'data' => $this->m_menu->create($_POST),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function updateaction_post()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('default_url', 'default_url', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_menu->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function reorder_post()
    {
        $this->form_validation->set_rules('menu_id', 'menu', 'trim|required');
        if ($this->form_validation->run() == true) {

            foreach (explode(',',$_POST['menu_id']) as $k => $v) {
                $this->m_menu->update(['order'=>$k], $v);
            }
            
            $this->set_response([
                'data' => 'OK',
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_menu->json()), REST_Controller::HTTP_OK);
    }
}
