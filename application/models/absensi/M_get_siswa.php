<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_get_siswa extends CI_Model
{
    public $table = 'app_user';
    public $alias = 'siswa';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                        select
                        siswa.*,
                        if(
                            siswa.user_type_id in(1,2),
                            (
                                select 
                                GROUP_CONCAT(id) as lists
                                from app_skl where is_active = ". STATUS_IS_ACTIVE ."
                            ),
                            siswa.id_skl
                        ) as multi_sekolah,
                        if(siswa.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        mut.name as user_type_name,
                        mut.menu_id_detail
                        from app_user siswa
                        left join app_user muc on muc.id = siswa.created_by
                        left join app_user muu on muu.id = siswa.updated_by
                        left join app_user_type mut on mut.id = siswa.user_type_id 
    ";

    public $where = [' siswa.is_active != 9 '];
    public $add_params = [
        'created_by_name' => 'muc.name',
        'updated_by_name' => 'muu.name',
    ];

    public $select = 'id, name, user_type_id, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

    public function __construct()
    {
        parent::__construct();
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
        $this->datatables->where('mst.user_type_id = 4');
        return $this->datatables->generate();
    }
}
