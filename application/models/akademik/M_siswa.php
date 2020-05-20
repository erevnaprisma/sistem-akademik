<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_siswa extends CI_Model
{
    
    public $table = 'app_siswa';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        aps.*,
                        mu.id_jurusan,
                        mu.id_kelas,
                        mu.id_tahun,
                        mu.name as username,
                        mu.name,
                        mu.email as emailname,
                        if(aps.is_active=1,'YES','NO') as is_active_name,
                        jk.name as jenis_kelamin,
                        ask.nm_skl as sekolah,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        kls.nama_kelas,
                        jr.jurusan,
                        adp.nm_panggilan, adp.tmp_lahir, adp.tgl_lhr, adp.id_agm, adp.wrg, adp.suku, 
                        adp.id_goldar, adp.tinggi, adp.berat, adp.uk_baju, adp.uk_spt, adp.alamat, adp.telp, 
                        adp.id_sta_t_dgn, adp.id_tem_t_dgn, adp.id_jrk_rmh, adp.id_trn_rmh, adp.sta_t_dgn_lain, adp.tem_t_dgn_lain, 
                        adp.jrk_rmh_lain, adp.trn_rmh_lain, adp.status_anak, adp.ank_ke, adp.dari, 
                        adp.jml_sdr_kan, adp.jml_sdr_tir, adp.sdr_ang, adp.pendidikan_oleh, adp.beasiswa_oleh, adp.wrg_lain,

                        DATE_FORMAT(adp.tgl_lhr, '%d/%m/%Y') as tgl_lhr_name
                        from app_user mu
                        left join app_siswa aps on aps.id_user = mu.id
                        left join app_user muc on muc.id = aps.created_by
                        left join app_user muu on muu.id = aps.updated_by
                        left join app_jk jk on jk.id = aps.jk
                        left join app_skl ask on ask.id = mu.id_skl
                        left join app_kelas kls on kls.id = mu.id_kelas
                        left join app_jurusan jr on jr.id = mu.id_jurusan
                        left join app_data_pribadi adp on adp.id_siswa = mu.id
                        where aps.id is not null and aps.id_user !=0 and mu.user_type_id = ". USER_TYPE_SISWA ."
                        and ask.is_active = 1
                    ) as mst 

    ";
    public $where = [];
    public $add_params = [];

    
    public $select = '
        
        id,name,username,emailname,nama_siswa, no_induk, nisn, jk,jenis_kelamin, id_jurusan,id_tahun,id_kelas, id_kls, angkatan, hp_siswa, hp_ortu_1, hp_ortu_2, email, email_ortu_1, email_ortu_2, foto, id_skl,
        id_user, nama_kelas,jurusan,id_card,
        nm_panggilan, tmp_lahir, tgl_lhr, id_agm, wrg, suku, 
        id_goldar, tinggi, berat, uk_baju, uk_spt, alamat, telp, 
        id_sta_t_dgn, id_tem_t_dgn, id_jrk_rmh, id_trn_rmh, sta_t_dgn_lain, tem_t_dgn_lain, 
        jrk_rmh_lain, trn_rmh_lain, status_anak, ank_ke, dari, 
        jml_sdr_kan, jml_sdr_tir, sdr_ang, pendidikan_oleh, beasiswa_oleh, wrg_lain,
        
        tgl_lhr_name,id_skl,

        is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name
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


        if(isset($_POST['id_tahun']) && $_POST['id_tahun'] !=''){
            $this->datatables->where('mst.id_tahun = '.$_POST['id_tahun'].' ');
        }
        if(isset($_POST['id_kelas']) && $_POST['id_kelas'] !=''){
            $this->datatables->where('mst.id_kelas = '.$_POST['id_kelas'].' ');
        }

        if(isset($_POST['id_user']) && $_POST['id_user'] !=''){
            $this->datatables->where('mst.id_user in('.$_POST['id_user'].')');
        }

        if(isset($_POST['no_id_user']) && $_POST['no_id_user'] !=''){
            $this->datatables->where('mst.id_user not in('.$_POST['no_id_user'].')');
        }

        return $this->datatables->generate();
    }

    public function getsiswanative($params = [])
    {

        $read = findAll($this->sql . " where " . $params['where'] );

        return $read;
    }
}
