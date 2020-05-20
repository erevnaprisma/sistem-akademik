<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Transaksikeuangan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('keuangan/m_transaksikeuangan');
    }

    public function index()
    {
        $this->load->admin('admin/keuangan/transaksikeuangan/list');
    }

    public function create()
    {
        $this->load->view('admin/keuangan/transaksikeuangan/form', ['id' => '', 'action' => 'create']);
    }

    public function read($id)
    {
        $this->load->view('admin/keuangan/transaksikeuangan/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/keuangan/transaksikeuangan/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_transaksikeuangan->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_transaksikeuangan->json();
    }

    public function cetak($id)
    {
        $this->load->cetak('admin/keuangan/transaksikeuangan/cetak', ['jurnal' => $id,]);
    }

    public function kas()
    {
        $this->load->admin('admin/keuangan/transaksikeuangan/kas', ['id' => '', 'action' => 'kas']);
    }
    public function keluar()
    {
        $this->load->admin('admin/keuangan/transaksikeuangan/keluar', ['id' => '', 'action' => 'keluar']);
    }
    public function masuk()
    {
        $this->load->admin('admin/keuangan/transaksikeuangan/masuk', ['id' => '', 'action' => 'masuk']);
    }
    public function spp()
    {
        $this->load->admin('admin/keuangan/transaksikeuangan/spp', ['id' => '', 'action' => 'siswa']);
    }
}
