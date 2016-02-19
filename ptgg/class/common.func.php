<?php
	
defined('BASEPATH') or define('BASEPATH'  , __DIR__ . '/../');
defined('LOGPATH')  or define('LOGPATH'   , '');

/**
 * 获取get数据
 * @param string $key 获取的get值KEY
 */
function input_get($key = ''){
	if(!empty($key) && isset($_GET[$key])){
		$val = $_GET[$key];
		$val = mysql_real_escape_string($val);

		return htmlspecialchars($val);
	}else{
		return FALSE;
	}
}

/**
 * 获取post数据
 * @param string $key 获取的post值KEY
 */
function input_post($key = ''){
	if(!empty($key) && isset($_POST[$key])){
		$val = $_POST[$key];
		$val = mysql_real_escape_string($val);

		return htmlspecialchars($val);
	}else{
		return FALSE;
	}
}

/**
 * 获取cookie
 */
function get_cookie ($name = '') {
	if (!empty($name) && isset($_COOKIE[$name])) {
		$val = $_COOKIE[$name];
		
		return $val;
	} else {
		return FALSE;
	}
}

/**
 * 设置cookie
 * @param string $name
 * @param string $value
 * @param int $expire 过期时间，单位为天数
 */
function set_cookie ($name, $value, $expire) {
	if (!empty($name)) {
		setcookie($name, $value, time() + $expire * 24 * 60 * 60, '/');

		return TURE;
	} else {
		return FASLE;
	}
}

/**
 * 获取用户IP
 * @return string 获取失败为'-'
 */
function get_ip(){
	$ip = FALSE; 
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){ 
        $ip = $_SERVER['HTTP_CLIENT_IP']; 
    }
    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
        $ips = explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']); 
        if($ip){ 
            array_unshift($ips, $ip); 
            $ip = FALSE; 
        }
        for ($i = 0; $i < count($ips); $i++){
            if(!eregi ('^(10│172.16│192.168).', $ips[$i])){
                $ip = $ips[$i];
                break;
            }
        }
    }
    if(!empty($_SERVER['REMOTE_ADDR'])){
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if(!$ip){
        $ip = '-';
    }

    return $ip;
}

/**
 * 返回json数据统一处理
 * @param int   $code    信息码  0 失败  1 成功
 * @param msg   $msg 	 信息
 * @param array $data    结果
 */
function del_res($code = 0, $msg = '', $data = array()){
	$data = array(
		'code' => $code,
		'msg'  => $msg,
		'data' => $data
	);

	return json_encode($data);
}

?>