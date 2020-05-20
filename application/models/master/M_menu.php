<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_menu extends CI_Model
{
    public $action = ['json', 'create', 'read', 'update', 'delete'];

    public $table = 'app_menu';
    public $alias = 'amn';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select
                        amn.*,
                        if(amn.parent_id=0,'ROOT',(select am.label from app_menu am where am.id = amn.parent_id)) as parent_name,
                        if(amn.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from app_menu amn
                        left join app_user muc on muc.id = amn.created_by
                        left join app_user muu on muu.id = amn.updated_by
    ";

    public $where = [' amn.is_active != 9 '];

    public $add_params = [
        'created_by_name' => 'muc.name',
        'updated_by_name' => 'muu.name',
    ];

    public $select = 'id,name,parent_id,parent_name,label,default_url,order,icon,is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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

        if(!empty($_POST['id'])){
            $default_url = explode("/",$_POST['default_url']);
            array_pop($default_url);
            $default_url = implode("/",$default_url);
            $menu_action = findAll("
                select id,name from ". $this->table ." where menu_id = ". $_POST['id']."
            ");
            foreach ($menu_action as $k => $v) {
                $this->db->update($this->table, ["default_url"=>$default_url."/".$v->name], [$this->id => $v->id]);
            }
        }

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
        $this->datatables->where('mst.is_active != 9 ');
        $this->datatables->where('mst.parent_id is not null');

        return $this->datatables->generate();
    }
}