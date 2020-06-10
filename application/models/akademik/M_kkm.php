<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kkm extends CI_Model
{
    public $table = 'app_kkm';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 50;
    public $sql = "
                        select * from (
                            select
                            kkm.*,
                            if(kkm.is_active=1,'YES','NO') as is_active_name,
                            muc.name as created_by_name,
                            muu.name as updated_by_name,
                            mus.name as user_name, 
                            amp.name as mapel_name,
                            asm.semester,
                            ta.tahun,
                            ajr.jurusan,
                            apk.nama_kelas 
                            from app_kkm kkm
                            left join app_user muc on muc.id = kkm.created_by
                            left join app_user muu on muu.id = kkm.updated_by
                            left join app_user mus on mus.id = kkm.id_user
                            left join app_jurusan ajr on ajr.id = kkm.id_jurusan
                            left join app_mapel amp on amp.id = kkm.id_mapel
                            left join app_semester asm on asm.id = kkm.id_semester
                            left join app_kelas apk on apk.id = kkm.id_kls
                            left join app_skl ask on ask.id = kkm.id_skl
                            left join app_tahun_ajaran ta on ta.id = kkm.id_tahun_ajaran
                            where kkm.is_active in(0,1) and ask.is_active = 1
                        ) as mst
    ";
    public $where = [];
    public $add_params = [];
    public $select = 'id, tahun,jurusan, semester, kkm, tingkat, mapel_name, user_name, nama_kelas, file, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
        // $this->datatables->where('mst.is_active in(0,1)');
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');
        return $this->datatables->generate();
    }
}
