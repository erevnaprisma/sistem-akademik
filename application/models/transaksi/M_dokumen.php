<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_dokumen extends CI_Model
{
    public $table = 't_dokumen';
    public $alias = 'tdk';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select
                        tdk.*,
                        if(tdk.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(tdk.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(tdk.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                        ask.nm_skl as sekolah,
                        (
                            case
                                when tdk.flag=0
                                    then 'DOKUMEN'
                                when tdk.flag=1
                                    then 'IMAGE'
                                when tdk.flag=2
                                    then 'VIDEO'
                                when tdk.flag=7
                                    then 'KOMEN'
                                else ''
                            end 
                        ) as flaging
                        from t_dokumen tdk
                        left join app_user muc on muc.id = tdk.created_by
                        left join app_user muu on muu.id = tdk.updated_by
                        left join app_skl ask on ask.id = tdk.id_skl
    ";
    public $where = [' tdk.is_active != 9 and tdk.flag != 7 '];
    public $add_params = [
        'created_by_name' => 'muc.name',
        'updated_by_name' => 'muu.name',
    ];

    public $select = '
        id,sekolah,id_trx,hal,name,flag,flaging,
        is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
        created_dt_name, updated_dt_name
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

    public function deletefile($id)
    {
        $builder = $this->db->update($this->table, ['is_active' => STATUS_IS_DELETE], ['name' => $id]);

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
        $this->datatables->where('mst.is_active in(0,1) and mst.flag != 7');

        return $this->datatables->generate();
    }
}
