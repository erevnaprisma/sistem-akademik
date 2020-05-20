<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_jenistransaksi extends CI_Model
{
    public $table = 'app_jns_transaksi';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        ajt.*,
                        if(ajt.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        akg.name as kode_gl_name
                        from app_jns_transaksi ajt
                        left join app_user muc on muc.id = ajt.created_by
                        left join app_user muu on muu.id = ajt.updated_by
                        left join app_kode_gl akg on akg.id = ajt.id_kode_gl
                        left join app_skl ask on ask.id = ajt.id_skl
                        where ajt.is_active != 9 
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,kode_gl_name,kode,jenis,is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
        // $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');

        return $this->datatables->generate();
    }
}
