<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Learning extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('elearning/m_materi');
    }

    public function index()
    {
        $this->load->admin('admin/elearning/learning/list');
    }

    public function create()
    {
        $this->load->view('admin/elearning/learning/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/elearning/learning/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/elearning/learning/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_materi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_materi->json();
    }
}
