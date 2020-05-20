<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_walikelas extends CI_Model
{
    public $table = 'app_wali_kelas';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        awk.*,
                        if(awk.is_active=1,'YES','NO') as is_active_name,
                        kls.nama_kelas, ajr.jurusan, asm.semester,
                        ata.tahun,ask.nm_skl, usr.name as wali_kelas_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from app_wali_kelas awk
                        left join app_user muc on muc.id = awk.created_by
                        left join app_user muu on muu.id = awk.updated_by
                        left join app_tahun_ajaran ata on ata.id = awk.id_tahun_ajaran
                        left join app_semester asm on asm.id = awk.id_semester
                        left join app_jurusan ajr on ajr.id = awk.id_jurusan
                        left join app_kelas kls on kls.id = awk.id_kelas
                        left join app_skl ask on ask.id = awk.id_skl
                        left join app_user usr on usr.id = awk.id_user
                        where awk.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, tahun, jurusan, nama_kelas, id_user, wali_kelas_name,semester, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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

    public function siswakelas($id)
    {
        $builder = $this->db->update("app_user", ['is_kelas' => STATUS_IS_ACTIVE], [$this->id => $id]);

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
