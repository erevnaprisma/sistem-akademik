<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_product extends CI_Model
{
    public $table = 'app_product';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select * from ( 
                            SELECT app.*, 
                            act.name as kategori,
                            apt.nama_toko,
                            ask.nm_skl as sekolah,
                            if(app.is_active=1,'YES','NO') as is_active_name,
                            muc.name as created_by_name,
                            muu.name as updated_by_name,
                            DATE_FORMAT(app.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                            DATE_FORMAT(app.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
                            from app_product app
                            left join app_user muc on muc.id = app.created_by
                            left join app_user muu on muu.id = app.updated_by
                            left join app_category act on act.id = app.category
                            left join app_toko apt on apt.id = app.id_toko
                            left join app_skl ask on ask.id = app.id_skl
                            where app.is_active != 9 and ask.is_active = 1
                        ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,code,nama_toko,name,sekolah,kategori,purchase_price,retail_price,foto,is_active_name,created_dt,created_dt_name,created_by,created_by_name,updated_by,updated_by_name,updated_dt,updated_dt_name';

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


    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where 1 = 1";
        if(isset($params['id'])){
            $condition .= " and app.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and app.id_skl = '". $params['id_skl'] ."' ";
        }

        if(isset($params['outlet_id'])){
            $condition .= " and app.id_toko = '". $params['outlet_id'] ."' ";
        }

        $like = " ";
        // if(isset($params['like']) && !empty($params['like'])){
        //     $condition .= " 
        //                 and (
        //                     afr.title like '%".$params['like']."%' 
        //                     or muc.name like '%".$params['like']."%' 
        //                     or afr.content like '%".$params['like']."%' 
        //                     or DATE_FORMAT(afr.created_dt, '%d/%m/%Y') like '%".$params['like']."%'
        //                 ) ";
        // }

        $sql = "
            SELECT app.*, 
            act.name as kategori,
            apt.nama_toko,
            ask.nm_skl as sekolah,
            if(app.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(app.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(app.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
            from app_product app
            left join app_user muc on muc.id = app.created_by
            left join app_user muu on muu.id = app.updated_by
            left join app_category act on act.id = app.category
            left join app_toko apt on apt.id = app.id_toko
            left join app_skl ask on ask.id = app.id_skl
            $condition
            order by app.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }


}
