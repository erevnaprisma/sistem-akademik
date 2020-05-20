<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Masuk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_transaksikeuangan');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/masuk/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/masuk/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/masuk/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/masuk/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_transaksikeuangan->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_transaksikeuangan->json();
    }
}
