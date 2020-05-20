<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Siswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('forum/m_forum');
    }

    public function index()
    {
        $this->load->admin('admin/forum/forum/list',['id_forum_type'=>FORUM_SISWA,'page'=>FORUM_LABEL_SISWA,]);
    }

    public function create()
    {
        $this->load->view('admin/forum/forum/form', ['id' => '','id_forum_type'=>FORUM_SISWA,'page'=>FORUM_LABEL_SISWA, 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/forum/forum/read', ['id' => $id,'id_forum_type'=>FORUM_SISWA,'page'=>FORUM_LABEL_SISWA, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/forum/forum/form', ['id' => $id,'id_forum_type'=>FORUM_SISWA,'page'=>FORUM_LABEL_SISWA, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_forum->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_forum->json();
    }
    public function file($id)
    {
        $gambar = $this->m_forum->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->foto;
        }
        $this->load->view('admin/forum/forum/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}