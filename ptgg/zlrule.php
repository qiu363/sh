<?php

define('DEFPAY', 'ptgg');

require_once 'class/main.php';

$userinfo = CORE::get_instance()->check_wechat_login('http%3A%2F%2Fwww.astrosparkle.com%2Fh5%2Fptgg%2Fsqzl.php');

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
</head>

<body>

<section class="zl-header">
    <img src="./images/logo.png">
</section>

<section class="zl-tips" id="J_zl_info">
    <div class="zl-tips-title">活动说明</div>
    <div class="rule">
        1．成功关注首开地产璞缇公馆官方微信后即可参与本次活动 <br>
        2．参与本次须填写您的姓名与手机号 <br>
        3．好友成功助力后将获得助力得分，分数达到100分即可获得购房优惠 <br>
        兑奖方式：当助力得分达到100分时，凭借您的微信活动页面，前往璞缇公馆售楼大厅，在工作人员确认您的身份后，即可获得购房优惠 <br>
        ＊活动方保证不会将您的个人信息以任何形式泄露
    </div>
    <div class="zl-tips-btn">
        <a class="btn" href="###" id="J_cjhd">参与活动</a>
    </div>
</section>

<section class="zl-tips hide" id="J_zl_tj">
    <div class="zl-tips-title">
        提交您的信息 <br>
        才可以参与活动
    </div>
    <div class="zl-tips-input">
        <div class="zl-tips-txt">
            <label for="name">姓名</label>
            <input type="text" id="name">
        </div>
        <div class="zl-tips-txt">
            <label for="phone">手机号</label>
            <input type="text" id="phone">
        </div>
    </div>
    <div class="zl-tips-btn">
        <a class="btn" href="###" id="J_sub">提交</a>
    </div>
</section>

<script type="text/javascript" src="./js/zepto.min.js"></script>
<script type="text/javascript">
    (function () {
        var load = 0;

        $('#J_cjhd').click(function () {
            $("#J_zl_info").hide();
            $('#J_zl_tj').show();

            return false;
        });

        $('#J_sub').click(function () {
            if (load === 1) {
                return false;
            }
            load = 1;
            var name = $('#name').val().replace(/^\s+|\s+$/, '');
            var phone = $('#phone').val().replace(/^\s+|\s+$/, '');

            if (name === '') {
                alert("请输入姓名");
                $('#name').focus();
                return false;
            }
            if (!/\d{11}/.test(phone)) {
                alert('请输入正确的电话号码');
                $('#phone').focus();
                return false;
            }

            $.ajax({
                url: 'ajax.php',
                data: {name: name, mobile: phone},
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.code === 1) {
                        window.location.href = 'zl.php?id='+ data.id;
                    } else {
                        alert(data.msg);
                        window.location.href = 'zl.php?id='+ data.id;
                    }
                }
            });

            return false;
        });
    })();
</script>

</body>
</html>