<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_user');
    }

    public function index()
    {
        if(isset($this->session->userdata('logged')['token'])){
            redirect(site_url('admin/home/index'));
            // $this->load->admin('admin/dashboard/index');
        } else {
            $this->session->unset_userdata('logged', '');
            $this->load->view('admin/login/index');
        }

    }

    public function session()
    {
        // $this->session->set_userdata('logged', $_POST);
    }

    public function changepassword($id)
    {
        $this->load->view('admin/login/changepassword', ['id' => $id, 'action' => 'changepassword']);
    }
}
