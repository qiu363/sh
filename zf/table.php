<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>中发智造报名表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link type="text/css" href="./styles/style.css" rel="stylesheet">
    <meta name="x5-page-mode" content="app" />
    <meta name="imagemode" content="force" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="browsermode" content="application" />
</head>
<body style="background:#fff;">

<?php

//$link = mysql_connect('127.0.0.1', 'h5', 'h5db4321q');
$link = mysql_connect('127.0.0.1', 'root', '');

//$db_selected = mysql_select_db("h5db", $link);
$db_selected = mysql_select_db("test", $link);

mysql_query("set names utf8", $link);

$sql = "SELECT * FROM user";

$result = mysql_query($sql, $link);

?>

<div style="padding:20px;">
    <h1 style="font-size:24px;text-align:center;">中发智造报名表</h1>
    <style type="text/css">
        .main-table {
            border: solid 1px #666;
            text-align: center;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .main-table th,
        .main-table td {
            border: solid 1px #666;
            padding: 5px 0;
            text-align: center;
        }
        .main-table tr:hover {
            background: #ddd;
        }
    </style>
    <table width="100%" class="main-table">
        <tr>
            <th>姓名</th>
            <th>职位</th>
            <th>企业名称</th>
            <th>核心业务</th>
            <th>联系电话</th>
            <th>提交时间</th>
        </tr>
        <?php
            while($row = mysql_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['job']; ?></td>
            <td><?php echo $row['company']; ?></td>
            <td><?php echo $row['hxyw']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['create_time']; ?></td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>

<?php

mysql_close($link);

?>

</body>
</html>