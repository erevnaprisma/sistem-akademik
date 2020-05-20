<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}


class M_absensi_siswa extends CI_Model
{
    public $table = 'app_absensi_siswa';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from ( 
                        select
                        abs.*,
                        (
                            CASE
                                WHEN abs.id_datang = 1 THEN 'Hadir'
                                WHEN abs.id_datang = 2 THEN 'Ijin'
                                WHEN abs.id_datang = 3 THEN 'Terlambat'
                                WHEN abs.id_datang = 4 THEN 'Sakit'
                                ELSE 'Alfa'
                            END
                        ) as kehadiran,
                        if(abs.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        siswa.nama_siswa, mp.name as mapel_name,
                        guru.name as nama_guru, ta.tahun, kls.nama_kelas, skl.nm_skl, jr.jurusan, sm.semester,
                        DATE_FORMAT(date_of_entry, '%d/%m/%Y %H:%i:%s') as date_of_entry_name,
                        DATE_FORMAT(date_of_out, '%d/%m/%Y %H:%i:%s') as date_of_out_name 
                        from app_absensi_siswa abs
                        left join app_user muc on muc.id = abs.created_by
                        left join app_user muu on muu.id = abs.updated_by
                        left join app_siswa siswa on siswa.id_user = abs.id_siswa
                        left join app_mapel mp on mp.id = abs.id_mapel
                        left join app_user guru on guru.id = abs.id_guru
                        left join app_semester sm on sm.id = abs.id_semester
                        left join app_tahun_ajaran ta on ta.id = abs.id_tahun_ajaran
                        left join app_kelas kls on kls.id = abs.id_kelas
                        left join app_jurusan jr on jr.id = abs.id_jurusan
                        left join app_skl skl on skl.id = abs.id_skl
                        where abs.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = 'id, date_of_entry, date_of_out,kehadiran, date_of_entry_name, date_of_out_name, nama_siswa, mapel_name, nama_guru, tahun, nama_kelas, nm_skl, jurusan, semester, ket, is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name';

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

    public function getGuru(){
        $skl = $this->input->post("skl");
        $mapel = $this->input->post("mapel");
        $is_active = $this->input->post("is_active");
        $this->db->select("a.id, b.name, a.id_mapel");
        $this->db->join("app_user b","b.id=a.id_user");        
        $data = $this->db->get_where("app_guru a",array("a.id_skl"=>$skl,"a.id_mapel"=>$mapel,"a.is_active"=>1))->result();
        return $data;
    }

    public function saveAbsen(){


        // echo '<pre>';
        //     var_dump($_POST);
        // die;


        $id_device = $this->input->post('id_device');
        $nama_siswa = $this->input->post('nama_siswa');
        $siswa = $this->input->post('abs_siswa');
        $kehadiran = $this->input->post('kehadiran');
        $keterangan = $this->input->post('keterangan');
        $skl = $this->input->post("skl");
        $jurusan = $this->input->post("jurusan");   
        $kelas = $this->input->post("kelas");
        $semester = $this->input->post("semester");
        $thn_ajar = $this->input->post("thn_ajar");
        $mapel = $this->input->post("mapel");
        $mapel_name = $this->input->post("mapel_name");
        $guru = $this->input->post("guru");
        $tanggal = $this->input->post("tanggal");
        $date = str_replace('/', '-', $tanggal );
        $user=$this->input->post("user");
        $tanggal = date("Y-m-d H:i:s", strtotime($date));
        //echo date("Y-m-d H:i:s", strtotime($tanggal)); die();
        $created_by = getCreatedById();
        if(count($siswa) > 0){
            $params = [];
            for($i=0; $i<count($siswa); $i++){
                $datas = [
                    'date_of_entry'=>$tanggal,
                    'ip_in'=>$_SERVER['REMOTE_ADDR'],
                    'id_siswa'=>$siswa[$i],
                    'id_mapel'=>$mapel,
                    'id_guru'=>$guru,
                    'id_semester'=>$semester,
                    'id_tahun_ajaran'=>$thn_ajar,
                    'id_kelas'=>$kelas,
                    'id_jurusan'=>$jurusan,
                    'id_indikator'=>1,
                    'id_datang'=>$kehadiran[$i],
                    'ket'=>$keterangan[$i],
                    'id_skl'=>$skl,
                    'is_active'=>1,
                    'created_by'=>$user,
                    'created_dt'=>date('Y-m-d H:i:s')
                ];
                $this->db->insert("app_absensi_siswa",$datas);

                if($kehadiran[$i]==1){
                    $ket = "HADIR";
                } else if($kehadiran[$i]==2){
                    $ket = "IJIN";
                } else if($kehadiran[$i]==3){
                    $ket = "TERLAMBAT";
                } else if($kehadiran[$i]==4){
                    $ket = "SAKIT";
                } else {
                    $ket = "ALFA";
                }

                if(!empty($id_device[$i])){
                    $params[] = [
                        "to"=> $id_device[$i],
                        "title" =>'Absensi MAPEL ' . $mapel_name,
                        "sound"=>"default",
                        "body"=> "Pada pkl. ". $this->input->post("tanggal") 
                        .", ananda " . $nama_siswa[$i] . " " .$ket . " pada mata pelajaran " . $mapel_name . " " . $keterangan[$i] . ".",
                        "id_user" => $siswa[$i],
                        'created_by' => $created_by,
                        'created_dt' => date('Y-m-d H:i:s'),
                    ];
                }
            }

            if(count($params) > 0 ){
                $this->db->insert_batch('trx_notip', $params); 
                
                foreach ($params as $a => $b) {
                    // hilangkan id_user
                    unset($params[$a]['id_user']);
                    unset($params[$a]['created_by']);
                    unset($params[$a]['created_dt']);
                }
                
                $notif = push_notification_expo($params);
            }
            
        }
    }
    public function lapabsensimapel($param = [])
    {

        $condition = "
            where aas.is_active = 1 and aas.id_skl = ".$param['id_skl']." 
            and aas.id_tahun_ajaran = ".$param['id_tahun_ajaran']."
            and aas.id_kelas = ".$param['id_kelas']."
        ";

        if(isset($param['id_mapel']) && !empty($param['id_mapel'])){
            $condition .= " and aas.id_mapel = ".$param['id_mapel']." ";
        }

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
        ";
        

        return findAll($sql);
    }
}
