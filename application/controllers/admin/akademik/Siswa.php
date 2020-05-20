<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Siswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_siswa');
        $this->load->model('akademik/m_datapribadi');
        $this->load->model('akademik/m_dataorangtua');
    }

    public function index()
    {
        $this->load->admin('admin/akademik/siswa/list');
    }

    public function create()
    {
        $this->load->view('admin/akademik/siswa/form', ['id' => '', 'action' => 'create']);
    }

    public function import()
    {
        $this->load->view('admin/akademik/siswa/import', ['id' => '', 'action' => 'import']);
    }

    public function read($id)
    {
        $this->load->view('admin/akademik/siswa/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/akademik/siswa/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_siswa->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_siswa->json();
    }

    public function pribadi($id)
    {
        $datapribadi = $this->m_datapribadi->read(['id_siswa' => $id]);
        $this->load->view('admin/akademik/datapribadi/form', ['id_siswa'=>$id,'id' => ($datapribadi ? $datapribadi[0]->id : ''), 'action' => 'update']);
    }
    public function orangtua($id)
    {
        $dataorangtua = $this->m_dataorangtua->read(['id_siswa' => $id]);
        $this->load->view('admin/akademik/dataorangtua/form', ['id_siswa'=>$id,'id' => ($dataorangtua ? $dataorangtua[0]->id : ''), 'action' => 'update']);
    }
}
