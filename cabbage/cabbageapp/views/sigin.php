<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>乐透社</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link type="text/css" href="<?php echo $base_url; ?>static/css/style.css" rel="stylesheet">
    <link type="text/css" href="<?php echo $base_url; ?>static/css/iconfont.css" rel="stylesheet">
</head>
<body>

<?php echo $header; ?>

<div class="sigin-inner-main">
    <div class="sigin-inner clearfix">
        <div class="sigin-m-left">
            <div class="sigin-m-title">
                <h2>欢迎回来</h2>
                <span class="tip">还没有账号？
                    <a href="<?php echo $base_url; ?>sigin/sigup">马上注册</a>
                </span>
            </div>
            <form id="J_form" class="sigin-form">
                <label class="login-icon">
                    <i class="icon-user-line login-icon-i"></i>
                    <input id="J_username" type="text" name="username" class="login-input" placeholder="请输入用户名" autocomplete="off">
                </label>
                <label class="login-icon pos">
                    <i class="icon-lock-line login-icon-i"></i>
                    <input id="J_password" type="password" name="password" autocomplete="off" class="login-input" placeholder="请输入密码">
                </label>
                <label class="login-icon pos">
                    <i class="icon-user-line login-icon-i"></i>
                    <input id="J_ckr" type="text" name="ckr" autocomplete="off" class="login-input" placeholder="持卡人姓名">
                </label>
                <button id="J_login" class="login-btn">
                    <span>登录</span>
                </button>
                <p class="login-msg">
                    <a class="login-forget" href="<?php echo $base_url; ?>sigin/getpass" target="_blank">忘记密码?</a> 如登录出现异常,请清理浏览器缓存后再尝试。
                </p>
            </form>
        </div>
        <div class="sigin-aside">
            <a class="find-pwd" href="#/app/findPassword">密码找回</a>
            <a class="freeze" href="#/app/freeze">自助冻结</a>
            <a href="#" class="idea">改进建议</a>
        </div>
    </div>
</div>

<?php echo $footer; ?>


</body>
</html>
