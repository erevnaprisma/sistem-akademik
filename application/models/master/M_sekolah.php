<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_sekolah extends CI_Model
{
    public $table = 'app_skl';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        ask.*,
                        if(ask.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from app_skl ask
                        left join app_user muc on muc.id = ask.created_by
                        left join app_user muu on muu.id = ask.updated_by
                        where ask.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,nm_skl,slug,foto,icon,favicon,kepala_sekolah,kota,is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($params = [])
    {
        $params = compareFields('create', $this->table, $params);
        $builder = $this->db->insert($this->table, $params);
        $id = $this->db->insert_id();
        $this->db->insert('m_anjungan', [
            'id_skl'=>$id,
            // 'created_by'=>$params['updated_by'],
            // 'created_dt'=>$params['updated_dt']
        ]);

        return $builder ? $id : false;
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

        $cek = $this->db->get_where('m_anjungan', array('id_skl' => $id))->result_array();
        if(!$cek){
            $this->db->insert('m_anjungan', [
                'id_skl'=>$id,
                'created_by'=>$params['updated_by'],
                'created_dt'=>$params['updated_dt']
            ]);
        }

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
