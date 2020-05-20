<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_jadwalguru extends CI_Model
{
    public $hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    public $table = 'app_jadwal_guru';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = '
                    select * from (
                        select
                        ajg.*,
                        if(ajg.is_active=1,"YES","NO") as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(ajg.created_dt, "%d/%m/%Y %H:%i:%s") as created_dt_name,
                        DATE_FORMAT(ajg.updated_dt, "%d/%m/%Y %H:%i:%s") as updated_dt_name,
                        ask.nm_skl as sekolah,
                        asm.semester as semester_name,
                        ata.tahun,
                        (
                            CASE
                                WHEN ajg.id_hari = 1 THEN "Senin"
                                WHEN ajg.id_hari = 2 THEN "Selasa"
                                WHEN ajg.id_hari = 3 THEN "Rabu"
                                WHEN ajg.id_hari = 4 THEN "Kamis"
                                WHEN ajg.id_hari = 5 THEN "Jumat"
                                WHEN ajg.id_hari = 6 THEN "Sabtu"
                                ELSE "Minggu"
                            END
                        ) as hari_name,
                        apr.name as guru_name
                        from app_jadwal_guru ajg
                        left join app_user muc on muc.id = ajg.created_by
                        left join app_user muu on muu.id = ajg.updated_by
                        left join app_semester asm on asm.id = ajg.id_semester
                        left join app_tahun_ajaran ata on ata.id = ajg.id_tahun
                        left join app_user apr on apr.id = ajg.id_guru
                        left join app_skl ask on ask.id = ajg.id_skl
                        where  ajg.is_active != 9 and ask.is_active = 1
                    ) as mst

    ';
    public $where = [];
    public $add_params = [];

    public $select = 'id,semester_name,tahun,hari_name,pkl_mulai,pkl_selesai,guru_name,
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
    public function getHari(){
        $hari = [];
        foreach ($this->hari as $key => $value) {
            $hari[] = (object) [
                "id" => ($key + 1),
                "name" => $value
            ];
        }
        return $hari;
    }
}
