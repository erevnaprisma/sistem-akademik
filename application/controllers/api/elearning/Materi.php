<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Materi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('elearning/m_materi');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_materi->create($_POST),
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
            'data' => $this->m_materi->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_materi->update($_POST, $_POST['id']),
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
            'data' => $this->m_materi->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_materi->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {

        $this->form_validation->set_rules('materi', 'materi', 'trim|required');
        $this->form_validation->set_rules('ket', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'tahun ajaran', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'semester', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('id_mapel', 'mapel', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function file_post($id)
    {
            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'materi/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['file'] = $name;

            $this->set_response([
                'data' => $this->m_materi->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }

    public function cover_post($id)
    {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'materi/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['cover'] = $name;

            $this->set_response([
                'data' => $this->m_materi->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }

    public function deletefile_post($id)
    {
        $id_ori = explode('_',$id)[0];
        $this->m_materi->update(['file'=>''], $id);
    }
    public function deletecover_post($id)
    {
        $id_ori = explode('_',$id)[0];
        $this->m_materi->update(['cover'=>''], $id);
    }
}
