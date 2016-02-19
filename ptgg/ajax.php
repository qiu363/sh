<?php

define('DEFPAY', 'ptgg');

require_once 'class/main.php';

$userinfo = CORE::get_instance()->check_wechat_login('http%3A%2F%2Fwww.astrosparkle.com%2Fh5%2Fptgg%2Fsqzl.php');

$name = input_get('name');
$mobile = input_get('mobile');

if ($name && $mobile) {

    $res = CORE::get_instance()->save_application_userinfo($name, $mobile, $userinfo);

    echo json_encode($res);
    
}

$zl = input_get('zl');
$id = input_get('id');

if ($zl == 1) {
	$res = CORE::get_instance()->save_zl($id, $userinfo);

    echo json_encode($res);
}

?>
