<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Prosem extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_prosem');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/prosem/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/prosem/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/prosem/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/prosem/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_prosem->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_prosem->json();
    }
    public function file($id)
    {
        $gambar = $this->m_prosem->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->file;
        }
        $this->load->view('admin/akademik/prosem/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
