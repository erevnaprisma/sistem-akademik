<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Forum extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('forum/m_forum');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_forum->create($_POST),
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
            'data' => $this->m_forum->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_forum->update($_POST, $_POST['id']),
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
            'data' => $this->m_forum->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_forum->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('content', 'konten', 'trim|required');
        // $this->form_validation->set_rules('view', 'view', 'trim|required');
        // $this->form_validation->set_rules('star', 'star', 'trim|required');
        // $this->form_validation->set_rules('replay', 'replay', 'trim|required');
        $this->form_validation->set_rules('id_forum_type', 'forum type', 'trim|required');
        // $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function file_post($id)
    {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'berbagi/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['foto'] = $name;

            $this->set_response([
                'data' => $this->m_forum->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }

    public function deletefile_post($id)
    {
        $id_ori = explode('_',$id)[0];
        $this->m_forum->update(['foto'=>''], $id);
    }

    public function createandfoto_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {

            $img = $_POST['foto'];
            $path = PUBLIC_ATTACH . 'berbagi/';
            $name = date('YmdHis').generateRandomString();
            $filename = uploadbase64($img,$path,$name);
            $_POST['foto'] = $filename;

            $this->set_response([
                'status' =>1,
                'data' => $this->m_forum->create($_POST),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
