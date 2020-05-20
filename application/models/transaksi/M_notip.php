<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_notip extends CI_Model
{
    public $table = 'trx_notip';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select * from (
                            select
                            rnp.*,
                            if(rnp.is_active=1,'YES','NO') as is_active_name,
                            if(rnp.created_by =1,muc.name,'Admin') as created_by_name,
                            muu.name as updated_by_name,
                            DATE_FORMAT(rnp.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                            DATE_FORMAT(rnp.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name 
                            from trx_notip rnp
                            left join app_user muc on muc.id = rnp.created_by
                            left join app_user muu on muu.id = rnp.updated_by
                            where rnp.is_active != 9
                        ) as mst
                        
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
        id,title,to,body,
        is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
        created_dt_name, updated_dt_name
    ';

    public function __construct()
    {
        parent::__construct();
    }

    // public function sql($id = 0)
    // {
    //     $sql = "
    //         select
    //         rnp.*,
    //         if(rnp.is_active=1,'YES','NO') as is_active_name,
    //         muc.name as created_by_name,
    //         muu.name as updated_by_name,
    //         DATE_FORMAT(rnp.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
    //         DATE_FORMAT(rnp.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
    //         from trx_notip rnp
    //         left join app_user muc on muc.id = rnp.created_by
    //         left join app_user muu on muu.id = rnp.updated_by
    //         where is_active = 1
    //     ";
    // }

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
        $this->datatables->where('mst.is_active in(0,1) and mst.flag = 7');

        return $this->datatables->generate();
    }

    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where rnp.is_active = 1";
        if(isset($params['id'])){
            $condition .= " and rnp.id = ". $params['id'] ." ";
        }
        // if(isset($params['id_device'])){
        //     $condition .= " and rnp.to = '". $params['id_device'] ."' ";
        // }
        if(isset($params['id_siswa'])){
            $condition .= " and rnp.id_user = ". $params['id_siswa'] ." ";
        }
        // if(isset($params['id_tahun'])){
        //     $condition .= " and tku.id_tahun = ". $params['id_tahun'] ." ";
        // }
        // if(isset($params['id_skl'])){
        //     $condition .= " and tku.id_skl = ". $params['id_skl'] ." ";
        // }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            rnp.title like '%".$params['like']."%' 
                            or rnp.body like '%".$params['like']."%' 
                            or DATE_FORMAT(rnp.created_dt, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }


        $sql = "
            select
            rnp.*,
            if(rnp.is_active=1,'YES','NO') as is_active_name,
            if(rnp.created_by =1,muc.name,'Admin') as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(rnp.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(rnp.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name 
            from trx_notip rnp
            left join app_user muc on muc.id = rnp.created_by
            left join app_user muu on muu.id = rnp.updated_by
            $condition
            order by rnp.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
