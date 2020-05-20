<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_transaksikeuangan extends CI_Model
{
    public $table = 'trans_umum';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        atu.*,
                        atu.id_kls as id_kelas,
                        atu.id_aka as id_jurusan,
                        if(atu.is_active=1,'YES','NO') as is_active_name,
                        if(atu.status=1,'YES','NO') as status_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(atu.tgl, '%d/%m/%Y') as tanggal_name,
                        DATE_FORMAT(atu.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(atu.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                        ajt.jenis, GROUP_CONCAT(atu.ket) as group_ket, 
                        if(atu.debet=0,sum(atu.kredit),sum(atu.debet)) as nominal,
                        akg.id as id_kode_gl, akg.name as group_name,
                        ass.nama_siswa, aks.nama_kelas,ask.nm_skl,
                        apg.nama as nama_pegawai
                        from trans_umum atu
                        left join app_user muc on muc.id = atu.created_by
                        left join app_user muu on muu.id = atu.updated_by
                        left join app_jns_transaksi ajt on ajt.id = atu.jenis_transaksi
                        left join app_kode_gl akg on akg.id = ajt.id_kode_gl
                        left join app_siswa ass on ass.id_user = atu.id_siswa
                        left join app_kelas aks on aks.id = atu.id_kls
                        left join app_skl ask on ask.id = atu.id_skl
                        left join app_pegawai apg on apg.id = atu.id_peg
                        where atu.is_active != 9
                        group by atu.id
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, tgl,tanggal_name, jurnal, norek, kode_gl, debet, kredit, kode_reg, ket, d-tunai, k-tunai, id_user, ref, jenis_transaksi, 
    urutan, sub_transaksi, ur, sal_rek, sal_rate, id_siswa, id_peg, id_kls,id_kelas, id_aka,id_jurusan, id_a_thn, id_skl,status,status_name,
    is_active,is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,
    jenis,group_ket,nominal,id_kode_gl,group_name,created_dt_name,updated_dt_name,
    nama_siswa,nama_kelas,nama_pegawai
    ';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($params = [])
    {
        $params = compareFields('create', $this->table, $params);
        $builder = $this->db->insert($this->table, $params);



        return $builder ? findAll('select * from '.$this->table.' where id =' .$this->db->insert_id()) : false;
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

        return $builder ? readSql($this, ['id'=>$id]) : false;
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
                where '.$this->alias.'.is_active = '.STATUS_IS_ACTIVE.'
                group by '.$this->alias.'.id asc
            ) as mst
        ');
        //add this line for join
        $this->datatables->where('mst.is_active in(0,1)');
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');

        if(isset($_POST['jurnal'])){
            $this->datatables->where('mst.jurnal = ' . $_POST['jurnal']);
        }

        return $this->datatables->generate();
    }

    public function jurnaljson()
    {
        $condition = 'where atu.is_active = '.STATUS_IS_ACTIVE ;
        if(!empty($_POST['id_skl'])){
            $condition = ' and ask.id in('.$_POST['id_skl'].') ' ;
        }
        $this->datatables->select($this->select);
        $this->datatables->from('
            (
                    select
                    atu.*,
                    atu.id_kls as id_kelas,
                        atu.id_aka as id_jurusan,
                    if(atu.is_active=1,"YES","NO") as is_active_name,
                    if(atu.status=1,"YES","NO") as status_name,
                    muc.name as created_by_name,
                    muu.name as updated_by_name,
                    DATE_FORMAT(atu.tgl, "%d/%m/%Y") as tanggal_name,
                    DATE_FORMAT(atu.created_dt, "%d/%m/%Y %H:%i:%s") as created_dt_name,
                    DATE_FORMAT(atu.updated_dt, "%d/%m/%Y %H:%i:%s") as updated_dt_name, 
                    ajt.jenis, GROUP_CONCAT(atu.ket separator "<br>") as group_ket, 
                    if(atu.debet=0,sum(atu.kredit),sum(atu.debet)) as nominal,
                    akg.id as id_kode_gl, akg.name as group_name,
                    ass.nama_siswa, aks.nama_kelas,ask.nm_skl,
                    apg.nama as nama_pegawai
                    from trans_umum atu
                    left join app_user muc on muc.id = atu.created_by
                    left join app_user muu on muu.id = atu.updated_by
                    left join app_jns_transaksi ajt on ajt.id = atu.jenis_transaksi
                    left join app_kode_gl akg on akg.id = ajt.id_kode_gl
                    left join app_siswa ass on ass.id_user = atu.id_siswa
                    left join app_kelas aks on aks.id = atu.id_kls
                    left join app_skl ask on ask.id = atu.id_skl
                    left join app_pegawai apg on apg.id = atu.id_peg
                    '.$condition.'
                group by atu.jurnal asc
                order by atu.is_active desc
            ) as mst
            
        ');

    //     var_dump('(
    //         select
    //         atu.*,
    //         atu.id_kls as id_kelas,
    //             atu.id_aka as id_jurusan,
    //         if(atu.is_active=1,"YES","NO") as is_active_name,
    //         if(atu.status=1,"YES","NO") as status_name,
    //         muc.name as created_by_name,
    //         muu.name as updated_by_name,
    //         DATE_FORMAT(atu.tgl, "%d/%m/%Y") as tanggal_name,
    //         DATE_FORMAT(atu.created_dt, "%d/%m/%Y %H:%i:%s") as created_dt_name,
    //         DATE_FORMAT(atu.updated_dt, "%d/%m/%Y %H:%i:%s") as updated_dt_name, 
    //         ajt.jenis, GROUP_CONCAT(atu.ket separator "<br>") as group_ket, 
    //         if(atu.debet=0,sum(atu.kredit),sum(atu.debet)) as nominal,
    //         akg.id as id_kode_gl, akg.name as group_name,
    //         ass.nama_siswa, aks.nama_kelas,ask.nm_skl,
    //         apg.nama as nama_pegawai
    //         from trans_umum atu
    //         left join app_user muc on muc.id = atu.created_by
    //         left join app_user muu on muu.id = atu.updated_by
    //         left join app_jns_transaksi ajt on ajt.id = atu.jenis_transaksi
    //         left join app_kode_gl akg on akg.id = ajt.id_kode_gl
    //         left join app_siswa ass on ass.id_user = atu.id_siswa
    //         left join app_kelas aks on aks.id = atu.id_kls
    //         left join app_skl ask on ask.id = atu.id_skl
    //         left join app_pegawai apg on apg.id = atu.id_peg
    //         '.$condition.'
    //     group by atu.jurnal asc
    //     order by atu.is_active desc
    // ) as mst'); die;
        //add this line for join
        $this->datatables->where('mst.is_active in(0,1)');
        $this->datatables->where('mst.id_skl in('.$_POST['id_skl'].')');

        if(isset($_POST['jurnal'])){
            $this->datatables->where('mst.jurnal = ' . $_POST['jurnal']);
        }

        return $this->datatables->generate();
    }

    public function generateNumber($id_skl)
    {
        $number = 1;
        $sql = findOne("
            SELECT (kode_reg + 1) as kode_reg FROM trans_umum 
            WHERE date(tgl) = date(now()) and id_skl = $id_skl
            order by tgl desc
        ");
        if($sql){
            $number = $sql->kode_reg;
        }
        return $number;
    }

    public function readdetail($params=[])
    {
        $where = [" mst.is_active = 1 "];
        if(isset($_POST['jurnal'])){
            $where[] = " mst.jurnal = " . $_POST['jurnal'] ." ";
        }
        if(isset($_POST['where'])){
            $where[] = $_POST['where'];
        }
        //var_dump($this->sql); die;
        $read = findAll($this->sql." where ". implode(" AND ", $where ) ." group by mst.id ");

        return $read;
    }
}
