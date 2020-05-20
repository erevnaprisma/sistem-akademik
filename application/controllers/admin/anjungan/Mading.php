<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mading extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anjungan/m_info');
        $this->load->model('transaksi/m_dokumen');
    }

    public function index()
    {
        $this->load->admin('admin/anjungan/mading/list');
    }

    public function createnote()
    {
        $this->load->view('admin/anjungan/mading/form', ['id' => '', 'action' => 'create','hal'=>'madingmadingnote']);
    }
    public function creategaleri()
    {
        $this->load->view('admin/anjungan/mading/form', ['id' => '', 'action' => 'create','hal'=>'madinggaleri']);
    }
    public function createvideo()
    {
        $this->load->view('admin/anjungan/mading/form', ['id' => '', 'action' => 'create','hal'=>'madingvideo']);
    }

    
    public function readnote($id)
    {
        $this->load->view('admin/anjungan/mading/read', ['id' => $id, 'action' => 'read','hal'=>'madingnote']);
    }
    public function readgaleri($id)
    {
        $this->load->view('admin/anjungan/mading/read', ['id' => $id, 'action' => 'read','hal'=>'madinggaleri']);
    }
    public function readvideo($id)
    {
        $this->load->view('admin/anjungan/mading/read', ['id' => $id, 'action' => 'read','hal'=>'madingvideo']);
    }

    public function updatenote($id)
    {
        $this->load->view('admin/anjungan/mading/form', ['id' => $id, 'action' => 'update','hal'=>'madingnote']);
    }
    public function updategaleri($id)
    {
        $this->load->view('admin/anjungan/mading/form', ['id' => $id, 'action' => 'update','hal'=>'madinggaleri']);
    }
    public function updatevideo($id)
    {
        $this->load->view('admin/anjungan/mading/form', ['id' => $id, 'action' => 'update','hal'=>'madingvideo']);
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
            'admin/anjungan/mading/upload', 
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
            'admin/anjungan/mading/upload', 
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
            'admin/anjungan/mading/video', 
            [
                'id' => $id, 
                'action' => 'video', 
                'detail' => (object) isset($detail[0]) ? $detail[0] : [],
                'attach' => join(',',$attach),
            ]
        );
    }
}
