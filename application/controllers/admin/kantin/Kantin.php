<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kantin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kantin/m_outlet');
    }

    public function index()
    {
        $this->load->admin('admin/kantin/outlet/list');
    }

    public function create()
    {
        $this->load->view('admin/kantin/outlet/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kantin/outlet/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kantin/outlet/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_outlet->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_outlet->json();
    }
    public function file($id)
    {
        $gambar = $this->m_outlet->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->foto;
        }
        $this->load->view('admin/kantin/outlet/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
