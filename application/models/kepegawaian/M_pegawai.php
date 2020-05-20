<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_pegawai extends CI_Model
{
    public $table = 'app_pegawai';
    public $alias = 'mp';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select
                        mp.*,
                        if(mp.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        agama, goldar, 
                        jk.name as jenis_kelamin,
                        ast.name as status_kwn_name,
                        DATE_FORMAT(mp.tgl_lhr, '%d/%m/%Y') as tgl_lhr_name,
                        DATE_FORMAT(mp.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(mp.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
                        from app_pegawai mp
                        left join app_user muc on muc.id = mp.created_by
                        left join app_user muu on muu.id = mp.updated_by
                        left join app_agama on app_agama.id = mp.id_agama
                        left join app_goldar on app_goldar.id = mp.id_goldar
                        left join app_jk jk on jk.id = mp.jk
                        left join app_status_kwn ast on ast.id = mp.status_kwn
                        left join app_skl ask on ask.id = mp.id_skl
    ";
    public $where = [' mp.is_active != 9 '];
    public $add_params = [
        'created_by_name' => 'muc.name',
        'updated_by_name' => 'muu.name',
    ];

    public $select = 'id,nama, tmp_lhr, tgl_lhr,tgl_lhr_name, jk, id_agama, suku, status_kwn,status_kwn_name, tinggi, berat, uk_baju, uk_spt, id_goldar, alamat, tlp_rmh, hp, email, no_induk, bagian, jabatan, golongan, status, foto, is_active,is_active_name,created_dt,created_dt_name,created_by_name,updated_dt,updated_dt_name,updated_by_name, agama, goldar, jenis_kelamin';

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
