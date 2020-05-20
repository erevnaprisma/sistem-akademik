<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lapabsenmapel extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('absensi/m_absensi_siswa');
    }

    public function index()
    {
        $this->load->admin('admin/absensi/lapabsenmapel/list');
    }

    public function create()
    {
        $this->load->view('admin/absensi/lapabsenmapel/form', ['id' => '', 'action' => 'create']);
    }

    public function read()
    {
        $this->load->view('admin/absensi/lapabsenmapel/read');
    }

    public function update($id)
    {
        $this->load->view('admin/absensi/lapabsenmapel/form', ['id' => $id, 'action' => 'update',]);
    }


    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_absensi_siswa->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_absensi_siswa->json();
    }
}
