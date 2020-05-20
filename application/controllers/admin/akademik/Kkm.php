<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kkm extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_kkm');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/kkm/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/kkm/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/kkm/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/kkm/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kkm->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_kkm->json();
    }
    public function file($id)
    {
        $gambar = $this->m_kkm->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->file;
        }
        $this->load->view('admin/akademik/kkm/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
