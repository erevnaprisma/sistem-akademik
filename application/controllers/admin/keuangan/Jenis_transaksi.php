<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jenis_transaksi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_jenis_transaksi');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/jenis_transaksi/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/jenis_transaksi/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/jenis_transaksi/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/jenis_transaksi/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_jenis_transaksi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_jenis_transaksi->json();
    }
}
