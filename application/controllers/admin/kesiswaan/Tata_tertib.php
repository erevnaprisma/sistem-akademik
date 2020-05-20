<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tata_tertib extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kesiswaan/m_tata_tertib');
    }

    public function index()
    {
        $this->load->admin('admin/kesiswaan/tata_tertib/list');
    }

    public function create()
    {
        $this->load->view('admin/kesiswaan/tata_tertib/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kesiswaan/tata_tertib/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kesiswaan/tata_tertib/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_tata_tertib->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_tata_tertib->json();
    }
}
