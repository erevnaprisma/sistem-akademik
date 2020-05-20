<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pindah_sekolah extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_pindah_sekolah');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/pindah_sekolah/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/pindah_sekolah/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/pindah_sekolah/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/pindah_sekolah/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_pindah_sekolah->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_pindah_sekolah->json();
    }
}
