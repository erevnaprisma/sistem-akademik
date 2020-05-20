<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_user extends CI_Model
{
    public $table = 'app_user';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        mu.*,
                        if(
                            mu.user_type_id in(".USER_TYPE_SUPERADMIN.",".USER_TYPE_ADMINISTRATOR."),
                            (
                                select 
                                GROUP_CONCAT(id) as lists
                                from app_skl where is_active = ". STATUS_IS_ACTIVE ."
                            ),
                            mu.id_skl
                        ) as multi_sekolah,
                        if(
                            mu.user_type_id = ". USER_TYPE_PEDAGANG .",
                            (
                                select GROUP_CONCAT(apt.id) as lists from app_toko apt where apt.id_user = mu.id and  apt.is_active = ". STATUS_IS_ACTIVE ."
                            ),
                            ''
                        ) as outlet_id_all,
                        jk.name as jenis_kelamin,
                        ask.nm_skl as sekolah,
                        ask.icon as iconskl,
                        ask.favicon as faviconskl,
                        ask.slug,
                        if(mu.is_active=".STATUS_IS_ACTIVE.",'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        mut.name as user_type_name,
                        mut.menu_id_detail,
                        mut.menu_mobile
                        from app_user mu
                        left join app_user muc on muc.id = mu.created_by
                        left join app_user muu on muu.id = mu.updated_by
                        left join app_user_type mut on mut.id = mu.user_type_id 
                        left join app_jk jk on jk.id = mu.jk
                        left join app_skl ask on ask.id = mu.id_skl
                        where if(mu.user_type_id in(".USER_TYPE_SUPERADMIN.",".USER_TYPE_ADMINISTRATOR."),(mu.is_active !=9), (mu.is_active !=9 and ask.is_active = 1)) 
                    ) as mst
    ";
    // and mut.is_active != ". STATUS_IS_DELETE ."

    // public $where = ['mu.is_active in(0,1) ', 'mu.user_type_id not in (1,3,4)'];
    public $where = [];
    public $add_params = [];

    public $select = 'id,id_jurusan,slug,sekolah,iconskl,faviconskl,id_kelas,name,email,outlet_id,outlet_id_all,user_type_id,user_type_name,jenis_kelamin,is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

    public function __construct()
    {
        parent::__construct();
    }

    public function sql($id=null)
    {
        $condition = " where if(mu.user_type_id in(".USER_TYPE_SUPERADMIN.",".USER_TYPE_ADMINISTRATOR."),(mu.is_active !=9), (mu.is_active !=9 and ask.is_active = 1)) ";
        if (isset($_POST['id_skl'])) {
            $condition .= " and ask.id in(".$_POST['id_skl'].")";
        };

        return "
            select * from (
                select
                mu.*,
                if(
                    mu.user_type_id in(".USER_TYPE_SUPERADMIN.",".USER_TYPE_ADMINISTRATOR."),
                    (
                        select 
                        GROUP_CONCAT(id) as lists
                        from app_skl where is_active = ". STATUS_IS_ACTIVE ."
                    ),
                    mu.id_skl
                ) as multi_sekolah,
                if(
                    mu.user_type_id = ". USER_TYPE_PEDAGANG .",
                    (
                        select GROUP_CONCAT(apt.id) as lists from app_toko apt where apt.id_user = mu.id and  apt.is_active = ". STATUS_IS_ACTIVE ."
                    ),
                    ''
                ) as outlet_id_all,
                jk.name as jenis_kelamin,
                ask.nm_skl as sekolah,
                ask.icon as iconskl,
                ask.favicon as faviconskl,
                ask.slug,
                if(mu.is_active=".STATUS_IS_ACTIVE.",'YES','NO') as is_active_name,
                muc.name as created_by_name,
                muu.name as updated_by_name,
                mut.name as user_type_name,
                mut.menu_id_detail,
                mut.menu_mobile
                from app_user mu
                left join app_user muc on muc.id = mu.created_by
                left join app_user muu on muu.id = mu.updated_by
                left join app_user_type mut on mut.id = mu.user_type_id 
                left join app_jk jk on jk.id = mu.jk
                left join app_skl ask on ask.id = mu.id_skl
                $condition
            ) as mst
        ";
    }
    public function create($params = [])
    {
        $params = compareFields('create', $this->table, $params);
        $builder = $this->db->insert($this->table, $params);
        $id = $this->db->insert_id();
        return $builder ? $id : false;
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
                '.$this->sql().'
            ) as mst
        ');
        //add this line for join
        // $this->datatables->where('mst.is_active in(0,1) and mst.user_type_id not in (1,3,4)');
        $this->datatables->where('mst.is_active in(0,1)');
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');

        return $this->datatables->generate();
    }

    public function getprofil($params)
    {

        $id_siswa = $params['id_siswa'];
        $id_tahun = $params['id_tahun'];
        $id_kelas = $params['id_kelas'];

        $sql_siswa = "
            SELECT 
            aps.nama_siswa, aps.no_induk, aps.email, apu.foto,apu.id_tahun,apu.id_kelas,
            ask.nm_skl, ata.tahun,akl.nama_kelas
            from app_user apu
            left join app_siswa aps on aps.id_user = apu.id
            left join app_tahun_ajaran ata on ata.id = apu.id_tahun
            left join app_kelas akl on akl.id = apu.id_kelas
            left join app_skl ask on ask.id = apu.id_skl
            where apu.is_active = 1 and apu.id = '$id_siswa'
        ";

        $sql_absensi = "
            select ( 
                select 
                count(aas.id)
                from app_absensi_siswa aas
                where aas.is_active = 1 and aas.id_siswa = '$id_siswa' 
                and aas.id_tahun_ajaran = '$id_tahun' and aas.id_kelas = '$id_kelas'
                and aas.id_datang = 1
            ) as hadir,
            ( 
                select 
                count(aas.id)
                from app_absensi_siswa aas
                where aas.is_active = 1 and aas.id_siswa = '$id_siswa' 
                and aas.id_tahun_ajaran = '$id_tahun' and aas.id_kelas = '$id_kelas'
                and aas.id_datang = 2
            ) as ijin,
            ( 
                select 
                count(aas.id)
                from app_absensi_siswa aas
                where aas.is_active = 1 and aas.id_siswa = '$id_siswa' 
                and aas.id_tahun_ajaran = '$id_tahun' and aas.id_kelas = '$id_kelas'
                and aas.id_datang = 3
            ) as lambat,
            ( 
                select 
                count(aas.id)
                from app_absensi_siswa aas
                where aas.is_active = 1 and aas.id_siswa = '$id_siswa' 
                and aas.id_tahun_ajaran = '$id_tahun' and aas.id_kelas = '$id_kelas'
                and aas.id_datang = 4
            ) as sakit,
            ( 
                select 
                count(aas.id)
                from app_absensi_siswa aas
                where aas.is_active = 1 and aas.id_siswa = '$id_siswa' 
                and aas.id_tahun_ajaran = '$id_tahun' and aas.id_kelas = '$id_kelas'
                and aas.id_datang = 5
            ) as alfa

        ";

        $sql_nilai_siswa = "
            select 
            DATE_FORMAT(app.tanggal, '%d/%m/%Y') as tanggal,
            app.kode_ujian,
            app.materi,
            arp.materi as rpp_materi,
            apm.name as mapel,
            ans.nilai,
            ans.keterangan
            from app_penilaian app
            LEFT join app_nilai_siswa ans on ans.id_penilaian = app.id
            left join app_rpp arp on arp.id = app.id_rpp
            left join app_mapel apm on apm.id = app.id_mapel
            WHERE app.is_active = 1 and ans.is_active = 1 and ans.id_user = '$id_siswa'
            order by app.tanggal desc
        ";

        $sql_prestasi_siswa = "
            select 
            ata.tahun,
            apk.nama_kelas,
            DATE_FORMAT(aps.tanggal, '%d/%m/%Y') as tanggal,
            aps.prestasi
            from app_prestasi_siswa aps
            left join app_tahun_ajaran ata on ata.id = aps.id_tahun
            left join app_kelas apk on apk.id = aps.id_kelas
            where aps.is_active = 1 and aps.id_siswa = '$id_siswa'
            ORDER by aps.tanggal desc
        ";

        $sql_penilaian_diri = "
            select 
            ata.tahun,
            apk.nama_kelas,
            DATE_FORMAT(aks.tanggal, '%d/%m/%Y') as tanggal,
            aks.penilaian,
            apm.name as mapel
            from app_karakter_siswa aks
            left join app_tahun_ajaran ata on ata.id = aks.id_tahun_ajaran
            left join app_kelas apk on apk.id = aks.id_kelas
            left join app_mapel apm on apm.id = aks.id_mapel
            where aks.is_active = 1 and aks.flag ='diri' and aks.id_siswa = '$id_siswa'
            ORDER by aks.tanggal desc
        ";

        $sql_penilaian_teman = "
            select 
            ata.tahun,
            apk.nama_kelas,
            DATE_FORMAT(aks.tanggal, '%d/%m/%Y') as tanggal,
            aks.penilaian,
            apm.name as mapel
            from app_karakter_siswa aks
            left join app_tahun_ajaran ata on ata.id = aks.id_tahun_ajaran
            left join app_kelas apk on apk.id = aks.id_kelas
            left join app_mapel apm on apm.id = aks.id_mapel
            where aks.is_active = 1 and aks.flag ='teman' and aks.id_siswa = '$id_siswa'
            ORDER by aks.tanggal desc
        ";


        return [
            "siswa" => findOne($sql_siswa),
            "absensi" => findOne($sql_absensi),
            "nilai_siswa" => findOne($sql_nilai_siswa),
            "prestasi_siswa" => findOne($sql_prestasi_siswa),
            "penilaian_diri" => findOne($sql_penilaian_diri),
            "penilaian_teman" => findOne($sql_penilaian_teman),
        ];

    }
}
