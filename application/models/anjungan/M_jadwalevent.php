<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_jadwalevent extends CI_Model
{
    public $table = 'app_jadwal_event';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        aje.*,
                        if(aje.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(aje.tanggal, '%d/%m/%Y') as tanggal_name,
                        DATE_FORMAT(aje.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(aje.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        ask.nm_skl as sekolah,
                        asm.semester as semester_name,
                        ata.tahun
                        from app_jadwal_event aje
                        left join app_user muc on muc.id = aje.created_by
                        left join app_user muu on muu.id = aje.updated_by
                        left join app_semester asm on asm.id = aje.id_semester
                        left join app_tahun_ajaran ata on ata.id = aje.id_tahun
                        left join app_skl ask on ask.id = aje.id_skl
                        where aje.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, semester_name,tahun, tanggal, tanggal_name, pkl_mulai, pkl_selesai, kegiatan, lokasi, 
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
