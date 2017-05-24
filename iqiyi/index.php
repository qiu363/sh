<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>爱奇艺</title>
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

<div class="logo">
    <a href="index.php">
        <img src="images/logo.png">
    </a>
</div>

<div class="ani">
    <div class="ani-main">
        <img class="ani-bg" src="./images/index_bg.png">
        <img class="ani-haokan" src="./images/haokan.png">
        <img class="ani-xq" src="./images/xq.png">
        <img class="ani-fdj" src="./images/fdj.png">
        <img class="ani-movie" src="./images/movie.png">
        <img class="ani-pen" src="./images/pen.png">
        <img class="ani-xq1" src="./images/xq1.png">
        <img class="ani-hj" src="./images/hj.png">
        <img class="ani-yhy" src="./images/yhy.png">
    </div>
    <img class="tv" src="./images/iqiyi.png">
</div>

<a href="create.php" class="create-btn"></a>

<script type="text/javascript">
    <?php
        $url = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if (!empty($_SERVER['QUERY_STRING'])) {
            $url .= '?' . $_SERVER['QUERY_STRING'];
        }
    ?>
    var share = {
        url        : window.location.href,
        picurl     : 'http://' + window.location.host + "/sh/iqiyi/images/logo.jpg",
        title      : '爱奇艺校招季火爆开幕，造星or招聘？奇艺之旅，要你好看！',
        content    : '爱奇艺校招季火爆开幕，造星or招聘？奇艺之旅，要你好看！',
        appId      : 'wxd03d36913f619f3d',
        timestamp  : '<?php $timer = time();echo $timer;?>',
        nonceStr   : '1234567',
        signature  : '<?php echo sha1('jsapi_ticket='. file_get_contents('token.txt') .'&noncestr=1234567&timestamp='. $timer .'&url='. $url); ?>'
    };
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    var wxconf = {
        title: share.title,
        desc: share.content,
        link: encodeURI(share.url),
        imgUrl: share.picurl,
        success: function() {},
        cancel: function() {}
    };

    wx.config({
        debug: false,
        appId: share.appId,
        timestamp: share.timestamp,
        nonceStr: share.nonceStr,
        signature: share.signature,
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo'
        ]
    });

    wx.ready(function() {
        wx_share();
    });

    function wx_share(){
        wx.onMenuShareTimeline(wxconf);
        wx.onMenuShareAppMessage(wxconf);
        wx.onMenuShareQQ(wxconf);
        wx.onMenuShareWeibo(wxconf);
    }
</script>

</body>
</html>
