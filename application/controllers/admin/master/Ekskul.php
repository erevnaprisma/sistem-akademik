<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ekskul extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_ekskul');
    }

    public function index()
    {
        $this->load->admin('admin/master/ekskul/list');
    }

    public function create()
    {
        $this->load->view('admin/master/ekskul/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/ekskul/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/ekskul/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_ekskul->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_ekskul->json();
    }
}
