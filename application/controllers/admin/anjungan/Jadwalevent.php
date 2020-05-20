<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jadwalevent extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anjungan/m_jadwalevent');
    }

    public function index()
    {
        $this->load->admin('admin/anjungan/jadwalevent/list');
    }

    public function create()
    {
        $this->load->view('admin/anjungan/jadwalevent/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/anjungan/jadwalevent/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/anjungan/jadwalevent/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_jadwalevent->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_jadwalevent->json();
    }
}
