<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Soalujian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('elearning/m_soalujian');
    }

    public function index()
    {
        $this->load->admin('admin/elearning/soalujian/list');
    }

    public function create()
    {
        $this->load->view('admin/elearning/soalujian/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/elearning/soalujian/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/elearning/soalujian/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_soalujian->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_soalujian->json();
    }
    public function pilihan($id)
    {
        $this->load->admin('admin/elearning/soalujian/pilihan', ['id' => $id, 'action' => 'pilihan']);
    }
    public function essay($id)
    {
        $this->load->admin('admin/elearning/soalujian/essay', ['id' => $id, 'action' => 'essay']);
    }
}
