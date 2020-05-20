<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Hasilujian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('elearning/m_ujian');
    }

    public function index()
    {
        $this->load->admin('admin/elearning/hasilujian/list');
    }

    public function create()
    {
        $this->load->view('admin/elearning/hasilujian/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->admin('admin/elearning/hasilujian/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->admin('admin/elearning/hasilujian/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_ujian->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_ujian->json();
    }
}
