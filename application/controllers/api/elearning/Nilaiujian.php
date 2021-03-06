<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Nilaiujian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('elearning/m_soalujian');
        $this->load->model('elearning/m_soalujiandetail');
        $this->load->model('elearning/m_ujian');
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


    public function siswaread_post()
    {

        $id_soalujian = $_POST['id_soalujian'];
        $sql = "
            select asu.id,apu.id as id_siswa,aps.no_induk,aps.nama_siswa,sum(aeu.nilai) as sum_nilai,sum(aeu.hasil) as sum_hasil 
            from app_elearning_soalujian asu 
            join app_user apu on apu.id_tahun = asu.id_tahun_ajaran and apu.id_kelas = asu.id_kelas
            left join app_siswa aps on aps.id_user = apu.id
            LEFT join app_elearning_ujian aeu on aeu.id_siswa = apu.id 
            where asu.id = $id_soalujian
            GROUP by apu.id
        ";



        $this->set_response([
            'data' => findAll($sql),
        ], REST_Controller::HTTP_OK);
    }


    public function jawabread_post()
    {
        $this->set_response([
            'data' => $this->m_ujian->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function jawab_post()
    {
        
        // $this->form_validation->set_rules('ganda', 'ganda', 'trim|required');
        $this->form_validation->set_rules('id_soalujian', 'id soal ujian', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        // $_POST['flag'] = 'ganda';
        if ($this->form_validation->run() == true) {
            $cek = $this->m_ujian->read([
                "id_soalujiandetail" => $_POST['id_soalujiandetail'],
                "id_siswa" =>  $_POST['id_siswa'],
                "is_active" => STATUS_IS_ACTIVE
            ]);

            if($cek){
                $data =  $this->m_ujian->update($_POST,$cek[0]->id);
            } else {
                $data =  $this->m_ujian->create($_POST);
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
