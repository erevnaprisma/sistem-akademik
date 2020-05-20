<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Informasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_informasi');
    }

    public function index()
    {
        $this->load->admin('admin/master/informasi/list');
    }

    public function create()
    {
        $this->load->view('admin/master/informasi/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/informasi/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/informasi/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_informasi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_informasi->json();
    }

    public function file($id)
    {
        $gambar = $this->m_informasi->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->file;
        }
        $this->load->view('admin/master/informasi/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }

}
