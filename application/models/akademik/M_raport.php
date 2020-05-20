<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_raport extends CI_Model
{

    public $table = 'app_raport';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        rp.*,
                        if(rp.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from app_raport rp
                        left join app_user muc on muc.id = rp.created_by
                        left join app_user muu on muu.id = rp.updated_by
                        where rp.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, nilai, id_user, keterangan, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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

    public function findTranskip()
    {
        return findAll("
            SELECT 
            art.id,art.id_kenaikan_kelas,art.keterangan,art.nilai,
            amp.name, akm.kkm
            FROM app_raport art 
            left join app_mapel amp on amp.id = art.id_mapel
            LEFT join trx_kenaikan_kelas akk on akk.id = art.id_kenaikan_kelas 
            left join app_kkm akm on akm.id_skl = akk.id_skl and akm.id_tahun_ajaran = akk.id_tahun and akm.id_jurusan = akk.id_jurusan and akm.id_semester = akk.id_semester and akm.id_mapel = art.id_mapel
            where art.id_user = " . $_POST['id_user'] . "
            order by art.id_kenaikan_kelas
        ");
    }
}
