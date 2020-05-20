<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_pos extends CI_Model
{
    public $table = 'app_toko';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        SELECT a.*, b.name, c.nm_skl, d.name as created, e.name as updated 
                        FROM app_toko a 
                        INNER JOIN app_user b ON a.id_user = b.id 
                        INNER JOIN app_skl c on a.id_skl = c.id 
                        INNER JOIN app_user d ON a.created_by = d.id 
                        LEFT JOIN app_user e ON a.updated_by = e.id
                        where a.is_active != 9 and c.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,name,nm_skl,created,keterangan,nama_toko,created_dt,updated,updated_dt';

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
        //$builder = $this->db->update($this->table, ['is_active' => STATUS_IS_DELETE], [$this->id => $id]);
        $builder = $this->db->delete($this->table, [$this->id => $id]);

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
