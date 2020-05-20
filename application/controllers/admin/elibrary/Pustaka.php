<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pustaka extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('elibrary/m_pustaka');
    }

    public function index()
    {
        $this->load->admin('admin/elibrary/pustaka/list');
    }

    public function create()
    {
        $this->load->view('admin/elibrary/pustaka/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/elibrary/pustaka/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/elibrary/pustaka/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_pustaka->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_pustaka->json();
    }
}
