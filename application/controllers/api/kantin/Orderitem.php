<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Orderitem extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kantin/m_orderitem');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_orderitem->create($_POST),
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
            'data' => $this->m_orderitem->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_orderitem->update($_POST, $_POST['id']),
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
            'data' => $this->m_orderitem->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_orderitem->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {

        $this->form_validation->set_rules('order_id', 'order id', 'trim|required');
        $this->form_validation->set_rules('product_code', 'product_code', 'trim|required');
        $this->form_validation->set_rules('product_name', 'product_name', 'trim|required');
        $this->form_validation->set_rules('product_category', 'product_category', 'trim|required');
        $this->form_validation->set_rules('cost', 'cost', 'trim|required');
        // $this->form_validation->set_rules('price', 'price', 'trim|required');
        $this->form_validation->set_rules('qty', 'qty', 'trim|required');


        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    

}
