<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kantin/m_product');
    }

    public function index()
    {
        $this->load->admin('admin/kantin/product/list');
    }

    public function create()
    {
        $this->load->view('admin/kantin/product/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/kantin/product/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kantin/product/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_product->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_product->json();
    }

    public function file($id)
    {
        $gambar = $this->m_product->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->foto;
        }
        $this->load->view('admin/kantin/product/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
