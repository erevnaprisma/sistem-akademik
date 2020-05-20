<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Order extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kantin/m_order');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_order->create($_POST),
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
            'data' => $this->m_order->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_order->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function updateotlet_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_order->update($_POST, $_POST['id']),
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
            'data' => $this->m_order->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_order->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {

        $this->form_validation->set_rules('customer_id', 'customer', 'trim|required');
        // $this->form_validation->set_rules('customer_name', 'customer name', 'trim|required');
        // $this->form_validation->set_rules('customer_email', 'customer email', 'trim|required');
        // $this->form_validation->set_rules('customer_mobile', 'customer mobile', 'trim|required');
        $this->form_validation->set_rules('outlet_id', 'outlet', 'trim|required');
        // $this->form_validation->set_rules('outlet_name', 'outlet name', 'trim|required');
        // $this->form_validation->set_rules('outlet_address', 'outlet address', 'trim|required');
        // $this->form_validation->set_rules('outlet_contact', 'outlet contact', 'trim|required');
        // $this->form_validation->set_rules('outlet_receipt_footer', 'outlet receipt footer', 'trim|required');
        // $this->form_validation->set_rules('gift_card', 'gift card', 'trim|required');
        $this->form_validation->set_rules('subtotal', 'subtotal', 'trim|required');
        // $this->form_validation->set_rules('discount_total', 'discount total', 'trim|required');
        // $this->form_validation->set_rules('discount_percentage', 'discount percentage', 'trim|required');
        // $this->form_validation->set_rules('tax', 'tax', 'trim|required');
        $this->form_validation->set_rules('grandtotal', 'grandtotal', 'trim|required');
        $this->form_validation->set_rules('total_items', 'total_items', 'trim|required');
        $this->form_validation->set_rules('payment_method', 'payment method', 'trim|required');
        $this->form_validation->set_rules('payment_method_name', 'payment method name', 'trim|required');
        // $this->form_validation->set_rules('cheque_number', 'cheque number', 'trim|required');
        // $this->form_validation->set_rules('paid_amt', 'paid amt', 'trim|required');
        // $this->form_validation->set_rules('return_change', 'return change', 'trim|required');
        // $this->form_validation->set_rules('vt_status', 'vt status', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');
        // $this->form_validation->set_rules('refund_status', 'refund status', 'trim|required');
        // $this->form_validation->set_rules('remark', 'remark', 'trim|required');
        // $this->form_validation->set_rules('card_number', 'card_number', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    public function getcountorder_post()
    {
        // header('Content-Type: application/json');
        $this->set_response($this->m_order->getcountorder(), REST_Controller::HTTP_OK);
    }

}
