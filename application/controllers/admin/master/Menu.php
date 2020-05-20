<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Menu extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_menu');
    }

    public function index()
    {
        $this->load->admin('admin/master/menu/list');
    }

    public function create()
    {
        $this->load->view('admin/master/menu/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/menu/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/menu/form', ['id' => $id, 'action' => 'update']);
    }

    public function action($id)
    {
        $this->load->view('admin/master/menu/actionform', ['id' => $id, 'action' => 'createaction']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_menu->delete($id)]);
    }

    public function reorder()
    {
        $this->load->view('admin/master/menu/reorder', ['action' => 'reorder']);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_menu->json();
    }
}
