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
    <style type="text/css">
        html,
        body {
            width: 100%;
        }
    </style>
</head>

<body>

<div style="width:100%;overflow:hidden;">
    <section class="sion s1" id="J_s1">
        <img class="bg" src="./images/bg1_1.jpg">
        <img class="bg" src="./images/bg2_2.jpg">

        <div class="logo">
            <img src="./images/logo.png">
        </div>
        <div class="title title1">
            <img src="./images/title1.png">
        </div>
        <div class="title title2">
            <img src="./images/title2.png">
        </div>
        <div class="title nav1">
            <img src="./images/nav1.png">
            <img src="./images/nav2.png">
            <img src="./images/nav3.png">
            <img src="./images/nav4.png">
        </div>
    </section>

    <section class="sion s2" id="J_s2">
        <img class="bg" src="./images/bg3.jpg">

        <div class="title title3">
            <img src="./images/title3.png">
        </div>
        <div class="title bot1">
            <img src="./images/bot_en.png">
        </div>
        <div class="sj1">
            <img src="./images/sj1.png">
            <img src="./images/logo1.png" class="sj1-logo1">
        </div>
        <div class="sj2">
            <img src="./images/sj2.png">
        </div>
    </section>

    <section class="sion s6" id="J_s6">
        <img class="bg bg7" src="./images/bg7.jpg">

        <div class="title title8">
            <img src="./images/title8.png">
        </div>
        <div class="title bot1">
            <img src="./images/bot_en.png">
        </div>
        <div class="sj6">
            <img src="./images/sj6.png">
        </div>
        <div class="sj7">
            <img src="./images/sj7.png">
        </div>
    </section>

    <section class="sion s3" id="J_s3">
        <img class="bg bg3" src="./images/bg4.jpg">

        <div class="title title4">
            <img src="./images/title4.png">
        </div>
        <div class="title bot2">
            <img src="./images/bot_en.png">
        </div>
        <div class="sj3">
            <img src="./images/sj3.png">

            <img src="./images/logo2.png" class="sj3-logo2">
            <div class="sj3-nav">
                <img src="./images/nav2_1.png">
                <img src="./images/nav2_2.png">
                <img src="./images/nav2_3.png">
                <img src="./images/nav2_4.png">
            </div>
        </div>
    </section>

    <section class="sion s4" id="J_s4">
        <img class="bg bg4" src="./images/bg5.jpg">

        <div class="title title5">
            <img src="./images/title5.png">
        </div>
        <div class="title bot3">
            <img src="./images/bot_en.png">
        </div>
        <div class="sj4">
            <img src="./images/sj4.png">
        </div>
        <div class="sj5">
            <img src="./images/sj5.png">
        </div>
    </section>

    <section class="sion s5" id="J_s5">
        <img class="bg" src="./images/bg6.jpg">

        <div class="title title6">
            <img src="./images/title6.png">
        </div>
        <div class="title title-phone">
            <img src="./images/phone.png">
        </div>
    </section>
</div>

<script type="text/javascript" src="./js/zepto.min.js"></script>
<script type="text/javascript">
    (function () {
        $('#J_s1').addClass('s1-act');
        var winHeight = $(window).height();

        $(window).bind('scroll', function () {
            var scrollTop = $(window).scrollTop();

            var s2 = $('#J_s2').offset().top;
            var s3 = $('#J_s3').offset().top;
            var s4 = $('#J_s4').offset().top;
            var s5 = $('#J_s5').offset().top;
            var s6 = $('#J_s6').offset().top;

            if (s2 < scrollTop + winHeight - 200) {
                $('#J_s2').addClass('s2-act');
            }
            if (s3 < scrollTop + winHeight - 200) {
                $('#J_s3').addClass('s3-act');
            }
            if (s4 < scrollTop + winHeight - 200) {
                $('#J_s4').addClass('s4-act');
            }
            if (s5 < scrollTop + winHeight - 50) {
                $('#J_s5').addClass('s5-act');
            }
            if (s6 < scrollTop + winHeight - 50) {
                $('#J_s6').addClass('s6-act');
            }

        });

        $(window).bind('resize', function () {
            var winHeight = $(window).height();
        });
    })();
</script>

</body>
</html>