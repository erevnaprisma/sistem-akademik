<?php 

class Backup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('m_backup');
        // die('dsadasdas');
    }

    public function backup_db()
    {

        $res = 'backup failed';
        $this->load->dbutil();

        $prefs = array(     
            'format'      => 'zip',             
            'filename'    => 'adminsiedu.sql'
        );


        $backup = $this->dbutil->backup($prefs); 

        $db_name = date("YmdHis") .'.zip';
        $path = '/assets/backup/';


        if (!is_dir(FCPATH.$path)) {
            mkdir(FCPATH.$path, 755, true);
        }

        $this->load->helper('file');
        if(write_file(FCPATH.$path . $db_name, $backup)){
            $this->m_backup->create([
                "name" => $path . $db_name,
                "date" => date('Y-m-d H:i:s'),
                // "status" => 0,
            ]);
            $res = 'backup success';
        } 
        echo $res;



        // $this->load->helper('download');
        // force_download($db_name, $backup);

    }

    public function notipjatuhtempo()
    {

        // kalo mau nambah 2 hari 
        // and date(ait.alert_date) = date(NOW() + INTERVAL 2 DAY)
        $params = [];
        $cekItemTransaksi = findAll("
            select 
            * 
            from app_item_transaksi ait
            where ait.is_active = 1 and date(ait.alert_date) = date(NOW() + INTERVAL 2 DAY)
        ");

        $title = "Penagihan Pembayaran";
        $body = "Mohon segera melakukan pembayaran [item_transaksi] sebesar Rp. [nominal] karena akan jatuh tempo pada tanggal [tgl_jatuh_tempo]. Terimakasih.";

        foreach ($cekItemTransaksi as $a => $b) {
            $sqlDetail = FindAll("
                SELECT tkd.*,aus.id,aus.id_device,aus.id_skl,ask.pn_title,ask.pn_content
                from app_user aus
                left join trx_keuangan tku on tku.id_siswa = aus.id
                left join trx_keuangan_detail tkd on tkd.id_keuangan = tku.id
                left join app_skl ask on ask.id = aus.id_skl
                where aus.is_active = 1 and aus.user_type_id = 4 and aus.id_device !='' and aus.id_skl =$b->id_skl and (tkd.id_itemtransaksi !=$b->id or tkd.id is null)
            ");
            foreach ($sqlDetail as $c => $d) {

                if(!empty($d->pn_title)){
                    $title = $d->pn_title;
                }

                if(!empty($d->pn_content)){
                    $body = $d->pn_content;
                }

                $body = str_replace(["[item_transaksi]","[nominal]","[tgl_jatuh_tempo]"], [$b->pembayaran,number_format($b->nominal),date('d/m/Y',strtotime($b->alert_date))], $body);

                $params[] = [
                    "to"=>$d->id_device,
                    "title" =>$title,
                    "sound"=>"default",
                    "body"=> $body,
                ];
            }
        }


        if(count($params)>0){

            $arr = [];
            $par = [];
            foreach ($params as $e => $f) {
                $arr[$e] = $f;
                $par[$e] = $f;
                $par[$e]['created_by'] = 0;
                $par[$e]['created_dt'] = date('Y-m-d H:i:s');

            }
            $this->db->insert_batch('trx_notip', $par); 
            push_notification_expo($arr);

            // echo '<pre>';
            // var_dump($arr); 
            // var_dump($par); 
            // die;


            // $notif = push_notification_expo($params);
            // $params[0]['created_by'] = getCreatedById();
            // $params[0]['created_by'] = 0;
            // $params[0]['created_dt'] = date('Y-m-d H:i:s');
            // $this->db->insert_batch('trx_notip', $params); 
            echo 'Notip true';
        }
        echo 'Notip false';
        // die('adsadasd');

    }
}    
?>