<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pelanggaran_siswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kesiswaan/m_pelanggaran_siswa');
    }

    public function index()
    {
        $this->load->admin('admin/kesiswaan/pelanggaran_siswa/list');
    }

    public function create()
    {
        $this->load->view('admin/kesiswaan/pelanggaran_siswa/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kesiswaan/pelanggaran_siswa/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kesiswaan/pelanggaran_siswa/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_pelanggaran_siswa->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_pelanggaran_siswa->json();
    }
}
