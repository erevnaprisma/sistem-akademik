<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_buatpsb extends CI_Model
{
    public $table = 'app_buatpsb';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                    select
                    abp.*,
                    if(abp.is_active=1,'YES','NO') as is_active_name,
                    ta.tahun,
                    muc.name as created_by_name,
                    muu.name as updated_by_name,
                    DATE_FORMAT(abp.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                    DATE_FORMAT(abp.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                    DATE_FORMAT(abp.mulai, '%d/%m/%Y') as mulai_name,
                    DATE_FORMAT(abp.selesai, '%d/%m/%Y') as selesai_name
                    from app_buatpsb abp
                    left join app_user muc on muc.id = abp.created_by
                    left join app_user muu on muu.id = abp.updated_by
                    left join app_tahun_ajaran ta on ta.id = abp.id_tahun
                    left join app_skl ask on ask.id = abp.id_skl
                    where abp.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, 
    id_tahun,
    tahun,
    mulai,
    selesai,
    mulai_name,
    selesai_name,
    is_active, is_active_name,created_dt,created_dt_name,created_by_name,updated_dt,updated_dt_name,updated_by_name';

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
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');
        return $this->datatables->generate();
    }
}
