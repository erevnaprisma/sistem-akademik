<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dokumen extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi/m_dokumen');
    }

    public function index()
    {
        $this->load->admin('admin/transaksi/dokumen/list');
    }

    public function create()
    {
        $this->load->view('admin/transaksi/dokumen/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/transaksi/dokumen/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/transaksi/dokumen/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_dokumen->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_dokumen->json();
    }
}




