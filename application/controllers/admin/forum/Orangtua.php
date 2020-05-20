<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orangtua extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('forum/m_forum');
    }

    public function index()
    {
        $this->load->admin('admin/forum/forum/list',['id_forum_type'=>FORUM_ORANGTUA,'page'=>FORUM_LABEL_ORANGTUA,]);
    }

    public function create()
    {
        $this->load->view('admin/forum/forum/form', ['id' => '','id_forum_type'=>FORUM_ORANGTUA,'page'=>FORUM_LABEL_ORANGTUA, 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/forum/forum/read', ['id' => $id,'id_forum_type'=>FORUM_ORANGTUA,'page'=>FORUM_LABEL_ORANGTUA, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/forum/forum/form', ['id' => $id,'id_forum_type'=>FORUM_ORANGTUA,'page'=>FORUM_LABEL_ORANGTUA, 'action' => 'update']);
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
