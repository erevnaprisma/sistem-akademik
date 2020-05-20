<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kode_gl extends CI_Model
{
    public $table = 'app_kode_gl';
    public $alias = 'tbl';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select
                        tbl.*,
                        if(tbl.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        skl.nm_skl
                        from app_kode_gl tbl
                        left join app_user muc on muc.id = tbl.created_by
                        left join app_user muu on muu.id = tbl.updated_by
                        left join app_skl skl on skl.id = tbl.id_skl
    ";
    public $where = [' tbl.is_active != 9 '];
    public $add_params = [
        'created_by_name' => 'muc.name',
        'updated_by_name' => 'muu.name',
    ];

    public $select = 'id, kode, ket, id_skl, nm_skl, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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

        return $this->datatables->generate();
    }
}
