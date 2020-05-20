<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_kenaikan_kelas extends CI_Model
{
    public $table = 'trx_kenaikan_kelas';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        kk.*,
                        if(kk.is_active=1,'YES','NO') as is_active_name,
                        kls.nama_kelas, jr.jurusan, sm.semester, aus.id_user, aus.nama_siswa,
                        ata.tahun,ask.nm_skl,ask.alamat,ask.kepala_sekolah,ask.foto,ask.kota,
                        aus.no_induk,aus.email,aus.nisn,usr.name as wali_kelas_name,
                        ajk.name as jenis_kelamin, 
                        muc.name as created_by_name,
                        muu.name as updated_by_name
                        from trx_kenaikan_kelas kk
                        left join app_user muc on muc.id = kk.created_by
                        left join app_user muu on muu.id = kk.updated_by
                        left join app_kelas kls on kls.id = kk.id_kelas
                        left join app_jurusan jr on jr.id = kk.id_jurusan
                        left join app_semester sm on sm.id = kk.id_semester
                        left join app_siswa aus on aus.id_user = kk.id_siswa
                        left join app_tahun_ajaran ata on ata.id = kk.id_tahun
                        left join app_skl ask on ask.id = kk.id_skl
                        left join app_jk ajk on ajk.id = aus.jk
                        left join app_wali_kelas awk on awk.id_tahun_ajaran = kk.id_tahun 
                        and awk.id_semester = kk.id_semester
                        and awk.id_jurusan = kk.id_jurusan
                        and awk.id_kelas = kk.id_kelas
                        left join app_user usr on usr.id = awk.id_user
                        where kk.is_active != 9 and aus.nama_siswa is not null  and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, tahun, alamat, kota, nm_skl, kepala_sekolah, foto, jurusan, nama_kelas, wali_kelas,wali_kelas_name,semester, id_user, nama_siswa, email, no_induk, nisn, jenis_kelamin, status, keterangan, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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
        if(isset($_POST['id_tahun'])){
            $this->datatables->where('mst.id_tahun in('.$_POST['id_tahun'].')');
        }
        if(isset($_POST['id_semester'])){
            $this->datatables->where('mst.id_semester in('.$_POST['id_semester'].')');
        }
        if(isset($_POST['id_jurusan'])){
            $this->datatables->where('mst.id_jurusan in('.$_POST['id_jurusan'].')');
        }

        if(isset($_POST['id_kelas'])){
            $this->datatables->where('mst.id_kelas in('.$_POST['id_kelas'].')');
        }
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');
        return $this->datatables->generate();
    }
}
