<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_laporan');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/laporan/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/laporan/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/laporan/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/laporan/form', ['id' => $id, 'action' => 'update']);
    }
    
    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_laporan->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_laporan->json();
    }
    public function terimaperkelas()
    {
        $this->load->view('admin/keuangan/laporan/terimaperkelas');
    }
}
