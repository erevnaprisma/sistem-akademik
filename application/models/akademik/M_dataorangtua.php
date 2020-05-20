<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_dataorangtua extends CI_Model
{
    public $table = 'app_data_ortu';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        ado.*,
                        if(ado.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(ado.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(ado.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                        DATE_FORMAT(ado.tgl_lhr_ayah, '%d/%m/%Y') as tgl_lhr_ayah_name,
                        DATE_FORMAT(ado.tgl_lhr_ibu, '%d/%m/%Y') as tgl_lhr_ibu_name
                        from app_data_ortu ado
                        left join app_user muc on muc.id = ado.created_by
                        left join app_user muu on muu.id = ado.updated_by
                        where ado.is_active != 9 
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, 
    
    nm_ayah, pg_ayah, tmp_lhr_ayah, tgl_lhr_ayah, agm_ayah, wrg_ayah, wrg_ayah_lain, 
    id_pndd_ayah, pnddk_ayah, id_pek_ayah, pek_ayah_lain, jbt_ayah, gaji_ayah, 
    almt_knt_ayah, almt_rmh_ayah, telp, ket, 
    
    nm_ibu, pg_ibu, tmp_lhr_ibu, tgl_lhr_ibu, agm_ibu, wrg_ibu, wrg_ibu_lain, 
    id_pndd_ibu, pndd_ibu, id_pek_ibu, pek_ibu_lain, jbt_ibu, gaji_ibu, 
    almt_knt_ibu, almt_rmh_ibu, telp_ibu, ket_ibu, 
    
    
    is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
    sekolah,created_dt_name,updated_dt_name,
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
        //var_dump($this->sql); die;
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
