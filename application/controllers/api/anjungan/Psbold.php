<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Psb extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('anjungan/m_psb');
        $this->load->model('anjungan/m_psbfile');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_psb->create($_POST),
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
            'data' => $this->m_psb->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_psb->update($_POST, $_POST['id']),
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
            'data' => $this->m_psb->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_psb->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        // $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('nama_siswa', 'nama_siswa', 'trim|required');
        $this->form_validation->set_rules('jk', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('angkatan', 'angkatan', 'trim|required');
        $this->form_validation->set_rules('hp_ortu_1', 'hp_ortu_1', 'trim|required');
        $this->form_validation->set_rules('email_ortu_1', 'email_ortu_1', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function file_post($id)
    {
            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'psb/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['id_psb'] = $id;
            $_POST['file'] = $name;

            $this->set_response([
                'data' => $this->m_psbfile->create($_POST),
            ], REST_Controller::HTTP_OK);
    }

    public function deletefile_post($id)
    {
        $id_ori = explode('_',$id)[0];
        $this->m_psbfile->update(['file'=>''], $id);
    }
    public function deletecover_post($id)
    {
        $id_ori = explode('_',$id)[0];
        $this->m_psbfile->update(['cover'=>''], $id);
    }

}
