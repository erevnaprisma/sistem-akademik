<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pos extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kantin/m_outlet');
    }

    public function index()
    {
        $this->load->admin('admin/kantin/pos/list');
    }

    public function create()
    {
        $this->load->view('admin/kantin/outlet/form', ['id' => '', 'action' => 'create']);
    }

    public function read()
    {
        
        if($_POST){
            $id_user = $this->input->post("id_user");
            $user_type = $this->input->post("user_type");
            $id_skl = $this->input->post("id_skl");
            if($user_type == "KANTIN"){
                $x = $this->m_outlet->getData($id_user,$id_skl);
            }else{
                $x = $this->m_outlet->getData($id_user,$id_skl);
            }
            echo json_encode($x);
        }
        //$this->load->view('admin/kantin/outlet/read', ['id' => $id, 'action' => 'read']);
    }

    public function update($id)
    {
        $this->load->view('admin/kantin/outlet/form', ['id' => $id, 'action' => 'update']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        echo json_encode(["data"=>$this->m_outlet->delete($id)]);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_outlet->json();
    }

    public function listing($id){
        $this->load->pos('admin/kantin/pos/order',['id' => $id]);
        // $this->load->view('admin/kantin/pos/order');
    }
    public function cetak($id)
    {
        $this->load->cetak('admin/kantin/pos/cetak', ['id' => $id,]);
    }
}
