<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jadwal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('anjungan/m_jadwal');
    }

    public function index()
    {
        $this->load->admin('admin/anjungan/jadwal/list');
    }

    public function create()
    {
        $this->load->view('admin/anjungan/jadwal/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/anjungan/jadwal/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/anjungan/jadwal/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_jadwal->delete($id)]);
    }

    public function json()
    {
        // header('Content-Type: application/json');
        // echo $this->m_jadwal->json();
    }
}
