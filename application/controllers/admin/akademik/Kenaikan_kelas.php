<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kenaikan_kelas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_kenaikan_kelas');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/kenaikan_kelas/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/kenaikan_kelas/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/kenaikan_kelas/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/kenaikan_kelas/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kenaikan_kelas->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_kenaikan_kelas->json();
    }

    public function naik()
    {
        $this->load->view('admin/akademik/kenaikan_kelas/naik', ['id' => '', 'action' => 'create']);
    }

    public function siswa_baru()
    {
        $this->load->view('admin/akademik/kenaikan_kelas/siswa_baru', ['id' => '', 'action' => 'create']);
    }
}
