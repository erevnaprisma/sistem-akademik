<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_info extends CI_Model
{
    public $table = 'm_info_skl';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                select * from (
                    select
                    mis.*,
                    if(mis.is_active=1,'YES','NO') as is_active_name,
                    DATE_FORMAT(mis.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                    DATE_FORMAT(mis.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name, 
                    muc.name as created_by_name,
                    muu.name as updated_by_name,
                    ask.nm_skl as sekolah,
                    ask.slug as slug,
                    (
                        case
                            when mis.flag= " . INFO_SEKOLAH_GURU . "
                                then 'GURU'
                            when mis.flag= " . INFO_SEKOLAH_SISWA . "
                                then 'SISWA'
                            else ''
                        end 
                    ) as flaging,
                    (
                        select count(*) from t_dokumen tdk where tdk.flag = ". DOKUMEN_KOMEN ." and tdk.id_trx = mis.id and is_active = ".STATUS_IS_ACTIVE."
                    ) as komen,
                    (
                        select count(*) from t_dokumen tdk where tdk.flag = ". DOKUMEN_IMG ." and tdk.id_trx = mis.id and is_active = ".STATUS_IS_ACTIVE."
                    ) as gambar,
                    (
                        select count(*) from t_dokumen tdk where tdk.flag = ". DOKUMEN_VID ." and tdk.id_trx = mis.id and is_active = ".STATUS_IS_ACTIVE."
                    ) as video,
                    (
                        select tdk.name from t_dokumen tdk where tdk.flag = ". DOKUMEN_IMG ." and tdk.id_trx = mis.id and is_active = ".STATUS_IS_ACTIVE." limit 1
                    ) as img_first,
                    (
                        select tdk.name from t_dokumen tdk where tdk.flag = ". DOKUMEN_VID ." and tdk.id_trx = mis.id and is_active = ".STATUS_IS_ACTIVE." limit 1
                    ) as vid_first
                    from m_info_skl mis
                    left join app_user muc on muc.id = mis.created_by
                    left join app_user muu on muu.id = mis.updated_by
                    left join app_skl ask on ask.id = mis.id_skl
                    where mis.is_active != 9 and ask.is_active = 1 and mis.flag = ".INFO_SEKOLAH_GURU."
                ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
            id, sekolah, slug, kepada, note, gambar, komen, video,img_first,vid_first, dibaca, flag, flaging, hal,
            is_active, is_active_name,created_dt,created_by_name,updated_dt,updated_by_name,created_dt_name,updated_dt_name
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

        // var_dump($_POST['hal']); die;
        $this->datatables->select($this->select);
        $this->datatables->from('
            (
                '.$this->sql.'
            ) as mst
        ');
        //add this line for join
        if(isset($_POST['hal'])) {
            $this->datatables->where('mst.hal = "'.$_POST['hal'].'"');
        }
        if(isset($_POST['id_skl'])) {
            $this->datatables->where('mst.id_skl = "'.$_POST['id_skl'].'"');
        }
        $this->datatables->where('mst.is_active in(0,1) and mst.flag = '.INFO_SEKOLAH_GURU);
        return $this->datatables->generate();
    }
}
