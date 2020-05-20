<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sekolah extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_sekolah');
    }

    public function index()
    {
        $this->load->admin('admin/master/sekolah/list');
    }

    public function create()
    {
        $this->load->view('admin/master/sekolah/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/sekolah/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/sekolah/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_sekolah->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_sekolah->json();
    }
    public function file($id)
    {
        $gambar = $this->m_sekolah->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->foto;
        }
        $this->load->view('admin/master/sekolah/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
    public function icon($id)
    {
        $gambar = $this->m_sekolah->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->icon;
        }
        $this->load->view('admin/master/sekolah/icon', ['id' => $id, 'action' => 'icon', 'attach' => join(',',$attach),]);
    }
    public function favicon($id)
    {
        $gambar = $this->m_sekolah->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->favicon;
        }
        $this->load->view('admin/master/sekolah/favicon', ['id' => $id, 'action' => 'favicon', 'attach' => join(',',$attach),]);
    }
}
