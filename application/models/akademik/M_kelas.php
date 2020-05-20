<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kelas extends CI_Model
{
    public $table = 'app_kelas';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        kls.*,
                        if(kls.is_active=1,'YES','NO') as is_active_name,
                        ajr.jurusan,
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from app_kelas kls
                        left join app_user muc on muc.id = kls.created_by
                        left join app_user muu on muu.id = kls.updated_by
                        left join app_jurusan ajr on ajr.id = kls.id_jurusan
                        left join app_skl ask on ask.id = kls.id_skl
                        where kls.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, jurusan,nama_kelas, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
