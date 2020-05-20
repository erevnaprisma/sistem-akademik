<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Transkip extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_transkip');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/transkip/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/transkip/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/transkip/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/transkip/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_transkip->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_transkip->json();
    }
}
