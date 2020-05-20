<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Soalujian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('elearning/m_soalujian');
        $this->load->model('elearning/m_soalujiandetail');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_soalujian->create($_POST),
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
            'data' => $this->m_soalujian->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_soalujian->update($_POST, $_POST['id']),
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
            'data' => $this->m_soalujian->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_soalujian->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {

        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
        $this->form_validation->set_rules('ket', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'tahun ajaran', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'semester', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('id_mapel', 'mapel', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
        $this->form_validation->set_rules('selesai', 'selesai', 'trim|required');
        $this->form_validation->set_rules('durasi', 'durasi', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function pilihanread_post()
    {
        $this->set_response([
            'data' => $this->m_soalujiandetail->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function pilihan_post()
    {
        
        $this->form_validation->set_rules('jawaban', 'jawaban', 'trim|required');
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('pilihan', 'pilihan', 'trim|required');
        $this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'trim|required');
        $this->form_validation->set_rules('id_soalujian', 'id soal ujian', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $_POST['pilihan'] = json_encode($_POST['pilihan']);
        $_POST['flag'] = 'ganda';
        if ($this->form_validation->run() == true) {



            if(!empty($_POST['file'])){
                $img = $_POST['file'];
                $path = PUBLIC_ATTACH . 'soalujian/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['file'] = $filename;
            }

            if(!empty($_POST['id'])){
                $data =  $this->m_soalujiandetail->update($_POST,$_POST['id']);
            } else {
                $data =  $this->m_soalujiandetail->create($_POST);
            }

            $this->set_response([
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    
    public function pilihandelete_post($id)
    {
        $this->set_response([
            'data' => $this->m_soalujiandetail->delete($id),
        ], REST_Controller::HTTP_OK);
    }
    public function pilihanurut_post()
    {
        $this->set_response([
            'data' => $this->m_soalujiandetail->update($_POST,$_POST['id'])
        ], REST_Controller::HTTP_OK);
    }





    public function essay_post()
    {
        
        // $this->form_validation->set_rules('jawaban', 'jawaban', 'trim|required');
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        // $this->form_validation->set_rules('pilihan', 'pilihan', 'trim|required');
        $this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'trim|required');
        $this->form_validation->set_rules('id_soalujian', 'id soal ujian', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $_POST['flag'] = 'essay';
        if ($this->form_validation->run() == true) {
            if(!empty($_POST['file'])){
                $img = $_POST['file'];
                $path = PUBLIC_ATTACH . 'soalujian/';
                $name = date('YmdHis').generateRandomString();
                $filename = uploadbase64($img,$path,$name);
                $_POST['file'] = $filename;
            }

            if(!empty($_POST['id'])){
                $data =  $this->m_soalujiandetail->update($_POST,$_POST['id']);
            } else {
                $data =  $this->m_soalujiandetail->create($_POST);
            }

            $this->set_response([
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }



}
