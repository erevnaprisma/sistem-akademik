<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Auth extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        // authToken($this);
        validPost($this);

        $this->load->model('master/m_user');
    }

    public function login_post()
    {
        $this->form_validation->set_rules('email', 'email', 'valid_email|trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
        if ($this->form_validation->run() == true) {
            $_POST['is_active'] = STATUS_IS_ACTIVE;
            $_POST['password'] = encriptString($_POST['password']);
            $user = $this->m_user->read($_POST);
            unset($user[0]->password);
            if ($user) {

                // token dari mobile
                if(isset($_POST['token'])){
                    $this->db->update('app_user',[
                        "id_device"=>$_POST['token'], 
                    ], ['id' => $user[0]->id]);

                    $user[0]->id_device = $_POST['token'];
                }
                $dataSession = [
                    'code' => 200,
                    'data' => $user,
                    'token' => AUTHORIZATION::generateToken(['user' => $user, 'timestamp' => now()]),
                ];

                $this->session->set_userdata('logged', $dataSession);


                $this->set_response($dataSession, REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'code' => 404,
                    'data' => [],
                    'message' => 'Email and Password Not Found!',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->set_response([
                'code' => 400,
                // 'error' => $_POST['email'],
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function register_post()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'is_unique[app_user.email]|valid_email|trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_repeat', 'Password Repeat', 'required|trim|matches[password]|min_length[6]');
        if ($this->form_validation->run() == true) {
            $_POST['password'] = encriptString($_POST['password']);
            $this->set_response([
                'data' => $this->m_user->create($_POST),
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'error' => validation_errors_json(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function password_old_check($password_old)
    {
        $old_password_hash = encriptString($password_old);
        $cek_user = $this->m_user->read(['id' => $_POST['id'], 'password' => $old_password_hash]);

        if (!$cek_user) {
            $this->form_validation->set_message('password_old_check', 'Old password not match');

            return false;
        }

        return true;
    }

    public function changepassword_post()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('password_old', 'password old', 'trim|required|min_length[6]|callback_password_old_check');
        $this->form_validation->set_rules('password', 'password new', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_repeat', 'password repeat', 'required|trim|matches[password]|min_length[6]');
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

    public function token_post()
    {
        $headers = cekAuthorization($this->input->request_headers());
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            // $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response([
                    'code' => 200,
                    'currentUser' => $decodedToken,
                    'version' => SET_VERSION_MOBILE,
                ], REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response([
            'code' => 401,
            'error' => 'Unauthorised',
        ], REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function getMultiMenuById_post()
    {
        $read = [];
        if (isset($_POST['id_multi']) && !empty($_POST['id_multi'])) {
            $read = findAll('
                select id,parent_id,menu_id,name,label,default_url,icon
                from app_menu 
                where id in('.$_POST['id_multi'].') and is_active = ' . STATUS_IS_ACTIVE . '
                order by `order`
            ');
        }
        $this->set_response([
            'data' => $read,
        ], REST_Controller::HTTP_OK);
    }

    public function getMultiSchool_post()
    {
        $read = [];
        if (isset($_POST['id_multi']) && !empty($_POST['id_multi'])) {
            $read = findAll('
                select id,parent_id,menu_id,name,label,default_url,icon
                from app_menu 
                where id in('.$_POST['id_multi'].') and is_active = ' . STATUS_IS_ACTIVE . '
            ');
        }
        $this->set_response([
            'data' => $read,
        ], REST_Controller::HTTP_OK);
    }
}
