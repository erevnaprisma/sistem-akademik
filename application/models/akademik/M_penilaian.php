<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_penilaian extends CI_Model
{
    public $table = 'app_penilaian';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                select * from (
                    select
                    apl.*,
                    if(apl.is_active=1,'YES','NO') as is_active_name,
                    muc.name as created_by_name,
                    muu.name as updated_by_name,
                    kls.nama_kelas, sm.semester, ta.tahun,
                    ajr.jurusan,atu.tipe,amp.name as mapel,
                    arp.kode as rpp_kode,
                    DATE_FORMAT(apl.tanggal, '%d/%m/%Y') as tanggal_name,
                    DATE_FORMAT(apl.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                    DATE_FORMAT(apl.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                    ask.nm_skl as sekolah
                    from app_penilaian apl
                    left join app_user muc on muc.id = apl.created_by
                    left join app_user muu on muu.id = apl.updated_by
                    left join app_jurusan ajr on ajr.id = apl.id_jurusan
                    LEFT join app_tipe_ujian atu on atu.id = apl.id_tipe
                    left join app_mapel amp on amp.id = apl.id_mapel
                    left join app_kelas kls on kls.id = apl.id_kelas
                    left join app_semester sm on sm.id = apl.id_semester
                    left join app_tahun_ajaran ta on ta.id = apl.id_tahun_ajaran
                    left join app_rpp arp on arp.id = apl.id_rpp
                    left join app_skl ask on ask.id = apl.id_skl
                    where apl.is_active != 9 and ask.is_active = 1
                ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, id_kelas, id_semester, id_tahun_ajaran, nama_kelas, semester, tahun, is_active,
    is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
    sekolah, jurusan,tipe,mapel,rpp_kode,tanggal,tingkat,kode_ujian,materi,tanggal_name,
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


    public function lappenilaian($param)
    {
        $condition = " 
            where tkk.is_active = 1 and apl.is_active = 1 and ans.is_active = 1 
            and tkk.id_skl = ".$param['id_skl']." and tkk.id_tahun = ".$param['id_tahun_ajaran']." 
            and tkk.id_kelas = ".$param['id_kelas']."

        ";

        if(isset($param['id_mapel']) && !empty($param['id_mapel'])){
            $condition .= " and apl.id_mapel = ".$param['id_mapel']." ";
        }
        $sql = "
            select tkk.id_skl,tkk.id_tahun,tkk.id_kelas, tkk.id_siswa, aps.nama_siswa,aps.no_induk,
            ans.id_penilaian, apl.tanggal,DATE_FORMAT(apl.tanggal, '%d/%m/%Y') as tanggal_name,apl.materi,apl.id_mapel,apm.name as mapel_name, ans.nilai
            from trx_kenaikan_kelas tkk
            left join app_penilaian apl on tkk.id_tahun = apl.id_tahun_ajaran and tkk.id_skl = apl.id_skl and tkk.id_kelas = apl.id_kelas
            left join app_nilai_siswa ans on ans.id_penilaian = apl.id and ans.id_user =  tkk.id_siswa
            left join app_mapel apm on apm.id = apl.id_mapel
            left join app_siswa aps on aps.id_user = tkk.id_siswa
            $condition
        ";

        // echo '<pre>';
        // var_dump($sql);
        // die;

        return findAll($sql);
    }
}
