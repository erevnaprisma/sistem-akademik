<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ekskul_kelas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kesiswaan/m_ekskul_kelas');
    }

    public function index()
    {
        $this->load->admin('admin/kesiswaan/ekskul_kelas/list');
    }

    public function detail($id_penilaian)
    {
        $this->load->admin('admin/kesiswaan/ekskul_kelas/detail', ['id_penilaian' => $id_penilaian, 'action' => 'create']);
    }

    public function create($id_penilaian)
    {
        $this->load->view('admin/kesiswaan/ekskul_kelas/form', ['id' => '', 'id_penilaian' => $id_penilaian, 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kesiswaan/ekskul_kelas/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id, $id_penilaian)
    {
        $this->load->view('admin/kesiswaan/ekskul_kelas/form', ['id' => $id, 'id_penilaian' => $id_penilaian, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_ekskul_kelas->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_ekskul_kelas->json();
    }
}
