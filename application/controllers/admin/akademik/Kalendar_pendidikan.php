<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kalendar_pendidikan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_kalendar_pendidikan');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/kalendar_pendidikan/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/kalendar_pendidikan/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/kalendar_pendidikan/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/kalendar_pendidikan/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kalendar_pendidikan->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_kalendar_pendidikan->json();
    }
}
