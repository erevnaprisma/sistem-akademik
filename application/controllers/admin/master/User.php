<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_user');
    }

    public function index()
    {
        $this->load->admin('admin/master/user/list');
    }

    public function create()
    {
        $this->load->view('admin/master/user/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/master/user/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/master/user/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_user->delete($id)]);
    }

    public function resetpassword($id)
    {
        $this->load->view('admin/master/user/form', ['id' => $id, 'action' => 'resetpassword']);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_user->json();
    }
    public function file($id)
    {
        $gambar = $this->m_user->read(['id'=>$id,]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->foto;
        }
        $this->load->view('admin/master/user/file', ['id' => $id, 'action' => 'file', 'attach' => join(',',$attach),]);
    }
}
