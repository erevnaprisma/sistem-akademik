<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Detail_prosem extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_detail_prosem');
    }

    public function index($id_prosem)
    {
        $this->load->admin('admin/akademik/detail_prosem/list', ['id_prosem' => $id_prosem]);
    }

    public function create($id_prosem)
    {
        $this->load->view('admin/akademik/detail_prosem/form', ['id' =>'', 'id_prosem' => $id_prosem, 'action' => 'create']);
    }

    public function read($id, $id_prosem)
    {
        $this->load->view('admin/akademik/detail_prosem/read', ['id' => $id, 'id_prosem' => $id_prosem, 'action' => 'read']);
    }

    public function update($id, $id_prosem)
    {
        $this->load->view('admin/akademik/detail_prosem/form', ['id' => $id,  'id_prosem' => $id_prosem, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_detail_prosem->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_detail_prosem->json();
    }
}
