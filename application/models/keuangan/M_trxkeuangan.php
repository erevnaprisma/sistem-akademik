<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_trxkeuangan extends CI_Model
{
    public $table = 'trx_keuangan';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        tbl.*,
                        if(tbl.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        DATE_FORMAT(tbl.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(tbl.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                        skl.nm_skl, jt.jenis, ta.tahun,akg.kode as kode_gl,akg.name as name_gl,aps.nama_siswa
                        from trx_keuangan tbl
                        left join app_user muc on muc.id = tbl.created_by
                        left join app_user muu on muu.id = tbl.updated_by
                        left join app_skl skl on skl.id = tbl.id_skl
                        left join app_kode_gl akg on akg.id = tbl.id_kodegl
                        left join app_jns_transaksi jt on jt.id = tbl.id_jenistransaksi
                        left join app_tahun_ajaran ta on ta.id = tbl.id_tahun
                        left join app_siswa aps on aps.id_user = tbl.id_siswa and tbl.id_siswa != 0
                        where tbl.is_active != 9
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
        id, id_siswa, id_pegawai, id_tahun, id_kodegl, id_jenistransaksi, jurnal, qty, nominal, ket,  jenis,tahun,
        kode_gl, name_gl,nama_siswa,
        nm_skl, is_active_name,created_dt,created_dt_name,created_by_name,updated_dt,updated_dt_name,updated_by_name
    ';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_user');
    }

    public function create($params = [])
    {
        $params = compareFields('create', $this->table, $params);
        $builder = $this->db->insert($this->table, $params);
        $id = $this->db->insert_id();
        $detail = [];
        foreach ($_POST['detail'] as $a => $b) {
            $detail[] = [
                    "id_keuangan" => $id,
                    "ket" => $b->ket,
                    "nominal" => $b->nominal,
                    "id_skl" => $b->id_skl,
                    "id_itemtransaksi" => $b->id_itemtransaksi,
            ];
        }

        $this->db->insert_batch('trx_keuangan_detail', $detail); 

        $this->sendnotif($params);

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

        // yang lama didelete dulu 
        $this->db->update('trx_keuangan_detail',
            [
                "is_active" => STATUS_IS_DELETE,
            ],
            ["id_keuangan" => $id]
        ); 

        // baru insert lagi
        $detail = [];
        foreach ($_POST['detail'] as $a => $b) {
            $detail[] = [
                    "id_keuangan" => $id,
                    "ket" => $b->ket,
                    "nominal" => $b->nominal,
                    "id_skl" => $b->id_skl,
                    "id_itemtransaksi" => $b->id_itemtransaksi,
            ];
        }
        $this->db->insert_batch('trx_keuangan_detail', $detail); 


        $this->sendnotif($params);

        return $builder ? $id : false;
    }

    public function delete($id)
    {
        $builder = $this->db->update($this->table, ['is_active' => STATUS_IS_DELETE], [$this->id => $id]);

        $this->db->update('trx_keuangan_detail',
            [
                "is_active" => STATUS_IS_DELETE,
            ],
            ["id_keuangan" => $id]
        ); 
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


        // var_dump($_POST); die;

        if(isset($_POST['id_kodegl'])){
            $this->datatables->where('mst.id_kodegl in('.$_POST['id_kodegl'].')');
        }

        if(isset($_POST['id_jenistransaksi'])){
            $this->datatables->where('mst.id_jenistransaksi in('.$_POST['id_jenistransaksi'].')');
        }
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

        

        $condition = " where tku.is_active = 1 ";
        if(isset($params['id'])){
            $condition .= " and tku.id = ". $params['id'] ." ";
        }
        if(isset($params['id_itemtransaksi'])){
            $condition .= " and tku.id_itemtransaksi = ". $params['id_itemtransaksi'] ." ";
        }
        if(isset($params['id_jenistransaksi'])){
            $condition .= " and tku.id_jenistransaksi = ". $params['id_jenistransaksi'] ." ";
        }
        if(isset($params['id_siswa'])){
            $condition .= " and tku.id_siswa = ". $params['id_siswa'] ." ";
        }
        if(isset($params['id_tahun'])){
            $condition .= " and tku.id_tahun = ". $params['id_tahun'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and tku.id_skl = ". $params['id_skl'] ." ";
        }
        if(isset($params['id_kodegl'])){
            $condition .= " and tku.id_kodegl = ". $params['id_kodegl'] ." ";
        }


        if(
            isset($params['enddate']) && !empty($params['enddate'])
            && isset($params['startdate']) && !empty($params['startdate'])
        ){
            $condition .= " and date(tku.created_dt) >= '". $params['startdate'] ."' and date(tku.created_dt) <= '". $params['enddate'] ."' ";
        } else if(isset($params['startdate']) && !empty($params['startdate'])){
            $condition .= " and date(tku.created_dt) = '". $params['startdate'] ."' ";
        } else if(isset($params['enddate']) && !empty($params['enddate'])){
            $condition .= " and date(tku.created_dt) = '". $params['enddate'] ."' ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            tku.jurnal like '%".$params['like']."%' 
                            or tkd.nominal like '%".$params['like']."%' 
                            or tkd.ket like '%".$params['like']."%' 
                            or muc.name like '%".$params['like']."%'
                            or DATE_FORMAT(tku.created_dt, '%d/%m/%Y') like '%".$params['like']."%'
                        ) ";
        }


        $sql = "
            select 
            tku.id,tkd.id as id_detail, tku.id_skl, tku.id_siswa, tku.id_pegawai, tku.id_tahun, tku.id_kodegl,  tku.id_jenistransaksi, 
            tku.jurnal, tku.qty, tku.nominal, tku.ket, tkd.nominal as nominal_detail, tkd.id_itemtransaksi, tkd.ket as ket_detail,
            ask.nm_skl as sekolah,aps.nama_siswa,atb.tahun,akg.kode as kode_gl,akg.name as name_gl,ajt.jenis as jenis_transaksi,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(tku.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(tku.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
            DATE_FORMAT(tku.created_dt, '%d/%m/%Y') as tanggal_name
            from trx_keuangan tku
            left join app_user muc on muc.id = tku.created_by
            left join app_user muu on muu.id = tku.updated_by
            left join trx_keuangan_detail tkd on tkd.id_keuangan = tku.id and tkd.is_active = 1
            left join app_skl ask on ask.id = tku.id_skl
            left join app_siswa aps on aps.id_user = tku.id_siswa and tku.id_siswa != 0
            left join app_tahun_ajaran atb on atb.id = tku.id_tahun
            left join app_kode_gl akg on akg.id = tku.id_kodegl
            left join app_jns_transaksi ajt on ajt.id = tku.id_jenistransaksi
            left join app_item_transaksi ait on ait.id = tkd.id_itemtransaksi
            $condition
            order by tku.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }

    public function readitemdetail($params = [])
    {
        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        $id_siswa = "";
        if(isset($params['id_siswa'])){
            $id_siswa .= " and tku.id_siswa = ". $params['id_siswa'] ." ";
        }
        


        $condition = " where ait.is_active = 1 ";
        
        if(isset($params['id_tahun'])){
            $condition .= " and ait.id_a_thn = ". $params['id_tahun'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and ait.id_skl = ". $params['id_skl'] ." ";
        }
        if(
            isset($params['enddate']) && !empty($params['enddate'])
            && isset($params['startdate']) && !empty($params['startdate'])
        ){
            $condition .= " and date(tku.created_dt) >= '". $params['startdate'] ."' and date(tku.created_dt) <= '". $params['enddate'] ."' ";
        } else if(isset($params['startdate']) && !empty($params['startdate'])){
            $condition .= " and date(tku.created_dt) = '". $params['startdate'] ."' ";
        } else if(isset($params['enddate']) && !empty($params['enddate'])){
            $condition .= " and date(tku.created_dt) = '". $params['enddate'] ."' ";
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            tku.jurnal like '%".$params['like']."%' 
                            or tkd.nominal like '%".$params['like']."%' 
                            or tkd.ket like '%".$params['like']."%' 
                            or muc.name like '%".$params['like']."%'
                            or DATE_FORMAT(ait.alert_date, '%d/%m/%Y') like '%".$params['like']."%'
                            or DATE_FORMAT(tku.created_dt, '%d/%m/%Y') like '%".$params['like']."%'
                            or if(tkd.nominal is null,'UNPAID','PAID') like '%".$params['like']."%'
                        ) ";
        }


        $sql = "
            select
            ait.id, ait.pembayaran,ait.nominal,ait.alert_date,tku.jurnal,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            DATE_FORMAT(tku.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(tku.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
            DATE_FORMAT(tku.created_dt, '%d/%m/%Y') as tanggal_name,
            DATE_FORMAT(ait.alert_date, '%d/%m/%Y') as alert_date_name,
            atb.tahun,
            tkd.nominal as nominal_detail,
            tku.ket, tkd.ket as ket_detail
            from app_item_transaksi ait
            left join trx_keuangan_detail tkd on tkd.id_itemtransaksi = ait.id and tkd.is_active = 1 
            left join trx_keuangan tku on tku.id = tkd.id_keuangan $id_siswa
            left join app_tahun_ajaran atb on atb.id = tku.id_tahun
            left join app_user muc on muc.id = tku.created_by
            left join app_user muu on muu.id = tku.updated_by
            $condition
            order by ait.id asc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }

    public function getrekapkas($params = [])
    {
        $sql = "
            select 
            tku.id_kodegl,tku.id_jenistransaksi,sum(tku.nominal) as total
            from trx_keuangan tku
            left join app_skl ask on ask.id = tku.id_skl
            where tku.is_active = 1 
            and tku.id_skl = " . $params['id_skl'] . "
            and tku.id_tahun = " . $params['id_tahun'] . "
            group by tku.id_jenistransaksi
        ";
        // echo '<pre>';
        // var_dump($sql);die;
        return findAll($sql);
    }

    public function sendnotif($params = [])
    {
        if(isset($params['id_siswa']) && !empty($params['id_siswa'])){
            $user = $this->m_user->read([
                "id"=> $params['id_siswa']
            ]);

            if($user){
                // cari siswa id device
                $params = [
                    [
                        "to"=>$user[0]->id_device,
                        "title" =>'Transaksi ' . $params['jurnal'],
                        "sound"=>"default",
                        "body"=> "Telah ada transaksi sebesar Rp. " . $params['nominal'] . ", dengan keterangan " . $params['ket']
                    ]
                ];
                $notif = push_notification_expo($params);


                $params[0]['created_by'] = getCreatedById();
                $params[0]['created_dt'] = date('Y-m-d H:i:s');
                $this->db->insert_batch('trx_notip', $params); 
            }
        }
    }
}
