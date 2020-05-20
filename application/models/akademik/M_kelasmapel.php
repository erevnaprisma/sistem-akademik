<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kelasmapel extends CI_Model
{
    public $table = 'app_kel_mapel';
    public $alias = 'akm';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select * from (
                            select
                            akm.*,
                            if(akm.is_active=1,'YES','NO') as is_active_name,
                            muc.name as created_by_name,
                            muu.name as updated_by_name,
                            amp.name as mapel_name,
                            ata.tahun,
                            asm.semester,
                            ajr.jurusan,
                            apk.nama_kelas 
                            from app_kel_mapel akm
                            left join app_user muc on muc.id = akm.created_by
                            left join app_user muu on muu.id = akm.updated_by
                            left join app_jurusan ajr on ajr.id = akm.id_jurusan
                            left join app_mapel amp on amp.id = akm.id_mapel
                            left join app_semester asm on asm.id = akm.id_semester
                            left join app_kelas apk on apk.id = akm.id_kls
                            left join app_tahun_ajaran ata on ata.id = akm.id_tahun_ajaran
                            left join app_skl ask on ask.id = akm.id_skl
                            where akm.is_active in(0,1) and ask.is_active = 1
                        ) as akm
    ";
    public $where = [];
    public $add_params = [
    ];

    public $select = 'id, tahun, tingkat, jurusan, semester, id_tahun_ajaran, mapel_name, nama_kelas, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
