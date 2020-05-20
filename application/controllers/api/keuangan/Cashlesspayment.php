<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Cashlesspayment extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('keuangan/m_cashlesspayment');
        $this->load->model('master/m_user');
    }

    public function create_post()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == true) {
            $user = $this->m_user->read(['id'=>$_POST['id_user']]);
            if($user){
                if($_POST['trans'] == TRANS_KREDIT){
                    $_POST['saldo'] = $user[0]->saldo + $_POST['nominal'];
                } else {
                    $_POST['saldo'] = $user[0]->saldo - $_POST['nominal'];
                }
                $this->m_user->update(['saldo'=>$_POST['saldo']],$_POST['id_user']);
            }
            $this->set_response([
                'data' => $this->m_cashlesspayment->create($_POST),
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
            'data' => $this->m_cashlesspayment->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_cashlesspayment->update($_POST, $_POST['id']),
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
            'data' => $this->m_cashlesspayment->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_cashlesspayment->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('trans', 'trans', 'trim|required');
        $this->form_validation->set_rules('nominal', 'nominal', 'trim|required');
        $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        $this->form_validation->set_rules('nama_user', 'user', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function trans_post()
    {
        $this->set_response([
            'data' => $this->m_cashlesspayment->trans,
        ], REST_Controller::HTTP_OK);
    }
}
