<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Forumtype extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_forumtype');
    }

    public function index()
    {
        $this->load->admin('admin/master/forumtype/list');
    }

    public function create()
    {
        $this->load->view('admin/master/forumtype/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/forumtype/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/forumtype/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_forumtype->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_forumtype->json();
    }
}
