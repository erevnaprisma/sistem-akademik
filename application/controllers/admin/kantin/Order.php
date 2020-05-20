<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kantin/m_order');
    }

    public function index()
    {
        $this->load->admin('admin/kantin/order/list');
    }

    public function create()
    {
        $this->load->view('admin/kantin/order/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kantin/order/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kantin/order/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_order->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_order->json();
    }
}
