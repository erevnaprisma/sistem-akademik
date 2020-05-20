<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Tranperpsb extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('anjungan/m_psb');
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
            
            $psb = $this->m_psb->read([
                "id" => $_POST['id'],
                "id_skl" => $_POST['id_skl'],
                "id_tahun" => $_POST['id_tahun'],
            ]);
            if($psb){
                $psb = $psb[0];

                // simpan foto
                copy(PUBLIC_IMAGE . 'psb/'.$psb->foto, PUBLIC_IMAGE . 'user/'.$psb->foto);

                $user = $this->db->query("
                insert into app_user (
                    name, no_induk, jk, hp_siswa, hp_ortu1, hp_ortu2, 
                    foto, id_skl, email, `password`,user_type_id
                )
                select 
                    nama_siswa, nomor, jk, hp_siswa, hp_ortu_1, hp_ortu_2, 
                    foto, id_skl, concat(nomor,'@','".$_POST['slug'].".id'), '".encriptString("si-edu")."','".USER_TYPE_SISWA."' 
                    from app_psb where id = '$psb->id'              
                ");
                $id = $this->db->insert_id();

                $siswa = $this->db->query("
                    insert into app_siswa (nama_siswa, no_induk, jk, hp_siswa, hp_ortu_1, hp_ortu_2, foto, id_skl, id_user, is_psb)
                    select nama_siswa, nomor, jk, hp_siswa, hp_ortu_1, hp_ortu_2, foto, id_skl, '".$id."', 1 from app_psb where id = '$psb->id' 
                ");


            }

            $this->set_response([
                'data' => $this->m_psb->update(['in_siswa'=>'Sudah ditranper'], $_POST['id']),
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
        $this->set_response(json_decode($this->m_psb->diterimajson()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_tahun', 'tahun ajaran', 'trim|required');
        // $this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
        // $this->form_validation->set_rules('selesai', 'selesai', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
