<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Suspenditem extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kantin/m_suspenditem');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_suspenditem->create($_POST),
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
            'data' => $this->m_suspenditem->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_suspenditem->update($_POST, $_POST['id']),
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
            'data' => $this->m_suspenditem->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_suspenditem->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {

        // $this->form_validation->set_rules('suspend_id', 'suspend id', 'trim|required');
        $this->form_validation->set_rules('product_id', 'product id', 'trim|required');
        $this->form_validation->set_rules('product_code', 'product code', 'trim|required');
        $this->form_validation->set_rules('product_name', 'product name', 'trim|required');
        $this->form_validation->set_rules('product_category', 'category', 'trim|required');
        $this->form_validation->set_rules('product_cost', 'product cost', 'trim|required');
        $this->form_validation->set_rules('qty', 'qty', 'trim|required');
        $this->form_validation->set_rules('product_price', 'product price', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function outletorder_post()
    {
        $this->set_response([
            'data' => $this->m_suspenditem->outletorder($_POST),
        ], REST_Controller::HTTP_OK);
    }
    

}
