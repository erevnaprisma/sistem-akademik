<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kegiatan_diluar extends CI_Model
{
    public $table = 'app_kegiatan_diluar';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        akd.*,
                        if(akd.is_active=1,'YES','NO') as is_active_name,
                        kls.nama_kelas, jr.jurusan, sm.semester,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(tanggal, '%d/%m/%Y') as tanggal_name,
                        DATE_FORMAT(akd.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(akd.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        ask.nm_skl as sekolah
                        from app_kegiatan_diluar akd
                        left join app_user muc on muc.id = akd.created_by
                        left join app_user muu on muu.id = akd.updated_by
                        left join app_kelas kls on kls.id = akd.id_kelas
                        left join app_jurusan jr on jr.id = akd.id_jurusan
                        left join app_semester sm on sm.id = akd.id_semester
                        left join app_skl ask on ask.id = akd.id_skl
                        where akd.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, jurusan, nama_kelas, semester, tanggal, tanggal_name, pkl_mulai, pkl_selesai, kegiatan, lokasi, 
    is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
    sekolah,created_dt_name,updated_dt_name
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
