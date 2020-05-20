<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Outlet extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kantin/m_outlet');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_outlet->create($_POST),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function read_post()
    {
        $this->set_response([
            'data' => $this->m_outlet->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_outlet->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function delete_post($id)
    {
        $this->set_response([
            'data' => $this->m_outlet->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_outlet->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('nama_toko', 'nama_toko', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function uploadfoto($file)
    {
        $config['upload_path'] = "./assets/img/toko/";
        $config['allowed_types'] = 'jpg|png|bmp|gif|jpeg';
        //$config['max_size'] = '5000';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['remove_spaces']=true;
        $config['overwrite']    =true;
        $this->load->library('upload', $config);
        $ftype = explode(".",$file['name']);
        $file['name'] = $ftype;
        if ( ! $this->upload->do_upload('foto'))
        {
                $data= array('status' => 'error', 'error' => $this->upload->display_errors());
                return $data;
        }   
        else
        {   
            $data = array('status'=>'success','error' =>'');
            return $data;
        }
    }
}
