<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_ekskul_kelas extends CI_Model
{
    public $table = 'app_ekskul';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        aek.*,
                        if(aek.is_active=1,'YES','NO') as is_active_name,
                        eks.nama_ekskul, eks.keterangan,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(aek.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(aek.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                        ask.nm_skl as sekolah
                        from app_ekskul aek
                        left join app_user muc on muc.id = aek.created_by
                        left join app_user muu on muu.id = aek.updated_by
                        left join app_ekskul eks on eks.id = aek.id_ekskul
                        left join app_skl ask on ask.id = akk.id_skl
                        where aek.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
        id, nama_ekskul, keterangan, is_active, is_active_name,
        created_dt,created_by_name,updated_dt,updated_by_name,
        sekolah,
        created_dt_name,updated_dt_name
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

    public function json($id_penilaian)
    {
        $this->datatables->select($this->select);
        $this->datatables->from('
            (
                '.$this->sql.'
            ) as mst
        ');
        //add this line for join
        $this->datatables->where('mst.is_active in(0,1)');
        $this->datatables->where("mst.id_penilaian = $id_penilaian");
        return $this->datatables->generate();
    }


    // public function readdetail($params = [])
    // {
    //     $where = [];
    //     if(count($params)>0){
    //         if(isset($_POST['bulan'])){
    //             $where[] = " month()"

    //         }
    //     }

    //     $read = findAll("
    //         select aek.*,
    //         if(aek.is_active=1,'YES','NO') as is_active_name,
    //         muc.name as created_by_name,
    //         muu.name as updated_by_name,
    //         DATE_FORMAT(aek.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
    //         DATE_FORMAT(aek.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
    //         ask.nm_skl as sekolah,
    //         ael.ekskul
    //         from app_ekskul aek
    //         join app_ekskul_lerger ael on  FIND_IN_SET(ael.id,aek.id_ekskul)
    //         left join app_user muc on muc.id = aek.created_by
    //         left join app_user muu on muu.id = aek.updated_by
    //         left join app_skl ask on ask.id = aek.id_skl
    //         where aek.is_active = 1
    //     ");

    //     return $read;
    // }
}
