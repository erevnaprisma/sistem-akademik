<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Product extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('kantin/m_product');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_product->create($_POST),
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
            'data' => $this->m_product->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_product->update($_POST, $_POST['id']),
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
            'data' => $this->m_product->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_product->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('code', 'code', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('purchase_price', 'purchase_price', 'trim|required');
        $this->form_validation->set_rules('retail_price', 'retail_price', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'id_skl', 'trim|required');
        $this->form_validation->set_rules('id_toko', 'id_toko', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function uploadfoto($file)
    {
        $config['upload_path'] = "./assets/img/product/";
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

    public function file_post($id)
    {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'product/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['foto'] = $name;

            $this->set_response([
                'data' => $this->m_product->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }

    public function deletefile_post($id)
    {
        $id_ori = explode('_',$id)[0];
        $this->m_product->update(['foto'=>''], $id);
    }




    public function createandfoto_post()
    {
        $this->_rules();
        if ($this->form_validation->run() == true) {
            
            $img = $_POST['foto'];
            $path = PUBLIC_ATTACH . 'product/';
            $name = date('YmdHis').generateRandomString();
            $filename = uploadbase64($img,$path,$name);
            $_POST['foto'] = $filename;

            if(!empty($_POST['id'])){
                $data = $this->m_product->update($_POST, $_POST['id']);
            } else {
                $data = $this->m_product->create($_POST);
            }

            $this->set_response([
                'status' => 1,
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
