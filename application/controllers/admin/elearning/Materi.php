<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Materi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('elearning/m_materi');
    }

    public function index()
    {
        $this->load->admin('admin/elearning/materi/list');
    }

    public function create()
    {
        $this->load->view('admin/elearning/materi/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/elearning/materi/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/elearning/materi/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_materi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_materi->json();
    }
    public function file($id)
    {
        $gambar = $this->m_materi->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->file;
        }
        $this->load->view('admin/elearning/materi/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
