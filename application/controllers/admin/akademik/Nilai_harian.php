<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilai_harian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_nilai_harian');
    }

    public function index($id_nilai_siswa)
    {
        $this->load->admin('admin/akademik/nilai_harian/list', ['id_nilai_siswa' => $id_nilai_siswa]);
    }

    public function create($id_nilai_siswa)
    {
        $this->load->view('admin/akademik/nilai_harian/form', ['id' => '', 'id_nilai_siswa' => $id_nilai_siswa, 'action' => 'create']);
    }

    public function read($id, $id_nilai_siswa)
    {
        $this->load->view('admin/akademik/nilai_harian/read', ['id' => $id, 'id_nilai_siswa' => $id_nilai_siswa, 'action' => 'read']);
    }

    public function update($id, $id_nilai_siswa)
    {
        $this->load->view('admin/akademik/nilai_harian/form', ['id' => $id, 'id_nilai_siswa' => $id_nilai_siswa, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_nilai_harian->delete($id)]);
    }

    public function json($id_nilai_siswa)
    {
        header('Content-Type: application/json');
        echo $this->m_nilai_harian->json($id_nilai_siswa);
    }
}
