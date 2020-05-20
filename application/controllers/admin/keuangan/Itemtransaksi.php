<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Itemtransaksi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_itemtransaksi');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/itemtransaksi/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/itemtransaksi/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/itemtransaksi/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/itemtransaksi/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_itemtransaksi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_itemtransaksi->json();
    }
}
