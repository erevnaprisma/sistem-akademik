<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Absensi_karyawan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('absensi/m_absensi_karyawan');
    }

    public function index()
    {
        $this->load->admin('admin/absensi/absensi_karyawan/list');
    }

    public function create()
    {
        $this->load->view('admin/absensi/absensi_karyawan/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/absensi/absensi_karyawan/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/absensi/absensi_karyawan/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_absensi_karyawan->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_absensi_karyawan->json();
    }
}
