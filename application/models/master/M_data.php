<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_data extends CI_Model
{
    
    public function getdashboard()
    {
        $id = isset(json_decode($_POST['data'])[0]->id_skl) ? json_decode($_POST['data'])[0]->id_skl : 0;

        $sql = "
            select (
                select COUNT(*)  from app_skl where is_active in(0,1) and id in($id)
            ) as count_skl,
            (
                select COUNT(*)  from app_jurusan where is_active in(0,1) and id_skl in($id)
            ) as count_jurusan,
            (
                select COUNT(*)  from app_kelas where is_active in(0,1) and id_skl in($id)
            ) as count_kelas,
            (
                select COUNT(*)  from app_guru where is_active in(0,1) and id_skl in($id)
            ) as count_guru,
            (
                select COUNT(*)  from app_siswa where is_active in(0,1) and id_user !=0 and id_skl in($id)
            ) as count_siswa,

            (
                select COUNT(*)  from app_absensi_karyawan where date(date_of_entry) = date(now()) and is_active in(0,1) and id_skl in($id)
            ) as count_absensi_karyawan,
            (
                select COUNT(*)  from app_absensi_siswa where date(date_of_entry) = date(now()) and is_active in(0,1) and id_skl in($id)
            ) as count_absensi_siswa,
            (
                select COUNT(*)  from app_prestasi_siswa where is_active in(0,1) and id_skl in($id)
            ) as count_prestasi_siswa,
            (
                select COUNT(*)  from app_pelanggaran_siswa where is_active in(0,1) and id_skl in($id)
            ) as count_pelanggaran_siswa,
            
            (
                select COUNT(*)  from app_kata_motivasi where is_active in(0,1) and id_skl in($id)
            ) as count_kata_motivasi,
            (
                select COUNT(*)  from app_forum where id_forum_type = ".FORUM_ORANGTUA." and is_active in(0,1) and id_skl in($id)
            ) as count_forum_orangtua,
            (
                select COUNT(*)  from app_forum where id_forum_type = ".FORUM_SISWA." and is_active in(0,1) and id_skl in($id)
            ) as count_forum_siswa,
            (
                select COUNT(*)  from app_forum where id_forum_type = ".FORUM_GURU." and is_active in(0,1) and id_skl in($id)
            ) as count_forum_guru
            
        ";
// echo '<pre>';
// var_dump($sql); die;

        return findOne($sql);
    }
    public function getsekolah()
    {
        $id = isset(json_decode($_POST['data'])[0]->id_skl) ? json_decode($_POST['data'])[0]->id_skl : 0;

        return findOne("
            select
            (
                select 
                CONCAT('[',GROUP_CONCAT(CONCAT('{id:\"', id, '\",','nm_skl:\"',nm_skl,'\"','}')),']') as lists
                from app_skl where is_active = 1 and id in($id)
            ) as sekolah 
        ");
    }
}
