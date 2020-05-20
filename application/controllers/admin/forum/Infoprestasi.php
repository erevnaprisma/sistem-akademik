<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Infoprestasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('forum/m_infoprestasi');
    }

    public function index()
    {
        $this->load->admin('admin/forum/infoprestasi/list');
    }

    public function create()
    {
        $this->load->view('admin/forum/infoprestasi/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/forum/infoprestasi/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/forum/infoprestasi/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_infoprestasi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_infoprestasi->json();
    }
}
