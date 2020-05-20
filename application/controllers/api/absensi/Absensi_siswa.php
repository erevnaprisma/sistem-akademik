<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Absensi_siswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('absensi/m_absensi_siswa');
        $this->load->model('absensi/m_get_siswa');
        $this->load->model('absensi/m_get_guru');
    }

    public function create_post()
    {
        $this->form_validation->set_rules('date_of_entry', 'date_of_entry', 'trim|required');
        $this->form_validation->set_rules('date_of_out', 'date_of_out', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        $this->form_validation->set_rules('id_mapel', 'id_mapel', 'trim|required');
        $this->form_validation->set_rules('id_guru', 'id_guru', 'trim|required');
        // $this->form_validation->set_rules('ket', 'ket', 'trim|required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'id_skl', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_absensi_siswa->create($_POST),
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
            'data' => $this->m_absensi_siswa->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('date_of_entry', 'date_of_entry', 'trim|required');
        //$this->form_validation->set_rules('date_of_out', 'date_of_out', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        $this->form_validation->set_rules('id_mapel', 'id_mapel', 'trim|required');
        $this->form_validation->set_rules('id_guru', 'id_guru', 'trim|required');
        //$this->form_validation->set_rules('ket', 'ket', 'trim|required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'id_skl', 'trim|required');
        $user = $this->m_absensi_siswa->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_absensi_siswa->update($_POST, $_POST['id']),
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
            'data' => $this->m_absensi_siswa->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_absensi_siswa->json()), REST_Controller::HTTP_OK);
    }

    public function get_siswa_post(){
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_get_siswa->json()), REST_Controller::HTTP_OK);
    }

    public function get_guru_post(){
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_get_guru->json()), REST_Controller::HTTP_OK);
    }

    public function jurusan_post(){
        $this->set_response([
            'data' => $this->m_absensi_siswa->getJurusan(),
        ], REST_Controller::HTTP_OK);
    }

    public function kelas_post(){
        $this->set_response([
            'data' => $this->m_absensi_siswa->getKelas(),
        ], REST_Controller::HTTP_OK);
    }

    public function mapel_post(){
        $this->set_response([
            'data' => $this->m_absensi_siswa->getMapel(),
        ], REST_Controller::HTTP_OK);
    }

    public function save_post(){
        $this->set_response([
            'data' => $this->m_absensi_siswa->saveAbsen(),
        ], REST_Controller::HTTP_OK);
    }

    public function guru_post(){
        $this->set_response([
            'data' => $this->m_absensi_siswa->getGuru(),
        ], REST_Controller::HTTP_OK);
    }
}
