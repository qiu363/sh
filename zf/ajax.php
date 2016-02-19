<?php


$link = mysql_connect('127.0.0.1', 'h5', 'h5db4321q');
//$link = mysql_connect('127.0.0.1', 'root', '');

$db_selected = mysql_select_db("h5db", $link);
//$db_selected = mysql_select_db("test", $link);

mysql_query("set names utf8", $link);

$name = post('name');
$job = post('job');
$company = post('company');
$hxyw = post('hxyw');
$phone = post('phone');

if (empty($name)) {
    deal(1, '姓名不能为空');
}
if (empty($job)) {
    deal(1, '职位不能为空');
}
if (empty($company)) {
    deal(1, '企业名称不能为空');
}
if (empty($hxyw)) {
    deal(1, '核心业务不能为空');
}
if (preg_match("/^\d{13}$/", $phone)) {
    deal(1, '手机号码格式错误');
}

$sql = "INSERT INTO user (name, job, company, hxyw, phone, create_time) values ('". $name ."', '". $job ."', '". $company ."', '". $hxyw ."', '". $phone ."', NOW())";

$result = mysql_query($sql, $link);

if ($result) {
    deal(0, '提交成功');
} else {
    deal(1, '网络错误');
}

function get($name) {
    if (isset($_GET[$name])) {
        return $_GET[$name];
    } else {
        return false;
    }
}

function post($name) {
    if (isset($_POST[$name])) {
        return $_POST[$name];
    } else {
        return false;
    }
}

function deal($code, $msg, $data = array()) {
    echo json_encode(array('code' => $code, 'msg' => $msg, 'data' => $data));
}

?>