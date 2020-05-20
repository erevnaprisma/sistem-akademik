<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Hasilnilai extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_hasilnilai');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/hasilnilai/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/hasilnilai/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/hasilnilai/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/hasilnilai/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_hasilnilai->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_hasilnilai->json();
    }
}
