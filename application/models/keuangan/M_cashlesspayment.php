<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_cashlesspayment extends CI_Model
{
    public $trans = [
        ['id'=>0, 'name'=>'Debet'],
        ['id'=>1, 'name'=>'Kredit']
    ];

    public $table = 'app_cashlesspayment';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        acp.*,
                        if(acp.is_active=1,'YES','NO') as is_active_name,
                        if(acp.trans=0,'Debet','Kredit') as trans_name,
                        if(acp.status=1,'Success','Failed') as status_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(acp.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(acp.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        ask.nm_skl as sekolah,
                        mus.name as nama_user
                        from app_cashlesspayment acp
                        left join app_user muc on muc.id = acp.created_by
                        left join app_user muu on muu.id = acp.updated_by
                        left join app_user mus on mus.id = acp.id_user
                        left join app_skl ask on ask.id = acp.id_skl
                        where acp.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
        id, trans, nominal, saldo, status, log, id_skl, id_user,
        is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
        sekolah, created_dt_name,updated_dt_name,trans_name,status_name,nama_user
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

        return $this->datatables->generate();
    }
}
