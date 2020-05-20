<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kodegl extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_kodegl');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/kodegl/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/kodegl/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/kodegl/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/kodegl/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kodegl->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_kodegl->json();
    }
}
