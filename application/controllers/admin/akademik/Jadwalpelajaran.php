<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jadwalpelajaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_jadwalpelajaran');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/jadwalpelajaran/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/jadwalpelajaran/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/jadwalpelajaran/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/jadwalpelajaran/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_jadwalpelajaran->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_jadwalpelajaran->json();
    }
}
