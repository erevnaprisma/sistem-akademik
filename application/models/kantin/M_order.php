<?php

if (!defined('BASEPATH')) {
    exit('No direct script allowed');
}

class M_order extends CI_Model
{
    public $table = 'app_orders';
    public $alias = 'mst';
    public $id = 'id';
    public $order = 'DESC';
    public $limit = 20;
    public $sql = "
                    select * from (
                        select
                        aod.*,
                        if(aod.is_active=1,'YES','NO') as is_active_name,
                        muc.name as created_by_name,
                        muu.name as updated_by_name,
                        if(aod.paid_amt > 0,'Yes','No') as lunas,
                        if(aod.is_taken,'Already Taken','Not Taken') as is_taken_name,
                        DATE_FORMAT(aod.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
                        DATE_FORMAT(aod.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
                        atk.foto,
                        ask.nm_skl as sekolah
                        from app_orders aod
                        left join app_user muc on muc.id = aod.created_by
                        left join app_user muu on muu.id = aod.updated_by
                        left join app_skl ask on ask.id = aod.id_skl
                        left join app_toko atk on atk.id = aod.outlet_id
                        where aod.is_active != 9 and ask.is_active = 1
                    ) as mst
    ";
    public $where = [];
    public $add_params = [];

    public $select = '
    id, foto, customer_id, customer_name, customer_email, customer_mobile, 
    ordered_datetime, outlet_id, outlet_name, outlet_address, outlet_contact, outlet_receipt_footer, 
    gift_card, subtotal, discount_total, discount_percentage, tax, grandtotal, total_items, 
    payment_method, payment_method_name, cheque_number, paid_amt, return_change, 
    vt_status, status, refund_status, remark, card_number,lunas,is_taken_name,is_taken,
    is_active,is_active_name,created_dt,created_dt_name,created_by_name,updated_dt,updated_dt_name,updated_by_name';

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
        //var_dump($this->sql); die;
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
        if(isset($_POST['created_by'])){
            $this->datatables->where('mst.created_by = ' . $_POST['created_by'] . ' ');
        }
        if(isset($_POST['outlet_id'])){
            $this->datatables->where('mst.outlet_id in(' . $_POST['outlet_id'] . ') ');
        }

        return $this->datatables->generate();
    }

    public function getcountorder(){
        $condition = "";
        $is_active = "is_active = 1";
        if(isset($_POST['is_active'])){
            $condition .= " AND is_active = " . $_POST['is_active'] ;
        }
        if(isset($_POST['created_dt'])){
            $condition .= " AND date(created_dt) = date('". $_POST['created_dt'] ."')" ;
        }
        $sql = "
            select 
            (
                select sum(grandtotal) from app_orders where payment_method = 1 $condition
            ) as cash,
            (
                select sum(grandtotal) from app_orders where payment_method = 2 $condition
            ) as visa_card,
            (
                select sum(grandtotal) from app_orders where payment_method = 3 $condition
            ) as master_card,
            (
                select sum(grandtotal) from app_orders where payment_method = 4 $condition
            ) as debit_card,
            (
                select sum(grandtotal) from app_orders where payment_method = 5 $condition
            ) as gift_card,
            (
                select sum(grandtotal) from app_orders where 1=1 $condition
            ) as total,
            (
                0
            ) as nett
        ";


        // select sum(subtotal) from app_orders where 1=1 $condition

        // var_dump($sql); die;
        return findOne($sql);
    }


    public function readdetail($params=[])
    {

        $limit = " ";
        if(isset($params['page'])){
            $start = ($params['page'] - 1) * PAGING;
            // $end = $start + PAGING;
            $limit = " limit $start," . PAGING;
        }

        

        // $condition = " where aod.is_active = 1";
        $condition = " where 1 = 1";

        if(isset($params['id'])){
            $condition .= " and aod.id = ". $params['id'] ." ";
        }
        if(isset($params['id_skl'])){
            $condition .= " and aod.id_skl = '". $params['id_skl'] ."' ";
        }
        if(isset($params['outlet_id'])){
            $condition .= " and aod.outlet_id = '". $params['outlet_id'] ."' ";
        }

        if(isset($params['tab'])){
            if($params['tab']=="order"){
                $condition .= " and aod.paid_amt = 0 and aod.is_active = 1 ";
            } else if($params['tab']=="batal") {
                $condition .= " and aod.is_active = 0 ";
            } else if($params['tab']=="history") {
                $condition .= " and aod.is_taken = 1 ";
            }
        }

        $like = " ";
        if(isset($params['like']) && !empty($params['like'])){
            $condition .= " 
                        and (
                            aod.total_items like '%".$params['like']."%' 
                            or aod.grandtotal like '%".$params['like']."%' 
                            or aod.customer_name like '%".$params['like']."%' 
                            or aod.payment_method_name like '%".$params['like']."%' 
                            or DATE_FORMAT(aod.created_dt, '%d/%m/%Y %H:%i:%s') like '%".$params['like']."%' 
                        ) ";
        }

        $sql = "
            select
            aod.*,
            if(aod.is_active=1,'YES','NO') as is_active_name,
            muc.name as created_by_name,
            muu.name as updated_by_name,
            if(aod.paid_amt > 0,'Yes','No') as lunas,
            if(aod.is_taken,'Already Taken','Not Taken') as is_taken_name,
            DATE_FORMAT(aod.created_dt, '%d/%m/%Y %H:%i:%s') as created_dt_name,
            DATE_FORMAT(aod.updated_dt, '%d/%m/%Y %H:%i:%s') as updated_dt_name,
            atk.foto,
            ask.nm_skl as sekolah
            from app_orders aod
            left join app_user muc on muc.id = aod.created_by
            left join app_user muu on muu.id = aod.updated_by
            left join app_skl ask on ask.id = aod.id_skl
            left join app_toko atk on atk.id = aod.outlet_id
            $condition
            order by aod.id desc
            $limit
        ";
        // echo '<pre>';
        // var_dump($sql); die;
        $read = findAll($sql);

        return $read;
    }
}
