<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Buku extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('elibrary/m_buku');
    }

    public function index()
    {
        $this->load->admin('admin/elibrary/buku/list');
    }

    public function create()
    {
        $this->load->view('admin/elibrary/buku/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/elibrary/buku/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/elibrary/buku/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_buku->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_buku->json();
    }
    public function file($id)
    {
        $gambar = $this->m_buku->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->file;
        }
        $this->load->view('admin/elibrary/buku/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
    public function cover($id)
    {
        $gambar = $this->m_buku->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->cover;
        }
        $this->load->view('admin/elibrary/buku/cover', ['id' => $id, 'action' => 'cover', 'attach' => join(',',$attach),]);
    }
}
