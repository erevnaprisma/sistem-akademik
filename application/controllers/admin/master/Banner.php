<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Banner extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_banner');
    }

    public function index()
    {
        $this->load->admin('admin/master/banner/list');
    }

    public function create()
    {
        $this->load->view('admin/master/banner/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/banner/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/banner/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_banner->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_banner->json();
    }
    public function file($id)
    {
        $gambar = $this->m_banner->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->foto;
        }
        $this->load->view('admin/master/banner/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
