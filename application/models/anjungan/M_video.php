<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_video extends CI_Model
{
    public $table = 'app_video';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        abk.*,
                        if(abk.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(abk.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(abk.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        ask.nm_skl as sekolah
                        from app_video abk
                        left join app_user muc on muc.id = abk.created_by
                        left join app_user muu on muu.id = abk.updated_by
                        left join app_skl ask on ask.id = abk.id_skl
                        where abk.is_active != 9 and ask.is_active = 1
                    ) as mst

    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,video, pengarang, tahun,
    sekolah,cover,file,lihat,
    is_active,is_active_name,created_dt,created_dt_name,created_by_name,updated_dt,updated_dt_name,updated_by_name';

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

        return $this->datatables->generate();
    }
    public function count()
    {
        $qty = findOne("SELECT (lihat + 1) as lihat FROM app_video where id = " . $_POST['id']);
        $builder = $this->db->update($this->table, ['lihat'=>$qty->lihat], [$this->id => $_POST['id']]);

        return $builder ? $_POST['id'] : false;
    }
}
