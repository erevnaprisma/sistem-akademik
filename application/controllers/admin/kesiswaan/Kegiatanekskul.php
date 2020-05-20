<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kegiatanekskul extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kesiswaan/m_kegiatanekskul');
    }

    public function index()
    {
        $this->load->admin('admin/kesiswaan/kegiatanekskul/list');
    }

    public function create()
    {
        $this->load->view('admin/kesiswaan/kegiatanekskul/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kesiswaan/kegiatanekskul/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kesiswaan/kegiatanekskul/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kegiatanekskul->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_kegiatanekskul->json();
    }
}
