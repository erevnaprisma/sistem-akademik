<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Raport extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_raport');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/raport/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/raport/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/raport/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/raport/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_raport->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_raport->json();
    }

    public function raport($id)
    {
        $this->load->view('admin/akademik/raport/raport', ['id' => $id, 'action' => 'read']);
    }
    public function cetak($id)
    {
        $this->load->cetak('admin/akademik/raport/print', ['id' => $id, 'action' => 'read']);
    }
    public function transkip($id)
    {
        $this->load->cetak('admin/akademik/raport/transkip', ['id' => $id, 'action' => 'read']);
    }
}
