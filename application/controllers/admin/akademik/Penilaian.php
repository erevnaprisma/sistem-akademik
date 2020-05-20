<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Penilaian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_penilaian');
        $this->load->model('akademik/m_kenaikan_kelas');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/penilaian/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/penilaian/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/penilaian/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/penilaian/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_penilaian->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_penilaian->json();
    }

    public function siswa($id)
    {
        $_POST['id'] = $id;
        $siswa = $this->m_penilaian->read($_POST);
        $this->load->view('admin/akademik/penilaian/siswa', ['id' => $id, 'data'=>$siswa,'action' => 'read']);
    }
}
