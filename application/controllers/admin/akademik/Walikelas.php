<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Walikelas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_walikelas');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/walikelas/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/walikelas/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/walikelas/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/walikelas/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_walikelas->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_walikelas->json();
    }

    public function naik()
    {
        $this->load->view('admin/akademik/walikelas/naik', ['id' => '', 'action' => 'create']);
    }

    public function siswa_baru()
    {
        $this->load->view('admin/akademik/walikelas/siswa_baru', ['id' => '', 'action' => 'create']);
    }
}
