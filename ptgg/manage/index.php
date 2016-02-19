<?php

define('DEFPAY', 'ptgg');

require_once '../class/db.class.php';

$sql = 'SELECT au.*, wu.* FROM active_user as au, wx_user as wu WHERE au.wx_id = wu.id';

$db = new DB;

$res = $db->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>璞緹公馆</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link type="text/css" href="../styles/style.css" rel="stylesheet">
    <meta name="x5-page-mode" content="app" />
    <meta name="imagemode" content="force" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="browsermode" content="application" />
</head>
<body>

<style>
    body {background: #fff;}
    h1 {width: 100%;font-size: 18px;margin: 6px 0;text-align: center;}
    th, td{border:solid 1px #eee;text-align: center;height: 30px;}
</style>

<h1>璞缇公馆助力用户管理</h1>

<table width="100%">
    <tr>
        <th>姓名</th>
        <th>手机号</th>
        <th>昵称</th>
        <th>分数</th>
        <th>操作</th>
    </tr>
    <?php
        foreach ($res as $key => $value) {
    ?>
    <tr>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['mobile']; ?></td>
        <td><?php echo $value['nickname']; ?></td>
        <td><?php echo $value['score']; ?></td>
        <td></td>
    </tr>
    <?php
        }
    ?>
</table>

</body>
</html>