<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_forum extends CI_Model
{
    public $table = 'app_forum';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        afr.*,
                        if(afr.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(afr.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(afr.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        aft.name as forum_type,
                        ask.nm_skl as sekolah
                        from app_forum afr
                        left join app_user muc on muc.id = afr.created_by
                        left join app_user muu on muu.id = afr.updated_by
                        left join app_forum_type aft on aft.id = afr.id_forum_type
                        left join app_skl ask on ask.id = afr.id_skl
                        where  afr.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, id_forum_type, title, content, foto, star, view, replay,
    is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
    forum_type,sekolah,created_dt_name,updated_dt_name
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
        if(isset($_POST['id_forum_type'])){
            $this->datatables->where('mst.id_forum_type = '.$_POST['id_forum_type']);
        }

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

        

        $condition = " where afr.is_active = 1";
        if(isset($params['id'])){
            $condition .= " and afr.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and afr.id_skl = '". $params['id_skl'] ."' ";
        }
        if(isset($params['id_forum_type'])){
            $condition .= " and afr.id_forum_type = '". $params['id_forum_type'] ."' ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            afr.title like '%".$params['like']."%' 
                            or muc.name like '%".$params['like']."%' 
                            or afr.content like '%".$params['like']."%' 
                            or DATE_FORMAT(afr.created_dt, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }

        $sql = "
            select
            afr.*,
            if(afr.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(afr.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(afr.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
            aft.name as forum_type,
            ask.nm_skl as sekolah
            from app_forum afr
            left join app_user muc on muc.id = afr.created_by
            left join app_user muu on muu.id = afr.updated_by
            left join app_forum_type aft on aft.id = afr.id_forum_type
            left join app_skl ask on ask.id = afr.id_skl
            $condition
            order by afr.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
