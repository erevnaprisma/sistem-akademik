<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlyoffice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
        $this->load->view('onlyoffice');
    }
    public function edit()
    {
        if (($body_stream = file_get_contents("php://input"))===FALSE){
            echo "Bad Request";
        }
        
        $data = json_decode($body_stream, TRUE);
        
        if ($data["status"] == 2){
            $downloadUri = $data["url"];
                
            if (($new_data = file_get_contents($downloadUri))===FALSE){
                echo "Bad Response";
            } else {
                file_put_contents($path_for_save, $new_data, LOCK_EX);
            }
        }
        echo "{\"error\":0}";
        // echo '<pre>';
        // var_dump($_POST); die;
    }
}