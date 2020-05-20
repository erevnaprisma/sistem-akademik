<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_ujian extends CI_Model
{
    public $table = 'app_elearning_ujian';
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
                        DATE_FORMAT(abk.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
                        from app_elearning_ujian abk
                        left join app_user muc on muc.id = abk.created_by
                        left join app_user muu on muu.id = abk.updated_by
                        where abk.is_active != 9
                    ) as mst

    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id,id_soalujian,id_soalujiandetail,ganda,essay,
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

    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where abk.is_active = 1";
        if(isset($params['id'])){
            $condition .= " and abk.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and abk.id_skl = '". $params['id_skl'] ."' ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            // $condition .= " 
            //             and (
            //                 amp.name like '%".$params['like']."%' 
            //                 or abk.materi like '%".$params['like']."%' 
            //                 or abk.ket like '%".$params['like']."%' 
            //                 or ta.tahun like '%".$params['like']."%' 
            //                 or kls.nama_kelas like '%".$params['like']."%' 
            //             ) ";
        }

        $sql = "
            select
            abk.*,
            if(abk.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(abk.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(abk.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name
            from app_elearning_ujian abk
            left join app_user muc on muc.id = abk.created_by
            left join app_user muu on muu.id = abk.updated_by
            $condition
            order by abk.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }



    
    public function hasilreaddetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where abk.is_active = 1";
        if(isset($params['id'])){
            $condition .= " and abk.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and abk.id_skl = '". $params['id_skl'] ."' ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            // $condition .= " 
            //             and (
            //                 amp.name like '%".$params['like']."%' 
            //                 or abk.materi like '%".$params['like']."%' 
            //                 or abk.ket like '%".$params['like']."%' 
            //                 or ta.tahun like '%".$params['like']."%' 
            //                 or kls.nama_kelas like '%".$params['like']."%' 
            //             ) ";
        }

        $sql = "
            SELECT abk.*, sum(aeu.nilai) as sum_nilai,sum(aeu.hasil) as sum_hasil,
            kls.nama_kelas, sm.semester, ta.tahun,
            ajr.jurusan,amp.name as mapel,
            DATE_FORMAT(abk.mulai, '%d/%m/%Y %H:%i') as mulai_name,
            DATE_FORMAT(abk.selesai, '%d/%m/%Y %H:%i') as selesai_name,
            ask.nm_skl as sekolah
            from app_elearning_ujian aeu
            left join app_elearning_soalujian abk on abk.id = aeu.id_soalujian
            left join app_jurusan ajr on ajr.id = abk.id_jurusan
            left join app_mapel amp on amp.id = abk.id_mapel
            left join app_kelas kls on kls.id = abk.id_kelas
            left join app_semester sm on sm.id = abk.id_semester
            left join app_tahun_ajaran ta on ta.id = abk.id_tahun_ajaran
            left join app_skl ask on ask.id = abk.id_skl
            $condition
            group by aeu.id_siswa, aeu.id_soalujian
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }





}
