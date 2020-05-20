<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class Absensitap extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        // authToken($this);
        validPost($this);

        // $this->load->model('absensi/m_absensi_siswa_main');
        // $this->load->model('master/m_user');
    }

    public function tap_post()
    {
        $body = '';
        $date_of_entry = $_POST['date_of_entry'];
        $id_siswa = $_POST['id_siswa'];
        $cek = $this->db->query("
            SELECT * FROM app_absensi_siswa2 
            where date(date_of_entry) = date('$date_of_entry') 
            and id_siswa = '$id_siswa' 
        ")->result_array();

        if($cek){
            // Ayah/bunda, Ananda sudah pulang pk 04/10/2019 11:02:25 sambut dengan pelukan hangat serta suasana penuh cinta ya..
            $body = 'Ayah/Bunda, Ananda sudah pulang pk. '.date('d/m/Y H:i:s',strtotime($date_of_entry)).' sambut dengan pelukan hangat serta suasana penuh cinta ya..';
            $this->db->update('app_absensi_siswa2',[
                "date_of_out"=>$date_of_entry, 
            ], ['id' => $cek[0]['id']]);
        } else {
            // Ayah/Bunda, Ananda tiba disekolah pk. 04/10/2019 10.56.22. Do'akan Ananda ya..
            $body = 'Ayah/Bunda, Ananda tiba disekolah pk. '.date('d/m/Y H:i:s',strtotime($date_of_entry)).". Do'akan Ananda ya..";
            $this->db->insert('app_absensi_siswa2',[
                "date_of_entry"=>$date_of_entry, 
                "id_siswa"=>$id_siswa, 
                "data_post" => json_encode($_POST),
            ]);
        }

        $user = $this->db->query("
        SELECT apu.id_device,aps.nama_siswa FROM app_siswa aps 
        left join app_user apu on apu.id = aps.id_user
        WHERE aps.id_card = '$id_siswa'
        ")->result_array();
        
        if($user && !empty($user[0]['id_device'])){


            $params = [
                [
                    "to"=>$user[0]['id_device'],
                    "title" =>'Absensi ' . $user[0]['nama_siswa'],
                    "sound"=>"default",
                    // "body"=>$absen . ' pukul ' . date('d/m/Y H:i:s',strtotime($date_of_entry)),
                    "body"=> $body
                ]
            ];
            $notif = push_notification_expo($params);
            
            $params[0]['id_user'] = $id_siswa;
            $params[0]['created_dt'] = date('Y-m-d H:i:s');
            
            $this->db->insert_batch('trx_notip', $params); 
            // $CI->db->from($table);

        }

        $this->set_response([
            'message' => 'success'
        ], REST_Controller::HTTP_OK);
    }
}