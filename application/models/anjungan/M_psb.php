<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_psb extends CI_Model
{
    public $status = ['Baru','Seleksi','Diterima','Ditolak'];
    public $table = 'app_psb';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                    select
                    aps.*,
                    ta.tahun,ask.slug,
                    jk.name as jenis_kelamin,
                    if(aps.is_active=1,'YES','NO') as is_active_name,
                    muc.name as created_by_name,
                    muu.name as updated_by_name
                    from app_psb aps
                    left join app_user muc on muc.id = aps.created_by
                    left join app_user muu on muu.id = aps.updated_by
                    left join app_tahun_ajaran ta on ta.id = aps.id_tahun
                    left join app_jk jk on jk.id = aps.jk
                    left join app_skl ask on ask.id = aps.id_skl
                    where aps.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, 
    in_siswa,
    slug,
    status,
    jenis_kelamin,
    tahun,
    id_tahun,
    alamat,
    alergi,
    almt_knt_ayah,
    almt_knt_ibu,
    almt_rmh_ayah,
    almt_rmh_ibu,
    ank_ke,
    bahasa,
    bahasalain,
    berat,
    cita,
    dari,
    foto,
    gaji_ayah,
    gaji_ibu,
    hp_ortu_1,
    hp_ortu_2,
    hp_siswa,
    id_agm,
    id_goldar,
    id_pek_ayah,
    id_pek_ibu,
    id_pndd_ayah,
    id_pndd_ibu,
    id_skl,
    instansi_ayah,
    instansi_ibu,
    is_active,
    jk,
    jabatan_ayah,
    jabatan_ibu,
    jml_sdr_kan,
    jml_sdr_tir,
    nama_siswa,
    nm_ayah,
    nm_ibu,
    nm_panggilan,
    nomor,
    penyakit,
    pnddk_ayah,
    pnddk_ibu,
    sdr_ang,
    tanggal_daftar,
    tgl_lhr,
    tgl_lhr_ayah,
    tgl_lhr_ibu,
    tinggi,
    tmp_lahir,
    tmp_lhr_ayah,
    tmp_lhr_ibu,
    wrg,
    wrg_ayah,
    wrg_ibu,
    is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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

    public function diterimajson()
    {
        $this->datatables->select($this->select);
        $this->datatables->from('
            (
                '.$this->sql.'
            ) as mst
        ');
        //add this line for join
        $this->datatables->where('mst.is_active in(0,1)');
        $this->datatables->where('mst.status = "Diterima"');
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');
        return $this->datatables->generate();
    }
}
