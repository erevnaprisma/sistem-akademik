<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_prestasi_siswa extends CI_Model
{
    public $table = 'app_prestasi_siswa';
    public $alias = 'akk';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        akk.*,
                        if(akk.is_active=1,'YES','NO') as is_active_name,
                        kls.nama_kelas, jr.jurusan, sm.semester, sw.nama_siswa,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(tanggal, '%d/%m/%Y') as tanggal_name
                        from app_prestasi_siswa akk
                        left join app_user muc on muc.id = akk.created_by
                        left join app_user muu on muu.id = akk.updated_by
                        left join app_kelas kls on kls.id = akk.id_kelas
                        left join app_jurusan jr on jr.id = akk.id_jurusan
                        left join app_semester sm on sm.id = akk.id_semester
                        left join app_siswa sw on sw.id = akk.id_siswa
                        left join app_skl ask on ask.id = akk.id_skl
                        where akk.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, jurusan, nama_kelas, semester, nama_siswa, tanggal, tanggal_name, prestasi, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
