<?php

define('DEFPAY', 'pay');

require_once 'class/main.php';

$wx_id = input_get('id');
if (!$wx_id) {
    header('Location:index.php');
}

$userinfo = CORE::get_instance()->check_wechat_login('http%3A%2F%2Fwww.astrosparkle.com%2Fh5%2Fptgg%2Fzl.php?id='. $wx_id);

$res = CORE::get_instance()->get_active_info($wx_id, $userinfo);

if (!isset($res['user']['id'])) {
    header('Location: index.php');
    exit('非法链接');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>璞缇公馆</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link type="text/css" href="./styles/style.css" rel="stylesheet">
    <meta name="x5-page-mode" content="app" />
    <meta name="imagemode" content="force" />
    <meta content="telephone=no" name="format-detection"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="browsermode" content="application" />
    <script type="text/javascript">
        (function(){
            var phoneWidth = parseInt(window.screen.width);
            var phoneScale = phoneWidth/640;

            var ua = navigator.userAgent;
            if (/Android (\d+\.\d+)/.test(ua)) {                
                document.write('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">');
            } else {
                document.write('<meta name="viewport" content="width=320, user-scalable=no, target-densitydpi=device-dpi">');
            }
        })();
    </script>
    <style type="text/css">
        html,
        body {
            min-height: 100%;
        }
    </style>
</head>
<body class="body-bg">

<section class="zl-header">
    <img src="./images/logo.png">
</section>

<section class="zl-title" id="J_zl">
    <?php
        if ($res['is_lz']) {
    ?>
    好友已为您助力<?php echo $res['user']['score']; ?>%
    <?php
        } else {
            if ($res['is_zl']) {
    ?>
    您成功帮<?php echo $res['nickname'] ?>助力<?php echo $res['user_list'][$res['cur_user_id']]; ?>%
    <?php
            } else {
    ?>
    帮助您的好友<?php echo $res['nickname'] ?>助力
    <?php
            }
    ?>
    <?php
        }
    ?>
</section>

<section class="zl-process">
    <div class="zl-process-step" style="height:<?php echo $res['user']['score']; ?>%;"></div>
</section>

<?php
    if (!$res['is_lz']) {
?>
<section class="zl-hy">
    <a class="btn" href="###" id="J_zl_btn">助力</a>
</section>
<section class="zl-hy">
    <a class="btn" href="index.php">我也要玩</a>
</section>
<?php
    }
?>

<div class="zl-score">
    <div class="zl-score-name" id="J_score_name">
        <?php
            foreach ($res['user_zl'] as $key => $value) {
        ?>
        <p><?php echo $value['nickname']; ?></p>
        <?php
            }
        ?>
    </div>
    <div class="zl-score-s" id="J_score_s">
        <?php
            foreach ($res['user_list'] as $key => $value) {
        ?>
        <p><?php echo $value; ?>%</p>
        <?php
            }
        ?>
    </div>
</div>

<?php
    if ($res['is_lz']) {
?>
<div class="share"></div>
<?php
    }
?>

<script type="text/javascript" src="./js/zepto.min.js"></script>
<script type="text/javascript">
    (function () {
        var load = 0;
        var name = '<?php echo $res['nickname']; ?>';

        $('#J_zl_btn').click(function () {
            if (load === 1) {
                return false;
            }
            load = 1;

            $.ajax({
                url: 'ajax.php?zl=1&id='+ <?php echo $wx_id; ?>,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    load = 0;

                    if (data.code === 1) {
                        $('#J_zl').html('你成功帮'+ name +'助力'+ data.score +'%');

                        $('#J_score_name').prepend('<p>'+ data.nickname +'</p>');
                        $('#J_score_s').prepend('<p>'+ data.score +'%</p>');
                    } else {
                        alert(data.msg);
                    }
                }
            });

            return false;
        });
    })();
</script>

</body>
</html>