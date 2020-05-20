<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tahunbuku extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_tahunbuku');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/tahunbuku/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/tahunbuku/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/tahunbuku/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/tahunbuku/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_tahunbuku->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_tahunbuku->json();
    }
}
