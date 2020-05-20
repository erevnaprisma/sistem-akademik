<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tahun_ajaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_tahun_ajaran');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/tahun_ajaran/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/tahun_ajaran/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/tahun_ajaran/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/tahun_ajaran/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_tahun_ajaran->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_tahun_ajaran->json();
    }
}
