<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Psb extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anjungan/m_psb');
        $this->load->model('anjungan/m_psbfile');
    }

    public function index()
    {
        $this->load->admin('admin/anjungan/psb/list');
    }

    public function create()
    {
        $this->load->view('admin/anjungan/psb/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/anjungan/psb/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/anjungan/psb/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_psb->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_psb->json();
    }
    public function file($id)
    {
        $gambar = $this->m_psbfile->read(['id_psb'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->file;
        }
        $this->load->view('admin/anjungan/psb/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
    
}
