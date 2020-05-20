<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_absensi_siswa_main extends CI_Model
{
    public $table = 'app_absensi_siswa2';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        SELECT
                        a.is_active,
                        b.id_skl,
                        a.date_of_entry,
                        a.date_of_out,
                        DATE_FORMAT(date_of_entry, '%d/%m/%Y %H:%i:%s') as date_of_entry_name,
                        DATE_FORMAT(date_of_out, '%d/%m/%Y %H:%i:%s') as date_of_out_name,
                        b.nama_siswa,
                        b.id_user as id_siswa,
                        c.nm_skl,
                        '' as jurusan,
                        e.nama_kelas,
                        IF(TIME(a.date_of_entry) - TIME('07:00:00') < 0, 'Ontime', 'Terlambat') as terlambat
                        FROM app_absensi_siswa2 a
                        left JOIN app_siswa b on a.id_siswa = b.id_card
                        left JOIN app_skl c ON b.id_skl = c.id
                        left JOIN app_kelas e on b.id_kls = e.id
                        where a.is_active != 9 and c.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'date_of_entry, date_of_out,date_of_entry_name, date_of_out_name,id_siswa, nama_siswa, nm_skl, jurusan, nama_kelas, terlambat';

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

    public function count($params)
    {
        return findOne('
            select ( 
                select count(*) 
                from app_absensi_siswa mst
                left join app_siswa aps on aps.id_user = mst.id_siswa
                left join app_absensi_siswa2 abs on abs.id_siswa = aps.id_card
                where date(mst.date_of_entry) != date(abs.date_of_entry)
                and date(mst.date_of_entry) >= "'.$params['start'].'"
                and date(mst.date_of_entry) <= "'.$params['end'].'"
            ) as alfa, 
            (
                select count(*) 
                from app_absensi_siswa2 mst
                left join app_siswa aps on aps.id_card = mst.id_siswa
                where aps.id_user = '.$params['id_siswa'].'
                and date(mst.date_of_entry) >= "'.$params['start'].'"
                and date(mst.date_of_entry) <= "'.$params['end'].'"
            ) as masuk, 
            (
                0
            ) as ijin
        ');
    }

    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        $condition = " where aas.is_active = 1 ";
        if(isset($params['id'])){
            $condition .= " and aas.id = ". $params['id'] ." ";
        }
        if(isset($params['id_siswa'])){
            $condition .= " and b.id_user = ". $params['id_siswa'] ." ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            IF(TIME(aas.date_of_entry) - TIME('07:00:00') <= 0, 'Ontime', 'Terlambat') like '%".$params['like']."%'
                            or DATE_FORMAT(aas.date_of_entry, '%d/%m/%Y %H:%i:%s') like '%".$params['like']."%' 
                            or DATE_FORMAT(aas.date_of_out, '%d/%m/%Y %H:%i:%s') like '%".$params['like']."%'
                        ) ";
        }


        $sql = "
            SELECT
            aas.id,
            aas.is_active,
            b.id_skl,
            aas.date_of_entry,
            aas.date_of_out,
            DATE_FORMAT(aas.date_of_entry, '%d/%m/%Y %H:%i:%s') as date_of_entry_name,
            DATE_FORMAT(aas.date_of_out, '%d/%m/%Y %H:%i:%s') as date_of_out_name,
            DATE_FORMAT(aas.date_of_entry, '%H:%i:%s') as time_entry_name,
            DATE_FORMAT(aas.date_of_out, '%H:%i:%s') as time_out_name,
            DATE_FORMAT(aas.date_of_out, '%d/%m/%Y') as date_name,
            IF(TIME(aas.date_of_entry) - TIME('07:00:00') <= 0, 'Ontime', 'Terlambat') as keterangan,
            b.nama_siswa,
            b.id_user as id_siswa,
            c.nm_skl,
            '' as jurusan,
            e.nama_kelas
            FROM app_absensi_siswa2 aas
            left JOIN app_siswa b on aas.id_siswa = b.id_card
            left JOIN app_skl c ON b.id_skl = c.id
            left JOIN app_kelas e on b.id_kls = e.id
            $condition
            order by aas.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }


    // public function lapabsensisiswa($param = [])
    // {

    //     $condition = "
    //         where aas.is_active = 1 and aus.id_skl = ".$param['id_skl']." 
    //         and aus.id_tahun = ".$param['id_tahun_ajaran']."
    //     ";

    //     $sql = "
    //         select 
    //         aas.date_of_entry, 
    //         aas.date_of_out,
    //         aus.id as id_siswa, aps.no_induk, aps.nama_siswa
    //         from app_absensi_siswa2 aas
    //         left join app_siswa aps on aps.id_card = aas.id_siswa
    //         left join app_user aus on aus.id = aps.id_user
    //         $condition
    //     ";
        

    //     // echo '<pre>';
    //     // var_dump($sql); die;
    //     return findAll($sql);
    // }

    public function lapabsensisiswa($param = [])
    {

        $condition = "
            where aas.is_active = 1 and aas.id_skl = ".$param['id_skl']." 
            and aas.id_tahun_ajaran = ".$param['id_tahun_ajaran']."
        ";
        $sql = "
            select aas.date_of_entry, aas.date_of_out,
            aas.id_mapel,aas.id_datang,
            (
                CASE
                    WHEN aas.id_datang = 1 THEN 'Hadir'
                    WHEN aas.id_datang = 2 THEN 'Ijin'
                    WHEN aas.id_datang = 3 THEN 'Terlambat'
                    WHEN aas.id_datang = 4 THEN 'Sakit'
                    ELSE 'Alfa'
                END
            ) as kehadiran,
            aas.id_siswa,aps.nama_siswa,aps.no_induk, mp.name as mapel_name
            from app_absensi_siswa aas 
            left join app_siswa aps on aps.id_user = aas.id_siswa
            left join app_mapel mp on mp.id = aas.id_mapel
            $condition
            group by date(aas.date_of_entry)
        ";
        

        // echo '<pre>';
        // var_dump($sql); die;
        return findAll($sql);
    }
}
