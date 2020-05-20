<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Todo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard/m_todo');
    }

    public function index()
    {
        $this->load->admin('admin/dashboard/todo/list');
    }

    public function create()
    {
        $this->load->view('admin/dashboard/todo/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/dashboard/todo/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/dashboard/todo/form', ['id' => $id, 'action' => 'update']);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_todo->json();
    }
}
