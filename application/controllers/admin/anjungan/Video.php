<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Video extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anjungan/m_video');
    }

    public function index()
    {
        $this->load->admin('admin/anjungan/video/list');
    }

    public function create()
    {
        $this->load->view('admin/anjungan/video/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/anjungan/video/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/anjungan/video/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_video->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_video->json();
    }
    public function file($id)
    {
        $gambar = $this->m_video->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->file;
        }
        $this->load->view('admin/anjungan/video/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
    public function cover($id)
    {
        $gambar = $this->m_video->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->cover;
        }
        $this->load->view('admin/anjungan/video/cover', ['id' => $id, 'action' => 'cover', 'attach' => join(',',$attach),]);
    }
}
