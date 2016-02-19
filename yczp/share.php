<?php
    if(isset($_GET['name'])){
        $name = htmlspecialchars($_GET['name']);
    }else{
        header("Location: index.html");
        exit;
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>天庭英才招聘</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="x5-page-mode" content="app" />
    <meta name="imagemode" content="force" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="browsermode" content="application" />
    <link type="text/css" href="./styles/style.css??" rel="stylesheet">
    <style type="text/css">
        body{
            max-width: 640px;
            margin: 0 auto;
        }

        .draw-img{
            padding: 35px 10px 0;
        }
        .draw-img img{
            width: 100%;
        }

        .main{
            position: relative;
            width: 238px;
            height: 161px;
            margin: 0 auto;
            padding: 10px 0 0;
            text-align: center;
        }
        .code{
            position: absolute;
            right: 18px;
            top: 46px;
            width: 76px;
            height: 76px;
        }
        .complete i.share{
            background-image: url(./images/share.png);
        }
        .complete a.play{
            width: 48px;
            height: 25px;
            background-image: url(./images/play.png);
            background-size: 48px 25px;
        }
        .complete a.cj{
            background-image: url(./images/cj.png);
        }
        .share-mask{
            display: none;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .8) url(./images/share_arrow.png) right top no-repeat;
            background-size: 72px 72px;
        }
        .share-mask img{
            position: absolute;
            left: 50%;
            top: 50%;
            width: 256px;
            height: 135px;
            margin: -67px 0 0 -128px;
        }
    </style>
</head>
<body>

<div class="draw-img">
    <img src="./upload/<?php echo $name; ?>.png">
</div>

<div class="main">
    <img src="./images/share_banner.png" width="238">
    <img src="./images/code.jpg" class="code">
</div>

<div class="complete">
    <?php
        if(isset($_GET['type'])){
    ?>
    <i class="share" id="J_share"></i>
    <?php
        }else{
    ?>
    <a href="index.html" class="play"></a>
    <?php
        }
    ?>
    <img src="./images/logo.png" height="36">
    <a href="cj.html" class="cj" id="J_again"></a>
</div>

<div class="share-mask" id="J_mask">
    <img src="./images/share_info.png">
</div>

<script type="text/javascript" src="./js/zepto.min.js"></script>
<script type="text/javascript">
    (function(){
        $("#J_share").bind("click", function(){
            $("#J_mask").show();
            if($("body").height() > $(window).height()){
                $("#J_mask").css({
                    height : $("body").height(),
                    width : $(window).width()
                });
            }else{
                $("#J_mask").css({
                    height : $(window).height(),
                    width : $(window).width()
                });
            }
        });
        $("#J_mask").bind("click", function(){
            $(this).hide();
        });
    }());
</script>

</body>
</html>