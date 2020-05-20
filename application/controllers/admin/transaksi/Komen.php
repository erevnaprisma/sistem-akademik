<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Komen extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi/m_komen');
    }

    public function index()
    {
        $this->load->admin('admin/transaksi/komen/list');
    }

    public function create()
    {
        $this->load->view('admin/transaksi/komen/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/transaksi/komen/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/transaksi/komen/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_komen->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_komen->json();
    }
}




