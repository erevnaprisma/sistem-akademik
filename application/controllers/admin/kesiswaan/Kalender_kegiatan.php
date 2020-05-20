<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kalender_kegiatan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kesiswaan/m_kalender_kegiatan');
    }

    public function index()
    {
        $this->load->admin('admin/kesiswaan/kalender_kegiatan/list');
    }

    public function create()
    {
        $this->load->view('admin/kesiswaan/kalender_kegiatan/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kesiswaan/kalender_kegiatan/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kesiswaan/kalender_kegiatan/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kalender_kegiatan->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_kalender_kegiatan->json();
    }
}
