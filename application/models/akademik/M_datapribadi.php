<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_datapribadi extends CI_Model
{
    
    public $table = 'app_data_pribadi';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                select * from (
                    select
                    adp.*,
                    if(adp.is_active=1,'YES','NO') as is_active_name,
                    muc.name as created_by_name,
                    muu.name as updated_by_name,
                    DATE_FORMAT(adp.tgl_lhr, '%d/%m/%Y') as tgl_lhr_name
                    from app_data_pribadi adp
                    left join app_user muc on muc.id = adp.created_by
                    left join app_user muu on muu.id = adp.updated_by
                    where adp.is_active != 9
                ) as mst
    ";
    public $where = [];
    public $add_params = [];

    
    public $select = '
    id, nm_panggilan, tmp_lahir, tgl_lhr, id_agm, wrg, suku, id_goldar, tinggi, berat, uk_baju, uk_spt, 
    alamat, telp, email, id_sta_t_dgn, id_tem_t_dgn, id_jrk_rmh, id_trn_rmh, sta_t_dgn_lain, tem_t_dgn_lain, 
    jrk_rmh_lain, trn_rmh_lain, status_anak, ank_ke, dari, jml_sdr_kan, jml_sdr_tir, sdr_ang, 
    pendidikan_oleh, beasiswa_oleh, wrg_lain, id_siswa, id_skl,

    tgl_lhr_name,

    is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name
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
