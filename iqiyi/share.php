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
    <style type="text/css">
        html,
        body {
            height: auto;
            overflow: auto;
        }
    </style>
</head>

<body>

<?php
/**
 * 获取get数据
 * @param string $key 获取的get值KEY
 */
function input_get($key = ''){
    if(!empty($key) && isset($_GET[$key])){
        $val = $_GET[$key];

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

        return htmlspecialchars($val);
    }else{
        return FALSE;
    }
}
?>

<img class="share-bg" src="./images/canvas.png">

<div class="toutiao">
    <div class="toutiao-inner">
        <img class="toutiao-img" src="upload/<?php echo input_get('img'); ?>">
        <p id="J_wording"></p>
    </div>
</div>

<div class="ewm hide" id="J_ewm">
    <img src="./images/ewm.png">
</div>

<div class="canvas-btn">
    <a href="index.php"></a>
    <a href="http://www.iqiyi.com/" class="join"></a>
</div>

<script type="text/javascript" src="./js/zepto.min.js"></script>
<script type="text/javascript">
    !(function () {
        var sex = '<?php echo input_get('sex'); ?>';
        var name = '<?php echo input_get('name'); ?>';
        var r = '<?php echo input_get('r'); ?>';
        window.imgUrl = 'upload/<?php echo input_get('img'); ?>';

        var orientation = 0;

        var bgImguRL = './images/canvas.png';
        var wording = [
            [
                '《最好的我们2》男一号确定，男神{%name%}饰演余淮',
                '{%name%}做客爱奇艺《大学生来了》被封新一代国民偶像。',
                '《老九门》观众反响火爆，续集筹备{%name%}将出任男主',
                '惊爆！{%name%}未毕业已成爱奇艺最年轻股东',
                '《姐姐好饿》录制现场，{%name%}被四千年美女表白',
                '《灭罪师》广受好评，幕后英雄{%name%}接受爱奇艺专访',
                '《不良人》续集开拍，新任男主{%name%}到底是何来路',
                '爱奇艺宣布{%name%}成为终身VIP会员',
                '{%name%}取代秀贤仲基成为新晋国民老公',
                '传{%name%}牵手某黄金白富美，惊爆娱乐圈',
                '{%name%}成为爱奇艺影业最新大片男主，即将奔赴奥斯卡',
                '{%name%}打败众多一线明星，签约爱奇艺校招代言人',
                '{%name%}偶滴歌神最终夺魁，惊呆娜姐',
                '今晚21点{%name%}空降爱奇艺泡泡',
                '{%name%}连续一个月稳居爱奇艺泡泡明星排行榜首位'
            ],
            [
                '《最好的我们2》女主角确定，{%name%}饰演耿耿。',
                '爱奇艺年度最美大学生评选{%name%}全票胜出。',
                '{%name%}做客爱奇艺《大学生来了》被封新一代国民女神。',
                '{%name%}击败众多一线明星，成为爱奇艺最受欢迎女主持',
                '女神{%name%}牵手某国民男神被拍，刷爆各大新闻头条',
                '{%name%}携新作《我的朋友陈白露》续集，登上爱奇艺首页',
                '《请回答2017》开拍，{%name%}火速加盟出任女一号',
                '爱奇艺宣布{%name%}成为终身VIP会员',
                '{%name%}签约成为爱奇艺奇秀2017年度主播',
                '{%name%}成为爱奇艺影业最新大片女主，即将奔赴奥斯卡',
                '{%name%}成为爱奇艺最新手游老九门形象代言人',
                '{%name%}偶滴歌神最终夺魁，惊呆娜姐',
                '传{%name%}牵手某钻石王老五，惊爆娱乐圈',
                '校花的贴身高手2热播，{%name%}火速成为新晋宅男女神',
                '{%name%}打败众多一线明星，签约爱奇艺校招代言人',
                '今晚21点{%name%}空降爱奇艺泡泡',
                '{%name%}连续一个月稳居爱奇艺泡泡明星排行榜首位'
            ]
        ];

        window.word = wording[sex][r].replace(/{%name%}/, name);

        /*var cav = document.querySelector('#J_canvas');
        var ctx = cav.getContext("2d");

        var cavTmp = document.querySelector('#J_canvas_tmp');
        var ctxTmp = cavTmp.getContext("2d");

        var loading = 0;*/

        var bgImg = new Image();
        bgImg.src = bgImguRL;
        bgImg.onload = function () {
            /*ctx.drawImage(bgImg, 0, 0, 640, 1190);

            if (loading === 1) {
                ctx.drawImage(cavTmp, 12, 218, 616, 308);
            } else {
                loading = 1;
            }*/

            $('#J_ewm').show();

            $('#J_wording').html(window.word);

        };

        /*var img = new Image();
        img.src = imgUrl;

        $('#J_img_tmp').attr('src', imgUrl);

        img.onload = function () {
            var imgWidth = img.width;
            var imgHeight = img.height;

            ctxTmp.drawImage(img, 0, 0, 616, 308);

            ctxTmp.fillStyle = "rgba(0, 0, 0, .6)";
            ctxTmp.fillRect(0, 272, 616, 36);

            ctxTmp.font = "24px Helvetica";
            ctxTmp.fillStyle = "#fff";
            ctxTmp.fillText(word, 10, 300);

            if (loading === 1) {
                ctx.drawImage(cavTmp, 12, 218, 616, 308);
            } else {
                loading = 1;
            }
        };*/
    })();
</script>
<script type="text/javascript">
    var share = {
        url        : window.location.href,
        picurl     : 'http://' + window.location.host + "/sh/iqiyi/" + imgUrl,
        title      : window.word,
        content    : window.word,
        appId      : 'wxd03d36913f619f3d',
        timestamp  : '<?php $timer = time();echo $timer;?>',
        nonceStr   : '1234567',
        signature  : '<?php echo sha1('jsapi_ticket='. file_get_contents('token.txt') .'&noncestr=1234567&timestamp='. $timer .'&url=http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING']); ?>'
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
