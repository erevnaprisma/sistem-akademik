<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('master/m_user');
    }

    public function create_post()
    {

        $this->form_validation->set_rules('name', 'name', 'trim|required');
        if($_POST['user_type_id']!=USER_TYPE_SUPERADMIN){
            $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        }
        $this->form_validation->set_rules('email', 'email', 'is_unique[app_user.email]|valid_email|trim|required');
        $this->form_validation->set_rules('user_type_id', 'user_type_id', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_repeat', 'Password Repeat', 'required|trim|matches[password]|min_length[6]');
        if ($this->form_validation->run() == true) {
            $_POST['password'] = encriptString($_POST['password']);

            // echo '<pre>';
            // var_dump($_POST); die;

            $id = $this->m_user->create($_POST);

            if($_POST['user_type_id']==USER_TYPE_GURU){
                $_POST['id_user'] = $id;
                $this->db->insert('app_guru', [
                    'id_user' => $id,
                    'is_active' => STATUS_IS_ACTIVE,
                    'created_by' => $id,
                    'created_dt' => date('Y-m-d H:i:s'),
                    'id_skl' => $_POST['id_skl'],
                ]);
            }
    
            if($_POST['user_type_id']==USER_TYPE_SISWA){
                $_POST['id_user'] = $id;
                $this->db->insert('app_siswa', [
                    'id_user' => $id,
                    'nama_siswa' => $_POST['name'],
                    'is_active' => STATUS_IS_ACTIVE,
                    'created_by' => $id,
                    'created_dt' => date('Y-m-d H:i:s'),
                    'id_skl' => $_POST['id_skl'],
                ]);
            }

            $this->set_response([
                'data' => $id,
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
            'data' => $this->m_user->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        if($_POST['user_type_id']!=USER_TYPE_SUPERADMIN){
            $this->form_validation->set_rules('id_skl', 'sekolah', 'trim|required');
        }
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('user_type_id', 'user type', 'trim|required');

        $user = $this->m_user->read(['id' => $_POST['id']]);

        if (isset($user[0]->email) && ($user[0]->email != $_POST['email'])) {
            $this->form_validation->set_rules('email', 'email', 'is_unique[app_user.email]|valid_email|trim|required');
        }
        if ($this->form_validation->run() == true) {

            $this->db->update('app_siswa', [
                'nama_siswa' => $_POST['name'],
                'email' => $_POST['email'],
            ],['id_user' => $_POST['id']]);

            $this->set_response([
                'data' => $this->m_user->update($_POST, $_POST['id']),
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
            'data' => $this->m_user->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_user->json()), REST_Controller::HTTP_OK);
    }

    public function resetpassword_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_repeat', 'Password Repeat', 'required|trim|matches[password]|min_length[6]');
        if ($this->form_validation->run() == true) {
            $_POST['password'] = encriptString($_POST['password']);
            $this->set_response([
                'data' => $this->m_user->update($_POST, $_POST['id']),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function file_post($id)
    {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'user/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['foto'] = $name;

            $this->set_response([
                'data' => $this->m_user->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }
    public function deletefile_post($id)
    {
        $id_ori = explode('_',$id)[0];
        $this->m_user->update(['foto'=>''], $id);
    }

}
