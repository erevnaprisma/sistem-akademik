<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilai_siswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_nilai_siswa');
    }

    public function index($id_penilaian)
    {
        $this->load->admin('admin/akademik/nilai_siswa/list', ['id' => '', 'id_penilaian' => $id_penilaian]);
    }

    public function create($id_penilaian)
    {
        $this->load->view('admin/akademik/nilai_siswa/form', ['id' => '', 'id_penilaian' => $id_penilaian, 'action' => 'create']);
    }

    public function read($id, $id_penilaian)
    {
        $this->load->view('admin/akademik/nilai_siswa/read', ['id' => $id, 'id_penilaian' => $id_penilaian, 'action' => 'read']);
    }

    public function update($id, $id_penilaian)
    {
        $this->load->view('admin/akademik/nilai_siswa/form', ['id' => $id, 'id_penilaian' => $id_penilaian, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_nilai_siswa->delete($id)]);
    }

    public function json($id_penilaian)
    {
        header('Content-Type: application/json');
        echo $this->m_nilai_siswa->json($id_penilaian);
    }
}
