<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kelulusan extends CI_Model
{
    public $table = 'trx_kelulusan';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
            select * from (
                select
                kk.*,
                if(kk.is_active=1,'YES','NO') as is_active_name,
                kls.nama_kelas, jr.jurusan, sm.semester, aus.name as nama_siswa,
                ata.tahun,ask.nm_skl,
                aus.no_induk,aus.email,aus.nisn,
                ajk.name as jenis_kelamin, 
                muc.name as created_by_name,
                muu.name as updated_by_name
                from trx_kelulusan kk
                left join app_user muc on muc.id = kk.created_by
                left join app_user muu on muu.id = kk.updated_by
                left join app_kelas kls on kls.id = kk.id_kelas
                left join app_jurusan jr on jr.id = kk.id_jurusan
                left join app_semester sm on sm.id = kk.id_semester
                left join app_user aus on aus.id = kk.id_siswa
                left join app_tahun_ajaran ata on ata.id = kk.id_tahun
                left join app_skl ask on ask.id = kk.id_skl
                left join app_jk ajk on ajk.id = aus.jk
                where kk.is_active != 9 and ask.is_active = 1
            ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, tahun, nm_skl, jurusan, nama_kelas, semester, nama_siswa, email, no_induk, nisn, jenis_kelamin, status, keterangan, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';
    
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
