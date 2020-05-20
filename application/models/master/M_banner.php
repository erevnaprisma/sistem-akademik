<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_banner extends CI_Model
{

    public $flaging = [
        'mhome'=>'Mobile Home',
        'mkesiswaan'=>'Mobile Kesiswaan',
        'mforumortu'=>'Mobile Forum Orangtua',
        'mforumsiswa'=>'Mobile Forum Siswa',
        'mforumguru'=>'Mobile Forum Guru',
        'wlogin'=>'Web Login',
    ];

    public $table = 'app_banner';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        abn.*,
                        if(abn.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        if(ask.nm_skl!='',ask.nm_skl,'') as sekolah,
                        DATE_FORMAT(abn.tanggal_mulai, '%d/%m/%Y %H:%i:%s') as tanggal_mulai_name,
                        DATE_FORMAT(abn.tanggal_selesai, '%d/%m/%Y %H:%i:%s') as tanggal_selesai_name,
                        DATE_FORMAT(abn.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(abn.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
                        from app_banner abn
                        left join app_user muc on muc.id = abn.created_by
                        left join app_user muu on muu.id = abn.updated_by
                        left join app_skl ask on ask.id = abn.id_skl
                        where abn.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, flag, tanggal_mulai, tanggal_selesai, tanggal_mulai_name, tanggal_selesai_name, note, foto,sekolah,id_skl,
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
        if(isset($_POST['flag'])){
            $this->datatables->where('mst.flag = "'.$_POST['flag'].'"');
        }

        return $this->datatables->generate();
    }
}
