<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_trxkeuangandetail extends CI_Model
{
    public $table = 'trx_keuangandetail';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        tbl.*,
                        if(tbl.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(tbl.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(tbl.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                        from trx_keuangandetail tbl
                        left join app_user muc on muc.id = tbl.created_by
                        left join app_user muu on muu.id = tbl.updated_by
                        left join app_skl skl on skl.id = tbl.id_skl
                        where tbl.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
        id, id_siswa, id_pegawai, id_tahun, id_kodegl, id_jenistransaksi, jurnal, qty, nominal, ket,  jenis,
        nm_skl, is_active_name,created_dt,created_dt_name,created_by_name,updated_dt,updated_dt_name,updated_by_name
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
