<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>智库登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link type="text/css" href="./styles/style.css" rel="stylesheet">
    <script type="text/javascript" src="./js/jquery.mini.js"></script>
</head>
<body class="login-bg">
    
<div class="login">
    <div class="login-main">
        <img src="./images/login_banner.jpg">
        <div class="login-cont">
            <div class="login-title">用户登录</div>
            <div class="login-error-msg" id="J_error_msg"><?php if(!empty($error_msg)){echo $error_msg;} ?></div>
            <form action="./index.php/login/sign" method="get">
                <div class="login-form">
                    <span>用户名：</span>
                    <input type="text" name="account" id="J_account">
                </div>
                <div class="login-form">
                    <span>密 码：</span>
                    <input type="password" name="password" id="J_paw">
                </div>
                <div class="login-form">
                    <span>验证码：</span>
                    <input type="text" name="yzm" style="width:50px;" id="J_yzm">
                    <img title="看不清，换一张" src="./index.php/verify_code/" class="login-yzm" onclick="rand(this);">
                </div>
                <div class="login-btn">
                    <input type="submit" value="" id="J_login">
                    <input type="button" class="login-reset" id="J_reset" value="">
                </div>
            </form>
            <div class="login-bot"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    ;(function(){
        $("body").css({
            height: $(window).height()
        });

        $("#J_login").click(function(){
            var account = $("#J_account").val();
            var paw = $("#J_paw").val();
            var yzm = $("#J_yzm").val();

            $("#J_error_msg").html("");

            if(account == ""){
                $("#J_error_msg").html("用户名不能为空");
                return false;
            }
            if(paw == ""){
                $("#J_error_msg").html("密码不能为空");
                return false;
            }
            if(yzm.length != 4){
                $("#J_error_msg").html("请填写正确的验证码");
                return false;
            }
        });

        $("#J_reset").click(function(){
            var account = $("#J_account").val("");
            var paw = $("#J_paw").val("");
            var yzm = $("#J_yzm").val("");
        });

    }());

    function rand(t){
        t.src = t.src.replace(/\?.*$/g, "") +'?'+ new Date().getTime();
    }
</script>

</body>
</html>