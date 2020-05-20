<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }

    public function index()
    {
        $this->load->template('user/list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_user->json();
    }


}