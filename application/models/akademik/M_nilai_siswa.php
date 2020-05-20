<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_nilai_siswa extends CI_Model
{
    public $table = 'app_nilai_siswa';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        ns.*,
                        if(ns.is_active=1,'YES','NO') as is_active_name,
                        pl.tanggal, pl.materi,
                        day(pl.tanggal) as date_name,
                        month(pl.tanggal) as month_name,
                        year(pl.tanggal) as year_name,amp.name as mapel,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        sw.nama_siswa, kls.nama_kelas, sm.semester, th.tahun, pl.id_skl
                        from app_nilai_siswa ns
                        left join app_user muc on muc.id = ns.created_by
                        left join app_user muu on muu.id = ns.updated_by
                        left join app_siswa sw on sw.id_user = ns.id_user
                        left join app_penilaian pl on pl.id = ns.id_penilaian
                        left join app_mapel amp on amp.id = pl.id_mapel
                        left join app_kelas kls on kls.id = pl.id_kelas
                        left join app_semester sm on sm.id = pl.id_semester
                        left join app_tahun_ajaran th on th.id = pl.id_tahun_ajaran
                        where ns.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [
        'created_by_name' => 'mst.name',
        'updated_by_name' => 'mst.name',
    ];

    public $select = 'id, id_penilaian,mapel, tanggal,date_name,month_name,year_name,materi, id_siswa, nama_siswa, nama_kelas, semester, tahun, is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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


    


    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where ns.is_active = 1 and pl.is_active = 1 ";
        if(isset($params['id'])){
            $condition .= " and ns.id = ". $params['id'] ." ";
        }
        if(isset($params['id_siswa']) && $params['id_siswa'] != 0){
            $condition .= " and ns.id_user = ". $params['id_siswa'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and pl.id_skl = ". $params['id_skl'] ." ";
        }


        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            ns.nilai like '%".$params['like']."%' 
                            or atu.tipe like '%".$params['like']."%' 
                            or amp.name like '%".$params['like']."%' 
                            or sw.nama_siswa like '%".$params['like']."%' 
                            or pl.materi like '%".$params['like']."%' 
                            or ns.keterangan like '%".$params['like']."%'
                            or DATE_FORMAT(pl.tanggal, '%d/%m/%Y %H:%i:%s') like '%".$params['like']."%'
                            or DATE_FORMAT(ns.created_dt, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }


        $sql = "
            select
            ns.*,
            if(ns.is_active=1,'YES','NO') as is_active_name,
            pl.tanggal, pl.materi,atu.tipe,
            day(pl.tanggal) as date_name,
            month(pl.tanggal) as month_name,
            year(pl.tanggal) as year_name,amp.name as mapel,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(ns.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(ns.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
            DATE_FORMAT(pl.tanggal, '%d/%m/%Y %H:%i:%s') as tanggal_name,
            sw.nama_siswa, kls.nama_kelas, sm.semester, th.tahun, pl.id_skl
            from app_nilai_siswa ns
            left join app_user muc on muc.id = ns.created_by
            left join app_user muu on muu.id = ns.updated_by
            left join app_siswa sw on sw.id_user = ns.id_user
            left join app_penilaian pl on pl.id = ns.id_penilaian
            left join app_mapel amp on amp.id = pl.id_mapel
            LEFT join app_tipe_ujian atu on atu.id = pl.id_tipe
            left join app_kelas kls on kls.id = pl.id_kelas
            left join app_semester sm on sm.id = pl.id_semester
            left join app_tahun_ajaran th on th.id = pl.id_tahun_ajaran
            $condition
            order by ns.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
