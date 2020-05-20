<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Karaktersiswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_karaktersiswa');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/karaktersiswa/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/karaktersiswa/form', ['id' => '', 'flag'=>$_GET['flag'], 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/karaktersiswa/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/karaktersiswa/form', ['id' => $id, 'flag'=>$_GET['flag'], 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_kalendersiswa->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_karaktersiswa->json();
    }
}
