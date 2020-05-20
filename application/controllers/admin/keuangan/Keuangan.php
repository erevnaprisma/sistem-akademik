<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Keuangan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_trxkeuangan');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/trx_keuangan/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/trx_keuangan/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/trx_keuangan/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/trx_keuangan/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_trxkeuangan->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_trxkeuangan->json();
    }
    public function cetak($id)
    {
        $this->load->cetak('admin/keuangan/transaksikeuangan/cetak', ['id' => $id,]);
    }
}
