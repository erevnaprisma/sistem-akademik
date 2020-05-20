<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Katamotivasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('forum/m_katamotivasi');
    }

    public function index()
    {
        $this->load->admin('admin/forum/katamotivasi/list');
    }

    public function create()
    {
        $this->load->view('admin/forum/katamotivasi/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/forum/katamotivasi/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/forum/katamotivasi/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_katamotivasi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_katamotivasi->json();
    }
}
