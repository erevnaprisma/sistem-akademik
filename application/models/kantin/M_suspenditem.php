<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_suspenditem extends CI_Model
{
    public $table = 'app_suspend_items';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        asi.*,
                        if(asi.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(asi.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(asi.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        atk.nama_toko, atk.keterangan,
                        apt.foto,
                        ask.nm_skl as sekolah
                        from app_suspend_items asi
                        left join app_user muc on muc.id = asi.created_by
                        left join app_user muu on muu.id = asi.updated_by
                        left join app_skl ask on ask.id = asi.id_skl
                        left join app_toko atk on atk.id = asi.outlet_id
                        left join app_product apt on apt.id = asi.product_id
                        where asi.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, suspend_id, product_code, product_name, product_category, product_cost, qty, product_price, status,
    nama_toko,keterangan,foto,checked,
    is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
        // var_dump($this->sql); die;
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

    public function outletorder($params)
    {
        $condition = "WHERE asi.status = 0 and asi.is_active = 1";
        if(isset($params['created_by'])){
            $condition .= " and asi.created_by = ".$params['created_by']." ";
        }
        if(isset($params['outlet_id'])){
            $condition .= " and asi.outlet_id = ".$params['outlet_id']." ";
        }
        return findAll("
            SELECT 
            atk.id, atk.nama_toko, atk.keterangan, atk.foto
            FROM app_suspend_items asi
            LEFT JOIN app_toko atk on atk.id = asi.outlet_id
            $condition
            GROUP BY asi.outlet_id
        ");
    }

    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        
        
        $condition = " where asi.is_active = 1";
        if(isset($params['is_active'])){
            $condition = " where asi.is_active = ". $params['is_active'] ." ";
        }
        
        if(isset($params['status'])){
            $condition .= " and asi.status = ". $params['status'] ." ";
        }
        if(isset($params['created_by'])){
            $condition .= " and asi.created_by = ". $params['created_by'] ." ";
        }
        if(isset($params['outlet_id'])){
            $condition .= " and asi.outlet_id = ". $params['outlet_id'] ." ";
        }
        if(isset($params['product_id'])){
            $condition .= " and asi.product_id = ". $params['product_id'] ." ";
        }

        if(isset($params['id'])){
            $condition .= " and asi.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and asi.id_skl = '". $params['id_skl'] ."' ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            asi.product_code like '%".$params['like']."%' 
                            or asi.product_price like '%".$params['like']."%' 
                            or asi.product_name like '%".$params['like']."%' 
                            or atk.nama_toko like '%".$params['like']."%' 
                            or DATE_FORMAT(asi.created_dt, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }

        $sql = "
        select
        asi.*,
        if(asi.is_active=1,'YES','NO') as is_active_name,
        muc.name as created_by_name,
        muu.name as updated_by_name,
        DATE_FORMAT(asi.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
        DATE_FORMAT(asi.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
        atk.nama_toko, atk.keterangan,
        apt.foto,
        ask.nm_skl as sekolah
        from app_suspend_items asi
        left join app_user muc on muc.id = asi.created_by
        left join app_user muu on muu.id = asi.updated_by
        left join app_skl ask on ask.id = asi.id_skl
        left join app_toko atk on atk.id = asi.outlet_id
        left join app_product apt on apt.id = asi.product_id
            $condition
            order by asi.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
