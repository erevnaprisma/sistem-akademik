<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kegiatanekskul extends CI_Model
{
    public $table = 'app_kegiatan_ekskul';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
    select * from (
                        select
                        ake.*,
                        if(ake.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(ake.tanggal, '%d/%m/%Y') as tanggal_name,
                        DATE_FORMAT(ake.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(ake.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        DATE_FORMAT(ake.pkl_mulai, '%H:%i') as pkl_mulai_name,
                        DATE_FORMAT(ake.pkl_selesai, '%H:%i') as pkl_selesai_name,
                        ael.ekskul, ask.nm_skl as sekolah
                        from app_kegiatan_ekskul ake
                        left join app_user muc on muc.id = ake.created_by
                        left join app_user muu on muu.id = ake.updated_by
                        left join app_ekskul_lerger ael on ael.id = ake.id_ekskul
                        left join app_skl ask on ask.id = ake.id_skl
                        where ake.is_active != 9  and ask.is_active = 1
                        ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, id_ekskul, ekskul,id_skl, kegiatan, tempat, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
    tanggal,tanggal_name, pkl_mulai,pkl_mulai_name,pkl_selesai,pkl_selesai_name, sekolah,created_dt_name,updated_dt_name
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
    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where ake.is_active = 1";
        if(isset($params['id'])){
            $condition .= " and ake.id = ". $params['id'] ." ";
        }
        // if(isset($params['id_siswa'])){
        //     $condition .= " and aos.id_siswa = '". $params['id_siswa'] ."' ";
        // }
        if(isset($params['id_skl'])){
            $condition .= " and ake.id_skl = '". $params['id_skl'] ."' ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            ake.kegiatan like '%".$params['like']."%' 
                            or ake.pkl_mulai like '%".$params['like']."%' 
                            or ake.pkl_selesai like '%".$params['like']."%' 
                            or ake.tempat like '%".$params['like']."%' 
                            or DATE_FORMAT(ake.tanggal, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }

        $sql = "
            select
            ake.*,
            if(ake.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(ake.tanggal, '%d/%m/%Y') as tanggal_name,
            DATE_FORMAT(ake.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(ake.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
            DATE_FORMAT(ake.pkl_mulai, '%H:%i') as pkl_mulai_name,
            DATE_FORMAT(ake.pkl_selesai, '%H:%i') as pkl_selesai_name,
            ael.ekskul, ask.nm_skl as sekolah
            from app_kegiatan_ekskul ake
            left join app_user muc on muc.id = ake.created_by
            left join app_user muu on muu.id = ake.updated_by
            left join app_ekskul_lerger ael on ael.id = ake.id_ekskul
            left join app_skl ask on ask.id = ake.id_skl
            $condition
            order by ake.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
