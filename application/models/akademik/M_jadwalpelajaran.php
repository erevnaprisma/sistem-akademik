<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_jadwalpelajaran extends CI_Model
{
    public $hari = ["Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    public $table = 'app_jadwal_pljr';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = '
                select * from (
                    select
                    ajp.*,
                    amp.name as mapel_name,
                    ask.nm_skl as sekolah_name,
                    ajr.jurusan as jurusan_name,
                    asm.semester as semester_name,
                    akl.nama_kelas as kelas_name,
                    (
                        CASE
                            WHEN ajp.id_hari = 2 THEN "Senin"
                            WHEN ajp.id_hari = 3 THEN "Selasa"
                            WHEN ajp.id_hari = 4 THEN "Rabu"
                            WHEN ajp.id_hari = 5 THEN "Kamis"
                            WHEN ajp.id_hari = 6 THEN "Jumat"
                            WHEN ajp.id_hari = 7 THEN "Sabtu"
                            ELSE "Minggu"
                        END
                    ) as hari_name,
                    ata.tahun,
                    if(ajp.is_active=1,"YES","NO") as is_active_name,
                    muc.name as created_by_name,
                    muu.name as updated_by_name,
                    mur.name as nama_guru
                    from app_jadwal_pljr ajp
                    left join app_user muc on muc.id = ajp.created_by
                    left join app_user muu on muu.id = ajp.updated_by
                    left join app_mapel amp on amp.id = ajp.id_mapel
                    left join app_skl ask on ask.id = ajp.id_skl
                    left join app_jurusan ajr on ajr.id = ajp.id_jurusan
                    left join app_semester asm on asm.id = ajp.id_semester
                    left join app_kelas akl on akl.id = ajp.id_kelas
                    left join app_tahun_ajaran ata on ata.id = ajp.id_tahun
                    left join app_user mur on mur.id = ajp.id_user
                    where ajp.is_active != 9 and ask.is_active = 1
                ) as mst
    ';
    public $where = [];
    public $add_params = [];

    public $select = 'id, sekolah_name,tahun,jurusan_name,semester_name,kelas_name,hari_name,pkl_mulai, pkl_selesai,mapel_name,nama_guru, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
    
    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where ajp.is_active = 1 ";
        if(isset($params['id'])){
            $condition .= " and ajp.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and ajp.id_skl = ". $params['id_skl'] ." ";
        }
        if(isset($params['id_siswa']) && $params['id_siswa'] != 0){
            $condition .= " and uss.id = ". $params['id_siswa'] ." ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            amp.name like '%".$params['like']."%' 
                            or akl.nama_kelas like '%".$params['like']."%' 
                            or ata.tahun like '%".$params['like']."%' 
                            or ajp.pkl_mulai like '%".$params['like']."%'
                            or ajp.pkl_selesai like '%".$params['like']."%'
                            or (
                                CASE
                                    WHEN ajp.id_hari = 2 THEN 'Senin'
                                    WHEN ajp.id_hari = 3 THEN 'Selasa'
                                    WHEN ajp.id_hari = 4 THEN 'Rabu'
                                    WHEN ajp.id_hari = 5 THEN 'Kamis'
                                    WHEN ajp.id_hari = 6 THEN 'Jumat'
                                    WHEN ajp.id_hari = 7 THEN 'Sabtu'
                                    ELSE 'Minggu'
                                END
                            ) like '%".$params['like']."%'
                        ) ";
        }

        $sql = "
            select
            ajp.*,
            amp.name as mapel_name,
            ask.nm_skl as sekolah_name,
            ajr.jurusan as jurusan_name,
            asm.semester as semester_name,
            akl.nama_kelas as kelas_name,
            (
                CASE
                    WHEN ajp.id_hari = 2 THEN 'Senin'
                    WHEN ajp.id_hari = 3 THEN 'Selasa'
                    WHEN ajp.id_hari = 4 THEN 'Rabu'
                    WHEN ajp.id_hari = 5 THEN 'Kamis'
                    WHEN ajp.id_hari = 6 THEN 'Jumat'
                    WHEN ajp.id_hari = 7 THEN 'Sabtu'
                    ELSE 'Minggu'
                END
            ) as hari_name,
            ata.tahun,
            if(ajp.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            mur.name as nama_guru
            from app_jadwal_pljr ajp
            left join app_user muc on muc.id = ajp.created_by
            left join app_user muu on muu.id = ajp.updated_by
            left join app_user uss on uss.id_tahun = ajp.id_tahun and uss.id_kelas = ajp.id_kelas
            left join app_mapel amp on amp.id = ajp.id_mapel
            left join app_skl ask on ask.id = ajp.id_skl
            left join app_jurusan ajr on ajr.id = ajp.id_jurusan
            left join app_semester asm on asm.id = ajp.id_semester
            left join app_kelas akl on akl.id = ajp.id_kelas
            left join app_tahun_ajaran ata on ata.id = ajp.id_tahun
            left join app_user mur on mur.id = ajp.id_user
            $condition
            group by ajp.id
            order by ata.tahun desc, ajp.id_hari asc, ajp.pkl_mulai asc, akl.nama_kelas asc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
