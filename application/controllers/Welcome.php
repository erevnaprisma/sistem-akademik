<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Welcome extends CI_Controller
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
    }

    public function index()
    {
        redirect(site_url('admin/login'));
        // die('dssdsdsdsd ds');
        // $this->load->view('welcome_index');
    }
    public function logout()
    {
        $this->session->unset_userdata('logged', '');
        redirect(site_url('admin/login'));
    }
}