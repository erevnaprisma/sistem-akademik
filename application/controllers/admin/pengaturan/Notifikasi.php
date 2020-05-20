<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Notifikasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_sekolah');
    }

    public function index()
    {
        $this->load->admin('admin/pengaturan/notifikasi/list');
    }

    public function update($id)
    {
        $this->load->view('admin/pengaturan/user/form', ['id' => $id, 'action' => 'update']);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_user->json();
    }
}
