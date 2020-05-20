<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_tahunbuku extends CI_Model
{
    public $table = 'app_tahun_buku';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        atb.*,
                        if(atb.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from app_tahun_buku atb
                        left join app_user muc on muc.id = atb.created_by
                        left join app_user muu on muu.id = atb.updated_by
                        left join app_skl ask on ask.id = atb.id_skl
                        where atb.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,tahun,is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
        // $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');

        return $this->datatables->generate();
    }
}
