<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Sekolah extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        authToken($this);
        validPost($this);
        $this->load->model('master/m_sekolah');
    }

    public function create_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_sekolah->create($_POST),
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
            'data' => $this->m_sekolah->read($_POST),
        ], REST_Controller::HTTP_OK);
    }

    public function update_post()
    {
        $this->_rules();

        if ($this->form_validation->run() == true) {
            $this->set_response([
                'data' => $this->m_sekolah->update($_POST, $_POST['id']),
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
            'data' => $this->m_sekolah->delete($id),
        ], REST_Controller::HTTP_OK);
    }

    public function json_post()
    {
        header('Content-Type: application/json');
        $this->set_response(json_decode($this->m_sekolah->json()), REST_Controller::HTTP_OK);
    }

    public function _rules() 
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $slug = $this->m_sekolah->read(['id' => $_POST['id']]);
            if (isset($slug[0]->slug) && ($slug[0]->slug != $_POST['slug'])) {
                $this->form_validation->set_rules('slug', 'slug', 'is_unique[app_skl.slug]|trim|required');
                $this->form_validation->set_rules('nm_skl', 'sekolah', 'is_unique[app_skl.nm_skl]|trim|required');
            }
        } else {
            $this->form_validation->set_rules('slug', 'slug', 'is_unique[app_skl.slug]|trim|required');
            $this->form_validation->set_rules('nm_skl', 'sekolah', 'is_unique[app_skl.nm_skl]|trim|required');
        }

        $this->form_validation->set_rules('kota', 'kota', 'trim|required');
        // $this->form_validation->set_rules('kepala_sekolah', 'kepala sekolah', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function file_post($id)
    {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'sekolah/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['foto'] = $name;

            $this->set_response([
                'data' => $this->m_sekolah->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }
    public function deletefile_post($id)
    {
        $this->m_sekolah->update(['foto'=>''], $id);
    }

    public function icon_post($id)
    {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'sekolah/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['icon'] = $name;

            $this->set_response([
                'data' => $this->m_sekolah->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }
    public function deleteicon_post($id)
    {
        $this->m_sekolah->update(['icon'=>''], $id);
    }

    public function favicon_post($id)
    {

            ini_set('max_execution_time', 5 * 60);

            $upload = $_FILES['attach']['name'];
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            $path = PUBLIC_ATTACH . 'sekolah/';
            //        $path_thumbs = PUBLIC_ATTACH . 'user/thumbs/';
            $name = $id . '_' . date('YmdHis') . '_' . rand(0, 99999) . '.' . $ext;


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['attach']['tmp_name'], $path . $name);


            $_POST['favicon'] = $name;

            $this->set_response([
                'data' => $this->m_sekolah->update($_POST, $id),
            ], REST_Controller::HTTP_OK);
    }
    public function deletefavicon_post($id)
    {
        $this->m_sekolah->update(['favicon'=>''], $id);
    }
}