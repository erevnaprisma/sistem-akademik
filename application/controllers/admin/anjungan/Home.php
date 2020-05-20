<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anjungan/m_home');
    }

    public function index()
    {
        $this->load->admin('admin/anjungan/home/list');
    }

    public function create()
    {
        $this->load->view('admin/anjungan/home/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/anjungan/home/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/anjungan/home/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_home->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_home->json();
    }
}
