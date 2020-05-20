<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    
    public function carisiswa()
    {
        $this->load->view('data/listsiswa');
    }
    public function cariguru()
    {
        $this->load->view('data/listguru');
    }
    public function caripegawai()
    {
        $this->load->view('data/listpegawai');
    }
    public function cariuser()
    {
        $this->load->view('data/listuser');
    }

    public function show403()
    {
        $this->load->view('errors/html/error_403');
    }
}
