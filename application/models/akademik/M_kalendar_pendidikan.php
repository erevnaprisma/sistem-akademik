<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kalendar_pendidikan extends CI_Model
{
    public $table = 'app_kalendar_pendidikan';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        kp.*,
                        if(kp.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        day(kp.tanggal) as date,
                        year(kp.tanggal) as tahun,
                        month(kp.tanggal) as bulan
                        from app_kalendar_pendidikan kp
                        left join app_user muc on muc.id = kp.created_by
                        left join app_user muu on muu.id = kp.updated_by
                        left join app_skl ask on ask.id = kp.id_skl
                        where kp.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,tanggal,keterangan,note,tahun,bulan,is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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

    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where kp.is_active = 1 ";
        if(isset($params['id'])){
            $condition .= " and kp.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and kp.id_skl = ". $params['id_skl'] ." ";
        }

        if(isset($params['month'])){
            $condition .= " and month(kp.tanggal) = ". $params['month'] ." ";
        }
        if(isset($params['year'])){
            $condition .= " and year(kp.tanggal) = ". $params['year'] ." ";
        }


        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            kp.keterangan like '%".$params['like']."%' 
                            or kp.note like '%".$params['like']."%' 
                            or muc.name like '%".$params['like']."%' 
                            or DATE_FORMAT(kp.tanggal, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }

        $sql = "
            select
            kp.*,
            if(kp.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            day(kp.tanggal) as date,
            year(kp.tanggal) as tahun,
            month(kp.tanggal) as bulan,
            kp.note,
            DATE_FORMAT(kp.tanggal, '%d/%m/%Y') as tanggal_name,
            DATE_FORMAT(kp.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(kp.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
            from app_kalendar_pendidikan kp
            left join app_user muc on muc.id = kp.created_by
            left join app_user muu on muu.id = kp.updated_by
            left join app_skl ask on ask.id = kp.id_skl
            $condition
            order by kp.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
