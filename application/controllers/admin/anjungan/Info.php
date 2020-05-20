<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Info extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anjungan/m_info');
        $this->load->model('transaksi/m_dokumen');
    }

    public function index()
    {
        $this->load->admin('admin/anjungan/info/list');
    }

    public function createnote()
    {
        $this->load->view('admin/anjungan/info/form', ['id' => '', 'action' => 'create','hal'=>'note']);
    }
    public function creategaleri()
    {
        $this->load->view('admin/anjungan/info/form', ['id' => '', 'action' => 'create','hal'=>'galeri']);
    }
    public function createvideo()
    {
        $this->load->view('admin/anjungan/info/form', ['id' => '', 'action' => 'create','hal'=>'video']);
    }

    
    public function readnote($id)
    {
        $this->load->view('admin/anjungan/info/read', ['id' => $id, 'action' => 'read','hal'=>'note']);
    }
    public function readgaleri($id)
    {
        $this->load->view('admin/anjungan/info/read', ['id' => $id, 'action' => 'read','hal'=>'galeri']);
    }
    public function readvideo($id)
    {
        $this->load->view('admin/anjungan/info/read', ['id' => $id, 'action' => 'read','hal'=>'video']);
    }

    public function updatenote($id)
    {
        $this->load->view('admin/anjungan/info/form', ['id' => $id, 'action' => 'update','hal'=>'note']);
    }
    public function updategaleri($id)
    {
        $this->load->view('admin/anjungan/info/form', ['id' => $id, 'action' => 'update','hal'=>'galeri']);
    }
    public function updatevideo($id)
    {
        $this->load->view('admin/anjungan/info/form', ['id' => $id, 'action' => 'update','hal'=>'video']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_info->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_info->json();
    }

    public function dokumen($id)
    {
        $detail = $this->m_info->read(['id'=>$id]);
        $gambar = $this->m_dokumen->read(['id_trx'=>$id,'flag'=>DOKUMEN_DOK,'is_active'=>STATUS_IS_ACTIVE]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->name;
        }
        $this->load->view(
            'admin/anjungan/info/upload', 
            [
                'id' => $id, 
                'action' => 'create', 
                'flag'=>DOKUMEN_DOK,
                'detail' => (object) isset($detail[0]) ? $detail[0] : [],
                'attach' => join(',',$attach),
            ]
        );
    }

    public function gambar($id)
    {
        $detail = $this->m_info->read(['id'=>$id]);
        $gambar = $this->m_dokumen->read(['id_trx'=>$id,'flag'=>DOKUMEN_IMG,'is_active'=>STATUS_IS_ACTIVE]);
        $attach = [];
        foreach ($gambar as $a => $b) {
            $attach[] = $b->name;
        }
        $this->load->view(
            'admin/anjungan/info/upload', 
            [
                'id' => $id, 
                'action' => 'create', 
                'flag'=>DOKUMEN_IMG,
                'detail' => (object) isset($detail[0]) ? $detail[0] : [],
                'attach' => join(',',$attach),
            ]
        );
    }

    public function video($id)
    {
        $detail = $this->m_info->read(['id'=>$id]);
        $video = $this->m_dokumen->read(['id_trx'=>$id,'flag'=>DOKUMEN_VID,'is_active'=>STATUS_IS_ACTIVE]);
        $attach = [];
        foreach ($video as $a => $b) {
            $attach[] = $b->name;
        }
        $this->load->view(
            'admin/anjungan/info/video', 
            [
                'id' => $id, 
                'action' => 'video', 
                'detail' => (object) isset($detail[0]) ? $detail[0] : [],
                'attach' => join(',',$attach),
            ]
        );
    }
}
