<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_sekolah');
        
        $this->load->model('transaksi/m_dokumen');
        $this->load->model('transaksi/m_komen');
        $this->load->model('anjungan/m_info');
        $this->load->model('akademik/m_kalendar_pendidikan');
        $this->load->model('kesiswaan/m_kalender_kegiatan');

        $this->load->model('akademik/m_siswa');

        $this->sekolah = findOne("
            select ask.*,ask.id as id_skl from app_skl ask
            where ask.slug = '".$this->uri->segment(3)."'
        ");
    }

    public function index()
    {
        $this->load->view('absensi');
    }

    



   
}