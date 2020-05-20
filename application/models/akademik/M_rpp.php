<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_rpp extends CI_Model
{
    public $table = 'app_rpp';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        rpp.*,
                        if(rpp.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        app_user.name as user_name, 
                        app_mapel.name as mapel_name,
                        app_aka.nama_aka, app_kelas.nama_kelas, app_semester.semester
                        from app_rpp rpp
                        left join app_user muc on muc.id = rpp.created_by
                        left join app_user muu on muu.id = rpp.updated_by
                        left join app_user on app_user.id = rpp.id_user
                        left join app_mapel on app_mapel.id = rpp.id_mapel
                        left join app_aka on app_aka.id = rpp.id_aka
                        left join app_kelas on app_kelas.id = rpp.id_kls
                        left join app_semester on app_semester.id = rpp.id_semester
                        left join app_skl ask on ask.id = rpp.id_skl
                        where  rpp.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, semester, mapel_name, kode, materi, desc, tingkat, user_name, nama_aka, nama_kelas,file, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
