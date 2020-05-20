<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Pindah_sekolah extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('akademik/m_pindah_sekolah');
    }

    public function create_post()
    {
        $ready = "";
        $cek =  $this->m_pindah_sekolah->read([
            "id_skl" => $_POST["id_skl"],
            "id_siswa" => $_POST["id_siswa"],
        ]);
        if ($cek) {
            $ready = "|is_unique[trx_pindah_sekolah.id_siswa]";
        }
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('id_tahun', 'tahun', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'siswa', 'trim|required'.$ready);
        // $this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
        // $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        // $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_pindah_sekolah->create($_POST),
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
            'data' => $this->m_pindah_sekolah->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        // $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim|required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim|required');
        $this->form_validation->set_rules('id_semester', 'id_semester', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim|required');
        $this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $user = $this->m_pindah_sekolah->read(['id' => $_POST['id']]);
        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_pindah_sekolah->update($_POST, $_POST['id']),
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
            'data' => $this->m_pindah_sekolah->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_pindah_sekolah->json()), REST_Controller::HTTP_OK);
    }
}
