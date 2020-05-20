<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_guru extends CI_Model
{
    public $table = 'app_guru';
    public $alias = 'muuu';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from ( 
                        select
                        agr.id, agr.id_user, agr.id_mapel, agr.is_active, 
                        agr.created_by, agr.created_dt, agr.updated_by, agr.updated_dt, agr.alamat,
                        mu.name as username,mu.email as emailname,mu.user_type_id,mu.id_skl,
                        if(agr.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        amp.name as mapel,
                        DATE_FORMAT(agr.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(agr.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
                        from app_user mu
                        left join app_guru agr on agr.id_user = mu.id
                        left join app_user muc on muc.id = agr.created_by
                        left join app_user muu on muu.id = agr.updated_by
                        left join app_mapel amp on amp.id = agr.id_mapel
                        left join app_skl ask on ask.id = agr.id_skl
                        where agr.id is not null and mu.user_type_id = ". USER_TYPE_GURU ."
                        and ask.is_active = 1
                    ) as muuu
    ";
    public $where = [' muuu.is_active != 9 '];
    public $add_params = [
        // 'created_by_name' => 'muc.name',
        // 'updated_by_name' => 'muu.name',
    ];

    public $select = 'id, alamat, id_user,mapel,
    is_active, is_active_name,created_dt,created_dt_name,created_by_name,updated_dt,updated_dt_name,updated_by_name, username,emailname
    
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
        
        $this->datatables->where('mst.is_active in(0,1) and mst.user_type_id = ' . USER_TYPE_GURU );
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');
        return $this->datatables->generate();
    }
}
