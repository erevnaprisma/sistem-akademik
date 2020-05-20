<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_karaktersiswa extends CI_Model
{
    public $table = 'app_karakter_siswa';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        aks.*,
                        if(aks.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        kls.nama_kelas, jr.jurusan, sm.semester, sw.nama_siswa,
                        ta.tahun,amp.name as mapel,
                        DATE_FORMAT(tanggal, '%d/%m/%Y') as tanggal_name,
                        DATE_FORMAT(aks.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(aks.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        ask.nm_skl as sekolah
                        from app_karakter_siswa aks
                        left join app_user muc on muc.id = aks.created_by
                        left join app_user muu on muu.id = aks.updated_by
                        left join app_tahun_ajaran ta on ta.id = aks.id_tahun_ajaran
                        left join app_mapel amp on amp.id = aks.id_mapel
                        left join app_kelas kls on kls.id = aks.id_kelas
                        left join app_jurusan jr on jr.id = aks.id_jurusan
                        left join app_semester sm on sm.id = aks.id_semester
                        left join app_siswa sw on sw.id_user = aks.id_siswa
                        left join app_skl ask on ask.id = aks.id_skl
                        where aks.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
        id, id_jurusan, id_kelas, id_semester, id_mapel, id_siswa, id_skl, tanggal, penilaian, is_active,
        is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,tahun,mapel,
        jurusan, nama_kelas, semester, nama_siswa, tanggal_name,sekolah,created_dt_name,updated_dt_name
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
        $this->datatables->where('mst.flag = "' . $_POST['flag'] . '"');
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');

        if(isset($_POST['no_id_user']) && $_POST['no_id_user'] !=''){
            $this->datatables->where('mst.id_siswa not in('.$_POST['no_id_user'].')');
        }

        if(isset($_POST['id_user']) && $_POST['id_user'] !=''){
            $this->datatables->where('mst.id_siswa in('.$_POST['id_user'].')');
        }

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

        $condition = " where aks.is_active = 1 ";
        if(isset($params['id'])){
            $condition .= " and aks.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and aks.id_skl = ". $params['id_skl'] ." ";
        }
        if(isset($params['id_siswa']) && $params['id_siswa'] !=0){
            $condition .= " and aks.id_siswa = ". $params['id_siswa'] ." ";
        }
        if(isset($params['flag'])){
            $condition .= " and aks.flag = '". $params['flag'] ."' ";
        }


        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            aks.penilaian like '%".$params['like']."%' 
                            or amp.name like '%".$params['like']."%' 
                            or sw.nama_siswa like '%".$params['like']."%' 
                            or ta.tahun like '%".$params['like']."%' 
                            or kls.nama_kelas like '%".$params['like']."%' 
                            or DATE_FORMAT(aks.tanggal, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }

        $sql = "
            select
            aks.*,
            if(aks.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            ta.tahun,amp.name as mapel,
            kls.nama_kelas, jr.jurusan, sm.semester, sw.nama_siswa,
            DATE_FORMAT(aks.tanggal, '%d/%m/%Y') as tanggal_name,
            DATE_FORMAT(aks.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(aks.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
            ask.nm_skl as sekolah
            from app_karakter_siswa aks
            left join app_user muc on muc.id = aks.created_by
            left join app_user muu on muu.id = aks.updated_by
            left join app_tahun_ajaran ta on ta.id = aks.id_tahun_ajaran
            left join app_mapel amp on amp.id = aks.id_mapel
            left join app_kelas kls on kls.id = aks.id_kelas
            left join app_jurusan jr on jr.id = aks.id_jurusan
            left join app_semester sm on sm.id = aks.id_semester
            left join app_siswa sw on sw.id_user = aks.id_siswa
            left join app_skl ask on ask.id = aks.id_skl
            $condition
            order by aks.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
