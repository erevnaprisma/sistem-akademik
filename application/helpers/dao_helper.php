<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



if (!function_exists('findAll')) {

    function findAll($sql, $params = []) {
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query($sql, $params);
        return $query->result();
    }

}
if (!function_exists('findAllArray')) {

    function findAllArray($sql, $params = []) {
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query($sql, $params);
        return $query->result_array();
    }

}
if (!function_exists('findOne')) {

    function findOne($sql, $params = []) { //$t = findOne('select * from user where username =?',['rosinahekadwi']);
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query($sql . ' LIMIT 1', $params);
        return isset($query->result()[0]) ? $query->result()[0] : [];
    }

}
if (!function_exists('insertMultiRecord')) {

    function insertMultiRecord($tabel, $params, $key = null) {
        $CI = & get_instance();
        $CI->load->database();
        $tbl = 'insert into ' . $tabel . ' ';
        foreach ($params as $key => $value) {
            $column = '(' . implode(',', array_keys($value)) . ')';
            $data[] = '("' . implode('","', $value) . '")';
        }

        $sql = $tbl . $column . ' values ' . join(',', $data);
        $query = $CI->db->query($sql);
        return $CI->db->affected_rows();
    }

}
if (!function_exists('updateCommand')) {

    function updateCommand($tabel, $params = [], $conditions = []) {
        $CI = & get_instance();
        $CI->load->database();
        $params = joinKeyValueArray('=', $params, ' , ');
        $conditions = joinKeyValueArray('=', $conditions, ' AND ');

        $sql = "UPDATE $tabel SET $params WHERE $conditions ";

        var_dump($sql);
        
        $query = $CI->db->query($sql);
        return $query->result();
    }

}
if (!function_exists('deleteCommand')) {

    function deleteCommand($tabel, $conditions) {
        $CI = & get_instance();
        $CI->load->database();
        $conditions = joinKeyValueArray('=', $conditions, ' AND ');

        $sql = "DELETE FROM $tabel WHERE $conditions ";

        $query = $CI->db->query($sql);
        return $query ? TRUE : FALSE;
    }

}