<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lappenilaian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('absensi/m_absensi_siswa');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/lappenilaian/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/lappenilaian/form', ['id' => '', 'action' => 'create']);
    }

    public function read()
    {
        $this->load->view('admin/akademik/lappenilaian/read');
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/lappenilaian/form', ['id' => $id, 'action' => 'update',]);
    }

}
