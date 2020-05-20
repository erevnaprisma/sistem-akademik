<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if(!function_exists('getCreatedById')){
    function getCreatedById(){
        // untuk mendapatkan id_user
        $headers = cekAuthorization(apache_request_headers());
        $user_id = null;
        if (isset($headers['Authorization']) && !empty($headers['Authorization'])) {
            // $decodedToken = authorization::validateTimestamp($headers['Authorization']);
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            $user_id = isset($decodedToken->user[0]->id) ? $decodedToken->user[0]->id :  $user_id;
        }
        return $user_id;
    }
}

if (!function_exists('push_notification_expo')) {
    function push_notification_expo($postData){

        $url = 'https://exp.host/--/api/v2/push/send';
        $ch = curl_init();
        $headers  = [
                    // 'x-api-key: XXXXXX',
                    'Content-Type: application/json'
                ];
        // $postData = [
        //     "to"=>$postData['to'],
        //     "title" =>$postData['title'],
        //     "sound"=>$postData['sound'],
        //     "body"=>$postData['body']
        // ];
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));           
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($result === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
    }
}

if (!function_exists('push_notification_android')) {
	function push_notification_android($device_id,$message){

		//API URL of FCM
		$url = 'https://fcm.googleapis.com/fcm/send';

		//Nama project
		//bismilllah
		//Project ID
		//bismilllah-484cd
		//Lokasi resource Google Cloud Platform (GCP)
		//nam5 (us-central)
		//Kunci API Web
		//AIzaSyDs0pC4t19W9JH0YINf85x60Wve6q3mICk
		
		
		/*api_key available in:
		Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    $api_key = 'AAAA2c146Pg:APA91bH49ka5NLOty3SLbxsQM17D1xa0RHO8rCvhVSIFREUz3rsXlLERBKO55x2tH_TEdhOvbQUPSC3ReYjMlXJHlfUv8eTYFF4PMqIFdPNew7fc3ovWA_EhzikvIfGo0CJ2deSYk3_D';
					
		$fields = array (
			'registration_ids' => array (
					$device_id
			),
			'data' => array (
					"message" => $message
			)
		);

		//header includes Content type and api key
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$api_key
		);
					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
}

if (!function_exists('returnJson')) {
    function returnJson($data)
    {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'message' => isset($data['message']) ? $data['message'] : '',
            'data' => isset($data['data']) ? $data['data'] : [],
            'date' => date('Y-m-d H:i:s'),
        ]);
    }
}

if (!function_exists('compareFields')) {
    function compareFields($action = '', $table, $post=[])
    {
        $CI = &get_instance();
        $CI->load->database();

        $field = $CI->db->list_fields($table);

        $param = [];
        foreach ($post as $a => $b) {
            if (in_array($a, $field)) {
                $param[$a] = $b;
            }
        }

        $headers = cekAuthorization(apache_request_headers());
        $user_id = null;
        if (isset($headers['Authorization']) && !empty($headers['Authorization'])) {
            // $decodedToken = authorization::validateTimestamp($headers['Authorization']);
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            $user_id = isset($decodedToken->user[0]->id) ? $decodedToken->user[0]->id :  $user_id;
        }

        if (!isset($param['created_by']) && $action == 'create' && in_array('created_dt', $field)) {
            $param['created_dt'] = date('Y-m-d H:i:s');
            $param['created_by'] = $user_id;
        }
        if (!isset($param['updated_by']) && $action == 'update' && in_array('updated_dt', $field)) {
            $param['updated_dt'] = date('Y-m-d H:i:s');
            $param['updated_by'] = $user_id;
        }


        return $param;
    }
}

if (!function_exists('addConditionEquel')) {
    function addConditionEquel($add_param, $param)
    {
        $condition = [];
        foreach ($add_param as $a => $b) {
            if (isset($param[$a])) {
                $condition[] = " $b = '".$param[$a]."' ";
            }
        }

        return implode(' and ', $condition);
    }
}

if (!function_exists('addConditionLike')) {
    function addConditionLike($add_param, $param)
    {
        $condition = [];
        foreach ($add_param as $a => $b) {
            if (isset($param[$a])) {
                $condition[] = " $b like '%".$param[$a]."%' ";
            }
        }

        return implode(' or ', $condition);
    }
}

if (!function_exists('conditionEquel')) {
    function conditionEquel($param, $alias = '')
    {
        $condition = [];
        $alias = !empty($alias) ? "$alias." : '';
        foreach ($param as $a => $b) {
            $condition[] = " $alias$a = '$b' ";
        }

        return implode(' and ', $condition);
    }
}

if (!function_exists('conditionLike')) {
    function conditionLike($param, $alias = '')
    {
        $condition = [];
        $alias = !empty($alias) ? "$alias." : '';
        foreach ($param as $a => $b) {
            $condition[] = " $alias$a like '%$b%' ";
        }

        return implode(' or ', $condition);
    }
}

if (!function_exists('conditionLimit')) {
    function conditionLimit($params, $limit)
    {
        if (isset($params['limit']) && $params['limit'] == '-1') {
            return '';
        } else {
            $page = 0;
            $limit = $limit;
            if (isset($params['page'])) {
                $page = $params['page'];
            }
            if (isset($params['limit'])) {
                $limit = $params['limit'];
            }

            $page =(int)$page * (int)$limit;

            // var_dump("limit $page, $limit "); die;

            return " limit $page, $limit ";
        }
    }
}

if (!function_exists('encriptString')) {
    function encriptString($value)
    {
        if (!empty($value)) {
            $salt = '~`!@#$%^&*()_-+=}]{[\|"><';

            return md5($value.md5($value.$salt).$salt.md5($value.$salt)).md5($value.md5($value.$salt).md5($value.$salt).$salt);
        } else {
            return '';
        }
    }
}

if (!function_exists('readSql')) {
    function readSql($thiss, $params = [])
    {
        $condition = [];
        $compare = conditionEquel(compareFields('', $thiss->table, $params), $thiss->alias);
        if (!empty($compare)) {
            $condition[] = $compare;
        }
        $add = addConditionEquel($thiss->add_params, $params);
        if (!empty($add)) {
            $condition[] = $add;
        }
        $limit = conditionLimit($params, $thiss->limit);
        $condition = array_merge($condition, $thiss->where);

        if(isset($params['where']) && !empty($params['where'])){
            $condition[] = $params['where'];
        }

        $group_by = '';
        if(isset($params['group_by'])) {
            $group_by = $params['group_by'];
        }

        $order_by = '';
        if(isset($params['order_by'])) {
            $order_by = $params['order_by'];
        }

        $condition = count($condition) > 0 ? (' where '.implode(' and ', $condition)) : '';

        // echo '<pre>';
        // var_dump($thiss->sql.$condition.$group_by.$order_by.$limit); 
        // die;

        $read = findAll($thiss->sql.$condition.$group_by.$order_by.$limit);
        // $read = $thiss->sql.$condition.$group_by.$order_by.$limit;

        return $read;
    }
}

if (!function_exists('cekAuthorization')) { // dari javascript
    function cekAuthorization($headers)
    {
        if (isset($headers['authorization'])) {
            $headers['Authorization'] = $headers['authorization'];
        }

        return $headers;
    }
}
if (!function_exists('authToken')) {
    function authToken($thiss)
    {
        // ada 2 authorization karena become to lowercase
        $headers = cekAuthorization($thiss->input->request_headers());

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            // $decodedToken = authorization::validateTimestamp($headers['Authorization']);
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                return $thiss->set_response($decodedToken, REST_Controller::HTTP_OK);
            }
        }

        exit($thiss->set_response([
            'code' => 401,
            'error' => 'Unauthorised',
        ], REST_Controller::HTTP_UNAUTHORIZED));
    }
}

if (!function_exists('validPost')) {
    function validPost($thiss)
    {
        if (isset($thiss->post()[0])) {
            $_POST = (array) json_decode($thiss->post()[0])->data;
            if(count($_POST)==0){
                $_POST = [];
            }
            unset($_POST[0]);
        } elseif (isset($_POST['data'])) {
            $_POST = (array) json_decode($_POST['data'])[0];
            unset($_POST['data']);
        }
    }
}
if (!function_exists('createSlug')) {
    function createSlug($str, $delimiter = '-'){
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    } 
}
if (!function_exists('uploadbase64')) {
    function uploadbase64($img,$path,$name){

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pos  = strpos($img, ';');
        $type = explode(':', substr($img, 0, $pos))[1];
        $ext = explode('/', $type)[1];

        $img = str_replace("data:image/$ext;base64,", '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $filename = $name . ".".$ext;
        $file = $path . $filename;
        file_put_contents($file, $data);
        return $filename;
    } 
}
if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('joinKeyValueArray')) {

    function joinKeyValueArray($separator, $params, $sep = '') {
        $data = [];
        foreach ($params as $key => $value) {
            $data[] = "$key$separator'$value'";
        }
        return join($sep, $data);
    }

}