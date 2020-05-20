<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_data');
    }

    public function index()
    {
        log_message('debug', '[erevna] oke sipp');
    
        $this->load->admin('admin/dashboard/index');
    }

    public function getdashboard()
    {
        header('Content-Type: application/json');
        echo json_encode($this->m_data->getdashboard());
    }

    public function getsekolah()
    {
        header('Content-Type: application/json');
        echo json_encode($this->m_data->getsekolah());
    }
}
