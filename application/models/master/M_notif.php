<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_notif extends CI_Model
{
    public $flaging = [
        'mhome'=>'Mobile Home',
        // 'mkesiswaan'=>'Mobile Kesiswaan',
        // 'mforumortu'=>'Mobile Forum Orangtua',
        // 'mforumsiswa'=>'Mobile Forum Siswa',
        // 'mforumguru'=>'Mobile Forum Guru',
        'wlogin'=>'Web Login',
    ];
    public $table = 'app_notif';
    public $alias = 'ant';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select
                        ant.*,
                        if(ant.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(ant.tanggal, '%d/%m/%Y %H:%i:%s') as tanggal_name,
                        DATE_FORMAT(ant.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(ant.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        ask.nm_skl as sekolah
                        from app_notif ant
                        left join app_user muc on muc.id = ant.created_by
                        left join app_user muu on muu.id = ant.updated_by
                        left join app_skl ask on ask.id = ant.id_skl
    ";
    public $where = [' ant.is_active != 9 '];
    public $add_params = [
        'created_by_name' => 'muc.name',
        'updated_by_name' => 'muu.name',
    ];

    public $select = '
    id, flag, tanggal, tanggal_name, title, note,
    is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
    created_dt_name,updated_dt_name
    ';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($params = [])
    {
        $params = compareFields('create', $this->table, $params);
        $builder = $this->db->insert($this->table, $params);

        $this->sendnotif($params);
        return $builder ? $this->db->insert_id() : false;
    }

    public function read($params = [])
    {
        //var_dump($this->sql); die;
        $read = readSql($this, $params);

        return $read;
    }

    public function update($params = [], $id)
    {
        $params = compareFields('update', $this->table, $params);
        $builder = $this->db->update($this->table, $params, [$this->id => $id]);
        $this->sendnotif($params);
        return $builder ? $id : false;
    }

    public function delete($id)
    {
        $builder = $this->db->update($this->table, ['is_active' => STATUS_IS_DELETE], [$this->id => $id]);

        return $builder ? $id : false;
    }

    public function json()
    {
        $this->datatables->select($this->select);
        $this->datatables->from('
            (
                '.$this->sql.'
            ) as mst
        ');
        //add this line for join
        $this->datatables->where('mst.is_active in(0,1)');
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');
        if(isset($_POST['flag'])){
            $this->datatables->where('mst.flag = "'.$_POST['flag'].'"');
        }

        return $this->datatables->generate();
    }


    public function sendnotif($params = [])
    {
        if($params['is_active']==STATUS_IS_ACTIVE){
            $sql = "select * from app_user 
            where id_skl = '".$params['id_skl']."' and id_device !='' and is_active = 1";
            $device = findAll($sql);
            if($device){

                $arr = [];
                $par = [];
                foreach ($device as $a => $b) {
                    $parse = [
                        "to"=>$b->id_device,
                        "title" => $params['title'],
                        "sound"=>"default",
                        "body"=> $params['note'],
                    ];
                    $arr[] = $parse;

                    $parse['id_user'] = $b->id;
                    $parse['created_by'] = getCreatedById();
                    $parse['created_dt'] = date('Y-m-d H:i:s');
                    $par[] = $parse;
                }
                $this->db->insert_batch('trx_notip', $par); 
                push_notification_expo($arr);
            }
        }
        return true;
    }
}
