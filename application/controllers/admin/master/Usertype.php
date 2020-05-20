<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usertype extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_usertype');
    }

    public function index()
    {
        $this->load->admin('admin/master/usertype/list');
    }

    public function create()
    {
        $this->load->view('admin/master/usertype/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/usertype/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/usertype/form', ['id' => $id, 'action' => 'update']);
    }

    public function privilege($id)
    {
        $this->load->view('admin/master/usertype/privilege', ['id' => $id, 'action' => 'privilege']);
    }
    public function menumobile($id)
    {
        $this->load->view('admin/master/usertype/menumobile', ['id' => $id, 'action' => 'menumobile']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_usertype->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_usertype->json();
    }
}
