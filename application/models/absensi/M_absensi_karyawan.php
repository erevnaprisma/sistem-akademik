<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_absensi_karyawan extends CI_Model
{
    public $table = 'app_absensi_karyawan';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        ak.*,
                        if(ak.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        app_user.name as user_name,
                        skl.nm_skl,
                        DATE_FORMAT(date_of_entry, '%d/%m/%Y %H:%i:%s') as date_of_entry_name,
                        DATE_FORMAT(date_of_out, '%d/%m/%Y %H:%i:%s') as date_of_out_name 
                        from app_absensi_karyawan ak
                        left join app_user muc on muc.id = ak.created_by
                        left join app_user muu on muu.id = ak.updated_by
                        left join app_user on app_user.id = ak.id_user
                        left join app_skl skl on skl.id = ak.id_skl
                        where ak.is_active != 9 and skl.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, date_of_entry, date_of_out, date_of_entry_name, date_of_out_name, come_late, id_user, user_name, id_skl, nm_skl, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
