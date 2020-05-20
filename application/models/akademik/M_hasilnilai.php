<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_hasilnilai extends CI_Model
{
    public $table = 'app_hasil_nilai';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from ( select
                        ahn.*,
                        ask.nm_skl as sekolah_name,
                        ajr.jurusan as jurusan_name,
                        asm.semester as semester_name,
                        akl.nama_kelas as kelas_name,
                        if(ahn.is_active=1,'YES','NO') as is_active_name,
                        day(ahn.tanggal) as date_name,
                        month(ahn.tanggal) as month_name,
                        year(ahn.tanggal) as year_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from app_hasil_nilai ahn
                        left join app_skl ask on ask.id = ahn.id_skl
                        left join app_jurusan ajr on ajr.id = ahn.id_jurusan
                        left join app_semester asm on asm.id = ahn.id_semester
                        left join app_kelas akl on akl.id = ahn.id_kelas
                        left join app_user muc on muc.id = ahn.created_by
                        left join app_user muu on muu.id = ahn.updated_by
                        where  ahn.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, sekolah_name,jurusan_name,semester_name,kelas_name, tanggal, date_name,month_name,year_name, nilai,materi, is_active, is_active_name,created_dt,created_by_name,updated_by_name,updated_dt';

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
