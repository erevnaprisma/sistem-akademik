<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Suspend extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kantin/m_suspend');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_suspend->create($_POST),
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
            'data' => $this->m_suspend->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_suspend->update($_POST, $_POST['id']),
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
            'data' => $this->m_suspend->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_suspend->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        // $this->form_validation->set_rules('customer_id', 'customer', 'trim|required');
        $this->form_validation->set_rules('fullname', 'fullname', 'trim|required');
        // $this->form_validation->set_rules('email', 'note', 'trim|required');
        // $this->form_validation->set_rules('mobile', 'flag', 'trim|required');
        $this->form_validation->set_rules('ref_number', 'ref number', 'trim|required');
        $this->form_validation->set_rules('outlet_id', 'outlet', 'trim|required');
        $this->form_validation->set_rules('subtotal', 'subtotal', 'trim|required');
        // $this->form_validation->set_rules('discount_total', 'discount total', 'trim|required');
        // $this->form_validation->set_rules('tax', 'tax', 'trim|required');
        $this->form_validation->set_rules('grandtotal', 'grand total', 'trim|required');
        $this->form_validation->set_rules('total_items', 'total items', 'trim|required');
        // $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    

}
