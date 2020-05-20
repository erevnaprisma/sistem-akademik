<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kegiatan_diluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kesiswaan/m_kegiatan_diluar');
    }

    public function index()
    {
        $this->load->admin('admin/kesiswaan/kegiatan_diluar/list');
    }

    public function create()
    {
        $this->load->view('admin/kesiswaan/kegiatan_diluar/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kesiswaan/kegiatan_diluar/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kesiswaan/kegiatan_diluar/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kegiatan_diluar->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_kegiatan_diluar->json();
    }
}
