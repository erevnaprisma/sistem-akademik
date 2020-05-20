<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Berbagivideo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('forum/m_berbagi');
    }

    public function index()
    {
        $this->load->admin('admin/forum/berbagivideo/list');
    }

    public function create()
    {
        $this->load->view('admin/forum/berbagivideo/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/forum/berbagivideo/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/forum/berbagivideo/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_berbagi->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_berbagi->json();
    }

    public function file($id)
    {
        $gambar = $this->m_berbagi->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->attach;
        }
        $this->load->view('admin/forum/berbagivideo/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
